<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Blog;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blog = Blog::latest()->paginate(10);
        if ($request->ajax()) {
            return $blog;
        } else {
            return view('backend.blog.list',compact('blog'));
        }
        
    }

    public function comments($id)
    {
        $comments = Comment::where('blog_id',$id)->get();
        return view('backend.blog.comments',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $categories = \App\Models\Category::where('category_type','blog')->get();

        return view('backend.blog.create',compact('categories'));
    }

    public function postCategory()
    {
        $categories = \App\Models\Categories::with('parentCategory')->get();

        return view('admin.post.post_categories',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'required|string|max:191|unique:blogs',
            'short_desc' => 'required|required|max:191',
            'long_desc' => 'required',
        ]);

        $blog = new Blog;
        $destinationPath = 'uploads/'; $filename = null; $path_filename = null;
        $req = $request->all();

        $req['long_desc'] = \DB::connection()->getPdo()->quote(utf8_encode($request->long_desc));

        if ($request->hasFile('image')) {
            
            $file = $request->file('image');
            $destinationPath = 'uploads/' ;
            $f_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $f_extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $formatfilename = preg_replace('/[^\w]+/', '_', $f_name);
            $filename = date('Ymd_hisa').'_'.$formatfilename.'.'.$f_extension;
            $uploadSuccess = $file->move($destinationPath, $filename);
            $path_filename = 'uploads/'.$filename;

            $req['image'] = $path_filename;

        }

        //$req = collect($req);
        $blog->user_id=auth()->user()->id;
        $blog->fill($req);
        $blog->save();

        if($request->blog_cat){
            foreach($request->blog_cat as $cat){
                $blog_cat[] = ['blog_id' => $blog->id,'cat_id' => $cat];
            }
            \App\Models\BlogCategory::insert($blog_cat);
        }
        
        return redirect()->back()->with("status", "Blog has been created.");
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

    public function updateStatus($id)
    {
        $post=Blog::findOrFail($id);
        $post->status=0;
        $post->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog=Blog::findOrFail($id);
        $categories = \App\Models\Category::where('category_type','blog')->get();
        //dd($blog->tags->pluck('tag')->toArray());
        
        return view('backend.blog.create',compact('categories','blog'));
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
        $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'required|string|max:191',
            'short_desc' => 'required|required|max:191',
            'long_desc' => 'required',
        ]);
         
        $blog=Blog::findOrFail($id);
        
        $destinationPath = 'uploads/'; $filename = null; $path_filename = null;

        $req = $request->all();

        $req['long_desc'] = \DB::connection()->getPdo()->quote($request->long_desc);

        if ($request->hasFile('image')) {
            
            $file = $request->file('image');
            $destinationPath = 'uploads/';
            $f_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $f_extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $formatfilename = preg_replace('/[^\w]+/', '_', $f_name);
            $filename = date('Ymd_hisa').'_'.$formatfilename.'.'.$f_extension;
            $uploadSuccess = $file->move($destinationPath, $filename);
            $path_filename = 'uploads/'.$filename;

            $req['image'] = $path_filename;

        }

        //$req = collect($req);
        
        $blog->fill($req);
        $blog->save();
        
        $blog->categories()->delete();
        if($request->blog_cat){
            foreach($request->blog_cat as $cat){
                $blog_cat[] = ['blog_id' => $blog->id,'cat_id' => $cat];
            }
            \App\Models\BlogCategory::insert($blog_cat);
        }
        
        return redirect()->back()->with("status", "Blog has been Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=Blog::findOrFail($id);
        $blog->delete();
        return redirect()->back()->with("status", "Blog has been deleted.");
    }
}
