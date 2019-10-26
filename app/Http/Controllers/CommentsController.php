<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        // add a comment to A POST
        // $post->addComment(request('body'))

        $this->validate(request(),['body' => 'required|min:2']);
        
        // return request();

        $comment = new Comment;

        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post->id;
        $comment->body = request("body");
        
        $comment->save();
        
        // $post->addComment(request('body'));
        
        return back();
    }
}
