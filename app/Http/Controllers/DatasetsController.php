<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;
use File;
use Log;
use Gate;

class DatasetsController extends Controller
{
    public function index(Request $request)
    {
        $countries = [];
        $datasets = Dataset::all();
        foreach ($datasets as $d) {
            if (!in_array($d->country, $countries)) {
                array_push($countries, $d->country);
            }
        }
        $selected_country = '';
        if($request->method() == 'POST' && $request->filter && $request->country ) {
            $datasets = Dataset::where('country', $request->country)->get();
            $selected_country = $request->country;
    	}
        $datasets_num = count($datasets);
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

    public function add()
    {
    	return view('add');
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
    	return view('edit', compact('dataset'));           	
    }

    public function update(Request $request, Dataset $dataset)
    {
        if (!Gate::allows('edit-dataset', $dataset)) {
            abort(403);
        }
    	if(isset($_POST['delete'])) {
    		$dataset->delete();
    		return redirect('/dashboard');
    	}
    	else
    	{
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'country' => 'required',
            ]);
            $dataset->title = $request->title;
            $dataset->description = $request->description;
            $dataset->country = $request->country;
	    	$dataset->save();
	    	return redirect('/dashboard'); 
    	}    	
    }
}
