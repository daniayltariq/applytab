<?php

namespace App\Http\Controllers\Admin;
use App\Models\Menu;
use App\Models\User;

use App\Models\Category;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cats = Category::all();
        
        return view('backend.category.list',compact('cats'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('backend.category.create',compact('cats'));
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

            'name' => 'required|string|max:200|unique:categories,category_name',
            // 'category_type' => 'required|string|in:blog,product',
        ]);
        
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = new Category;
        $category->category_name=$request->name;
        $category->category_type='product';
        $category->save();
        
        activity('category')
            ->performedOn($category)
            ->causedBy(auth()->user())
            ->withProperties(['category_id' => $category->id])
            ->log('Category created by ' . auth()->user()->name);

        return redirect()->back()->with("status", "category has been Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat=Category::where('id',$id)->first();
        if ($cat) {

            $cat_data=$cat;
            $view_data=view('backend.category.component.modal',compact('cat_data'))->render();
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
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:200|unique:categories,id,'.$id,
            // 'category_type' => 'required|string|in:blog,service',
        ]);
        
        if ($validator->fails()) {
            // return $validator->errors();
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            /* return 'error'; */
        }

        $category = Category::findOrFail($id);
        $category->category_name=$request->name;
        $category->category_type='product';
        $category->save();

        activity('category')
            ->performedOn($category)
            ->causedBy(auth()->user())
            ->withProperties(['category_id' => $category->id])
            ->log('Category updated by ' . auth()->user()->name);
        return redirect()->back()->with("status", "category has been Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=Category::findOrFail($id);
        if ($cat) {
            $cat->delete();
            activity('category')
                ->performedOn($cat)
                ->causedBy(auth()->user())
                ->withProperties(['category_id' => $cat->id])
                ->log('Category updated by ' . auth()->user()->name);
        }
       
        return redirect()->route('backend.category.index')->with('status', 'Category has been deleted!');
    }
}
