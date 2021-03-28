<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;
use File;
use Log;
use Gate;
use App\Models\User;

class DatasetsController extends Controller
{

    public function index(Request $request)
    {
        $countries = [];
        $datasets = Dataset::all();
        $datasets_num = count($datasets);
        foreach ($datasets as $d) {
            if (!in_array($d->country, $countries)) {
                array_push($countries, $d->country);
            }
        }
        $selected_country = '';
        if($request->method() == 'POST' && $request->filter && $request->country ) {
            $datasets = Dataset::where('country', $request->country)->get();
            $datasets_num = count($datasets);
            $selected_country = $request->country;
    	} else {
            $datasets = Dataset::paginate(10);
        }
        return view('dashboard', compact('datasets','countries','selected_country', 'datasets_num'));
    }

    public function filter()
    {
        $datasets = Dataset::all();
        return view('dashboard', compact('datasets'));
    }

    public function download(Dataset $dataset)
    {
        $path = storage_path() . '/app/public/uploads/' . $dataset->file_path;
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $headers = ['Content-Type: '.$type];
        //$dataset->downloads_count++;
        $dataset->increment('downloads_count', 1);
	    $dataset->save();
        return response()->download($path, $dataset->file_path, $headers);
    }

    public function downloadList()
    {
        $datasets = Dataset::all();
        $filename = "datasets.csv";
        $delimiter=",";
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        $f = fopen('php://output', 'w');
        fputcsv($f, array('title','description','country','date_created','date_updated','downloads','file_name'), $delimiter);
        foreach ($datasets as $d) {
            $line = array($d->title,$d->description,$d->country,$d->created_at,$d->updated_at,$d->downloads_count,$d->file_path);
            fputcsv($f, $line, $delimiter);
        }
    }

    public function add()
    {
        $selectableCountries = ["EU", "Austria", "Belgium", "Bulgaria", "Croatia", "Cyprus", "Czech Republic", "Denmark", "Estonia", "Finland", "France", "Germany", "Greece", "Hungary", "Ireland", "Italy", "Latvia", "Lithuania", "Luxembourg", "Malta", "Netherlands", "Poland", "Portugal", "Romania", "Slovakia", "Slovenia", "Spain", "Sweden", "United Kingdom", "Other"];
    	return view('add', compact('selectableCountries'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'country' => 'required',
            'file.*' => 'required|mimes:csv,txt,text/csv,application/json,application/xml,text/xml,text/plain|max:102400'
        ]);
        $dataset = new Dataset();
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $dataset->title = $request->title;
            $dataset->description = $request->description;
            $dataset->country = $request->country;
            $dataset->file_path = $fileName;
            $dataset->user_id = auth()->user()->id;
            $dataset->save();
            return redirect('/dashboard'); 
        }
    }

    public function edit(Dataset $dataset)
    {
        if (!Gate::allows('edit-dataset', $dataset)) {
            abort(403);
        }
        $selectableCountries = ["EU", "Austria", "Belgium", "Bulgaria", "Croatia", "Cyprus", "Czech Republic", "Denmark", "Estonia", "Finland", "France", "Germany", "Greece", "Hungary", "Ireland", "Italy", "Latvia", "Lithuania", "Luxembourg", "Malta", "Netherlands", "Poland", "Portugal", "Romania", "Slovakia", "Slovenia", "Spain", "Sweden", "United Kingdom", "Other"];
        $editors = User::where('is_editor', 1)->orWhere('is_admin', 1)->get();
    	return view('edit', compact('dataset','editors','selectableCountries'));           	
    }

    public function update(Request $request, Dataset $dataset)
    {
        if (!Gate::allows('edit-dataset', $dataset)) {
            abort(403);
        }
    	if(isset($_POST['delete'])) {
            //Delete file if exists
            $filePath = storage_path() . '/app/public/uploads/' . $dataset->file_path;
            if(File::exists($filePath)) {
                File::delete($filePath);
            }
    		$dataset->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'country' => 'required',
                'file.*' => 'mimes:csv,txt,text/csv,application/json,application/xml,text/xml,text/plain|max:102400'
            ]);
            $dataset->title = $request->title;
            $dataset->description = $request->description;
            $dataset->country = $request->country;
            if($request->owner) {
                $dataset->user_id = $request->owner;
            }
            if($request->file()) {
                //Delete old file
                $filePathOld = storage_path() . '/app/public/uploads/' . $dataset->file_path;
                if(File::exists($filePathOld)) {
                    File::delete($filePathOld);
                }
                //Save new file
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $dataset->file_path = $fileName;
            }
	    	$dataset->save();
	    	return redirect('/dashboard'); 
    	}    	
    }
}
