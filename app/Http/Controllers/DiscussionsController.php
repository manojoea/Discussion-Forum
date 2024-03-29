<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Reply;
use App\User;
use Auth;
use Illuminate\Support\Facades\Notification;
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
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
        return view('discussions.show')->with('d',$discussion )->with('best_answer', $best_answer);
    }

    public function reply($id){

        $d = Discussion::find($id);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'discussion_id' => $id,
            'content' => request()->reply
        ]);

        $reply->user->points += 25;
        $reply->user->save();


        $watchers = array();

        foreach ($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id));
        endforeach;

//        dd($watchers);
        Notification::send($watchers, new \App\Notifications\NewReplyAdded());


        Session::flash('success', 'Replied to discussion');
        return redirect()->back();
    }

    public function edit($slug){
        return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);


    }

    public function update($id){
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);
        $d->content = request()->content;
        $d->save();
        Session::flash('success', 'Discussion updated');
        return redirect()->route('discussion', $d->slug);
    }
}
