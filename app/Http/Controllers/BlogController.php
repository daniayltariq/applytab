<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $blogs = new Blog;

        $recent_posts = Blog::with('category')->latest()->limit(3)->get();
            
        if($request->query('q')){
            $blogs = $blogs->where('title','LIKE','%'.$request->query('q').'%');
            
        }

        $blogs = $blogs->with('user')->paginate(5);

        $categories = Category::limit(5)->get();

        return view('frontend.pages.blog',compact('blogs','recent_posts','categories'));
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Blog::where('slug',$slug)->with('category')->first();
        $recent_posts = Blog::where('slug','!=',$slug)->with('category')->latest()->limit(2)->get();
        if(!$post){
            abort(404);
        }
        
        return view('frontend.pages.blog-single',compact('post','recent_posts'));
         
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
        $categories = \App\Categories::with('parentCategory')->get();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function comment_post(Request $request){

        // Prevent bots, Human won't fill it because its hidden
        if($request->username){
            return "false";
        }

        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'website'      => 'nullable|string|max:191',
            'comment' => 'required|string|max:50000',
            'reply_to_id' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return $this->formatError($validator);
        }

        $validator = Validator::make($request->all(),[
             'recaptcha' => 'required|recaptcha'
         ],[
            'recaptcha.required' => "Recaptcha is required.",
            'recaptcha.recaptcha' => "Recaptcha is not valid.",
            'validation.recaptcha' => "Recaptcha is not valid.",
         ]);

        if ($validator->fails()) {
            return $this->formatError($validator);
        }

        $comment = new Comment;
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->comment = $request->comment;
        $comment->reply_to = $request->reply_to_id ?? null;
        $comment->save();
       
        return response()->json([
                'status' => 200, 
                'msg' => $this->formatSuccess('Comment added successfully.'),
            ]);
    }

    /**
     * 
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function byCategory($slug,Request $request){

        $category  = Categories::where('slug',$slug)->first();

        if(!$category){
            abort(404);
        }

        $blogs = new Blog;

        $recent_posts = \App\Blog::with('category')->latest()->limit(5)->get();
         
        if($request->query('q')){
            $blogs = $blogs->where('title','LIKE','%'.$request->query('q').'%');
        }

        $blogs = $blogs->whereHas('all_categories',function($q) use ($slug){
            $q->where('slug',$slug);
        });

        $blogs = $blogs->with('user')->paginate(5);

        $categories = Categories::limit(5)->whereNotNull('slug')->inRandomOrder()->get();

        $related_tags = Tag::limit(10)->inRandomOrder()->get();

        $page_title = $category->category_name;

        return view('frontend.views.blogs',compact('blogs','recent_posts','related_tags','categories','page_title'));

    }

    /**
     * 
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function byTag($slug,Request $request){
  

        $blogs = new Blog;

        $recent_posts = \App\Blog::with('category')->latest()->limit(5)->get();
         
        if($request->query('q')){
            $blogs = $blogs->where('title','LIKE','%'.$request->query('q').'%');
        }

        $blogs = $blogs->whereHas('tags',function($q) use ($slug){
            $q->where('tag',$slug);
        });

        $blogs = $blogs->with('user')->paginate(5);

        $categories = Categories::limit(5)->whereNotNull('slug')->inRandomOrder()->get();

        $related_tags = Tag::limit(10)->inRandomOrder()->get();

        $page_title = ucwords($slug);

        return view('frontend.views.blogs',compact('blogs','recent_posts','related_tags','categories','page_title'));

    }

}
