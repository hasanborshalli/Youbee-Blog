<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $fields=$request->validate([
            "username"=>["required","min:4","max:20",Rule::unique('users', 'username')],
            "password"=>["required","min:6","max:255","confirmed"],
            "email"=>["required","email",Rule::unique('users', 'email')],
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $user=User::create($fields);
        auth()->login($user);
        return redirect('/home')->with('success', "Signed up successfully. Welcome ".$user->username." to YOUBEE BLOG");
    }
    public function login(Request $request)
    {
        $fields=$request->validate([
            "username"=>"required",
            "password"=>"required"
        ]);
        if (auth()->attempt(['username'=>$fields['username'],'password'=>$fields['password']])) {
            return redirect('/home')->with('success', 'Logged in successfully. Welcome Back '.$fields['username']);
        } else {
            return redirect('/login')->with("success", "Wrong Credentials");
        }
    }
    public function viewUser(User $user)
    {
        return view('author', ["user"=>$user,
                               "nbPosts"=>count($user->posts),
                               "posts"=>$user->posts()->orderBy('created_at', 'desc')->paginate(2),
                                "nbFollowers"=>count($user->followers),
                                "nbFollowings"=>count($user->followings),
                                "followers"=>$user->followers,
                                "followings"=>$user->followings
                            ]);
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with("success", "Logged out");
    }
    public function follow(User $user)
    {
        if($user->is_followed_by_user()) {
            $user->followers()->where('user_id', auth()->id())->delete();
            return response()->json(['followed'=>false]);
        }
        $fields=['user_id'=>auth()->id(), 'followed_id'=>$user->id];
        Follower::create($fields);
        return response()->json(['followed'=>true]);

    }

}