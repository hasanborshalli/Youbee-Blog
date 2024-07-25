<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function signupPage()
    {
        return view('signup');
    }
    public function loginPage()
    {
        return view('login');
    }
    public function aboutPage()
    {
        return view('about');
    }
    
    public function homePage()
    {
        $posts=Post::orderBy('created_at', 'desc')->paginate(2);
        return view('home', ["posts"=>$posts]);
    }
    public function newpostPage()
    {
        return view('newpost');
    }
    public function postPage()
    {
        return view('post');
    }
    public function searchPage(Request $request)
    {
        $fields=$request->validate([
            'search' =>['required','max:255']
        ]);
        $posts=Post::search($fields['search'])->paginate(2);
        return view('home', ["posts"=>$posts]);

    }
    public function changeAvatar(User $user, Request $request)
    {
        $fields=$request->validate([
            'avatar' =>['required','image','mimetypes:image/jpeg,image/png,image/gif','max:2048']
        ]);
        $file=$request->file('avatar');
        $customName=auth()->id().'-'.Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/avatars/'.$customName);
        $user->avatar=$customName;
        $user->save();
        return redirect('/user/'.auth()->id())->with('success', "You have changed your avatar successfully");
    }
}