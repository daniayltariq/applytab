<?php

namespace App\Http\Controllers\Admin;
use App\Models\Menu;
use App\Models\User;

use App\Models\Banner;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = Banner::all();
        
        return view('backend.banner.list',compact('banners'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'image' => 'required|image',
        ]);
        
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $banner = new Banner;
        if ($request->hasFile('image')) {
            
            $banner->filename = custom_file_upload($request->image,BANNER_IMAGE_PATH_PUBLIC);

        }
        
        $banner->save();
        
        return redirect()->back()->with("status", "Banner has been saved.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ban=Banner::where('id',$id)->first();
        if ($ban) {

            $view_data=view('backend.banner.component.modal',compact('ban'))->render();
            $res=array(
                'status' => 'success',
                'data' => $view_data
        
            );
            
        }else{
            $res=array(
                'status' => 'error',
                'message'=>"data not found"
        
            );
        }

        return Response::json($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ban=Banner::findOrFail($id);
        if ($ban) {
            $ban->delete();
        }
       
        return redirect()->route('backend.banner.index')->with('status', 'Banner has been deleted!');
    }
}
