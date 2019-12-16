<?php

namespace App\Http\Controllers;
use App\Discussion;
use Auth;
use Session;

use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function index(){

        return view('discuss');
    }

    public function store(){
        $this->validate(request(), [
            'channel_id' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => request()->title,
            'content' => request()->content,
            'channel_id' => request()->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug(request()->title)
        ]);

        Session::flash('success', 'Discussion created successfully');
        return redirect()->back();
    }
}
