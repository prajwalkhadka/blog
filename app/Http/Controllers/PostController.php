<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Validator;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        //
        $data=Post::all();
        return view('post.index')->with('data',$data);
        //return view('post.index',compact('data','data1',adsa));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cat=Category::pluck('title','id')->toArray();
        //dd($cat);
        return view('post.create')->with('cats',$cat);
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
            'title'=>'required|max:255',
            'category'=>'required',
            'body'=>'required',
            'image'=>'mimes:jpeg,bmp,png,jpg',

        ]);
        $data=new Post();
        $data->title=$request->get('title');
        $data->cat_id=$request->get('category');
        $data->body=$request->get('body');
        $data->user_id=Auth::id();


        if($request->hasFile('image')){
            $image=$request->file('image');
            $filename=time() . '.' . $image->getClientOriginalExtension();
            $Path=public_path('images/');
            $image->move($Path,$filename);

            $data->featured_img=$filename;
            
        }
        
        $data->save();
        return redirect()->route('post.index')->with('status','Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data=Post::find($id);
        return view('post.show')->with('data',$data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=Post::findorfail($id);
         $cat=Category::pluck('title','id')->toArray();
         $cats=key(Category::where('id',$data->cat_id)->pluck('title','id')->toArray());
        return view('post.edit')->with('data',$data)->with('cat',$cat)->with('cats',$cats);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
      
       $request->validate([
            'title'=>'required|max:255',
            'body'=>'required',
            'category'=>'required',
            'image'=>'mimes:jpeg,bmp,png,jpg',

        ]);
        $data= Post::findorfail($id);
        $data->title=$request->get('title');
        $data->cat_id=$request->get('category');
        $data->body=$request->get('body');
        $data->user_id=Auth::id();

        if($request->hasFile('image')){
            $image=$request->file('image');
            $filename=time() . '.' . $image->getClientOriginalExtension();
            $Path=public_path('images/');
            $image->move($Path,$filename);

            $data->featured_img=$filename;
            
        }
        
        $data->save();
        return redirect()->route('post.index')->with('status','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data=Post::findorfail($id);
        $data->delete();
        return redirect()->route('post.index')->with('status','Deleted successfully');

    }
}
