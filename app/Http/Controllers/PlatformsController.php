<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;

class PlatformsController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();
        return view('home', compact('platforms'));
    }

    public function manage()
    {
        $platforms = Platform::all();
        return view('platforms-list', compact('platforms'));
    }

    public function add()
    {
    	return view('add-platform');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'order' => 'required',
            'file' => 'mimes:jpg,jpeg,png,image/jpeg,image/png|max:1024'
        ]);

        $platform = new Platform();

        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $imagePath = $request->file('file')->storeAs('images', $fileName, 'public');
            $platform->image_path = $fileName;
        }
        $platform->title = $request->title;
        $platform->description = $request->description;
        $platform->url = $request->url;
        $platform->order = $request->order;
        $platform->save();
        return redirect('/platforms-list'); 
    }

    public function edit(Platform $platform)
    {
    	return view('edit-platform', compact('platform'));           	
    }

    public function update(Request $request, Platform $platform)
    {
    	if(isset($_POST['delete'])) {
    		$platform->delete();
    		return redirect('/platforms-list');
    	}
    	else
    	{
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'order' => 'required',
                'file' => 'mimes:jpg,jpeg,png,image/jpeg,image/png|max:1024'
            ]);

            if($request->file()) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $imagePath = $request->file('file')->storeAs('images', $fileName, 'public');
                $platform->image_path = $fileName;
            }
            $platform->title = $request->title;
            $platform->description = $request->description;
            $platform->url = $request->url;
            $platform->order = $request->order;
            $platform->save();
            return redirect('/platforms-list'); 
    	}    	
    }
}
