<?php

namespace App\Http\Controllers;
use App\Discussion;
use App\Reply;
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
            $req = request(),

            'title' => $req->title,
            'content' => $req->content,
            'channel_id' => $req->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug($req->title)
        ]);

        Session::flash('success', 'Discussion created successfully');
        return redirect()->route('discussion',  $discussion->slug);

    }

    public function show($slug){
        return view('discussions.show')->with('d', Discussion::where('slug', $slug)->first());
    }

    public function reply($id){
        $d = Discussion::find($id);
        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        Session::flash('success', 'Replied to discussion');
        return redirect()->back();
    }
}
