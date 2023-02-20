<?php

namespace App\Http\Controllers\Admin;
use App\Models\Faqs;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = Faqs::when($request->query('search_text'),function($q){
                    $q->where('title','like','%'.request()->query('search_text').'%')->orWhere('description','like','%'.request()->query('search_text').'%');
                })->orderBy('id','DESC')->paginate(10);
        
        return view('backend.faqs.list', compact('faqs'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.faqs.create');
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
            'title'  => 'required|string|max:50',
            'description' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $faq=Faqs::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with("success", "Data Saved.");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $faq=Faqs::find($id);
        // dd($model); 
        return view('backend.faqs.create',compact('faq'));
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
        // dd($request->all(),$make,$model);
        $validator = Validator::make($request->all(),[
            'title'  => 'required|string',
            'description' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $faq=Faqs::find($id);
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->save();
        
        return redirect()->back()->with("success", "Data updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq=Faqs::findOrFail($id);
        if ($faq) {
            //if faq model exist
            $faq->delete();
        }
        return redirect()->back();
    }

}
