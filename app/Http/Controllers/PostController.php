<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function newpost(Request $request)
    {
        $fields=$request->validate([
            "title" => ["required", "min:1","max:100"],
            "content" => "required",
        ]);
        $fields['user_id']=auth()->id();
        $fields['title']=strip_tags($fields['title']);
        $fields['content']=strip_tags($fields['content']);
        $post=Post::create($fields);
        return redirect('/post/'.$post->id)->with('success', "'" .$post->title."' Post Added Successfully");

    }
    public function viewPost(Post $post)
    {
        
        return view('post', ["post"=>$post,"user"=>$post->user]);
    }
    public function editPostPage(Post $post)
    {
        return view('editPost', ["post"=>$post]);

    }
    public function editPost(Request $request, Post $post)
    {
        $fields=$request->validate([
            "title" => ["required", "min:1","max:100"],
            "content" => "required",
            ]);
        $fields['title']=strip_tags($fields['title']);
        $fields['content']=strip_tags($fields['content']);
        $post->title=$fields['title'];
        $post->content=$fields['content'];
        $post->save();
        return redirect('/post/'.$post->id)->with('success', "'" .$post->title."' Post Edited Successfully");

    }
    public function deletePost(Post $post)
    {
        $post->delete();
        return redirect('/home')->with('success', "'" .$post->title."' Post deleted Successfully");

    }
    public function comment(Request $request, Post $post)
    {
        $fields=$request->validate([
            "comment" =>"required"
            
        ]);
        $fields['comment']=strip_tags($fields['comment']);
        $fields['user_id']=auth()->id();
        $fields['post_id']=$post->id;
        $fields['comment_id']=null;
        Comment::create($fields);
        return redirect('/post/'.$post->id)->with('success', "Commented on '".$post->title."' Successfully");
        ;
    }
    public function reply(Request $request, Comment $comment)
    {
        $fields=$request->validate([
            "comment" =>"required"
            
        ]);
        $fields['comment']=strip_tags($fields['comment']);
        $fields['user_id']=auth()->id();
        $fields['post_id']=$comment->post_id;
        $fields['comment_id']=$comment->id;
        Comment::create($fields);
        return redirect('/post/'.$comment->post_id)->with('success', "replied on ".$comment->user->username."'s comment Successfully");
    }
    public function like(Post $post)
    {
        if($post->is_liked_by_user()) {
            $post->likes()->where('user_id', auth()->user()->id)->delete();
            return response()->json(['liked'=>false]);
        }
        $post->likes()->create(['user_id'=>auth()->user()->id]);
        return response()->json(['liked'=>true]);

    }
    public function share(Post $post)
    {
        $fields=["title"=>$post->title, "content"=>$post->content, "user_id"=>auth()->id()];
        $post=Post::create($fields);
        return redirect('/post/'.$post->id)->with('success', "Successfully shared!");
    }
    public function readLater(Request $request)
    {
        $fields=$request->validate([
            'id'=>['required','int']
        ]);
        $postId=$fields['id'];
        $readLater=session('read_later', []);
        if(in_array($postId, $readLater)) {
            //Remove
            $readLater=array_diff($readLater, [$postId]);
            session(['read_later'=>$readLater]);
            return response()->json(['status'=>'removed']);
        } else {
            //Add
            $readLater[]=$postId;
            session(['read_later'=>$readLater]);
            return response()->json(['status'=>'added']);
        }
    }
    public function savedPosts()
    {
        $savedPosts=session('read_later', []);
        $posts=Post::whereIn('id', $savedPosts)->paginate(2);
        return view('home', ['posts'=>$posts]);
    }
}