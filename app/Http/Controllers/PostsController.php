<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']); // means that middleware will lock down other methods except for index and show if not auth
    }

    public function index()
    {
        $posts = Post::latest() // latest is a query scope *uses orderBy desc, oldest() is the reverse
        ->filter(request()) // filter is a custom defined query scope in Post Model | if no request is passed filter will be ignored
        ->get();
        // dd($posts);
        // return $posts;
        // return request(); this is the month and the year in the url request

        return view('posts.index', compact('posts'));

        // return view('posts.index')->with('posts', $posts)->with('archives', $archives); // or use compact($posts)
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($id)
    {
        // or use Route Model Binding 
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function myPosts()
    {
        $userID = auth()->user()->id;

        // var_dump($userID);

        $posts = Post::where('user_id', $userID)->get();

        // return response()->json($posts);

        return view('posts.myPosts')->with('posts', $posts);
    }

    public function store()
    {
        // redirects back to page if error with populated error variables to be used
        $this->validate(request(), [

            'title' => 'required',
            'body' => 'required'
        ]); // check documentation for more indepth on validation 

        // $post = new Post;
        
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->user_id = auth()->id();  // or auth()->user()->id 

        // $post->save();

        // user can PUBLISH A POST

        auth()->user()->publish(

            new Post(request(['title', 'body']))
            
        );        
        
        // Post::create([

        //     'title' => request('title'),
        //     'body' => request('body')

        // ]); // use onlywhen you define $fillables in Model, otherwise will throw a MassAssignmentException

        // Post::create(request(['title', 'body'])); use with safeguards
        
        return redirect('/');

        //create a new post using the request data
        //save to DB
        //redirect to a page

        // var_dump(request('title'));
        // var_dump(request(['title', 'body'])); useful for objects with a lot of data
        // var_dump(request()->all());
    }
}
