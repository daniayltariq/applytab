<?php

namespace App\Http\Controllers\Admin;

use App\Models\Duration;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $durations = Duration::all();
        
        return view('backend.duration.list',compact('durations'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.duration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[

            'duration' => 'required|string|max:200|unique:duration,duration',
        ]);
        
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $duration = new Duration;
        $duration->duration=$request->duration;
        $duration->save();
        
        return redirect()->back()->with("success", "Duration has been Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $duration=Duration::where('id',$id)->first();
        if ($duration) {

            $duration_data=$duration;
            $view_data=view('backend.duration.component.modal',compact('duration_data'))->render();
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
        $validator = Validator::make($request->all(),[
            'duration' => 'required|string|max:200|unique:duration,id,'.$id,
        ]);
        
        if ($validator->fails()) {
            // return $validator->errors();
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            /* return 'error'; */
        }

        $duration = Duration::findOrFail($id);
        $duration->duration=$request->duration;
        $duration->save();
        
        return redirect()->back()->with("status", "Duration has been Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $duration=Duration::findOrFail($id);
        $duration->delete();
        return redirect()->back();
    }
}
