@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px" class="img-circle">&nbsp;&nbsp;&nbsp;
            <span>{{$d->user->name}} <b>( {{$d->user->points}} )</b></span>&nbsp;&nbsp;
            @if($d->hasBestAnswer())
                <span class="label label-success pull-right ">Closed</span>
            @else
                <span class="label label-danger pull-right ">Open</span>
            @endif
            @if(Auth::id() == $d->user->id)
                @if(!$d->hasBestAnswer())
                    <a href="{{route('discussion.edit', $d->slug)}}" class="btn btn-info pull-right btn-xs" style="margin-right: 10px;">Edit</a>

                @endif
            @endif
            @if($d->is_being_wached_by_auth_user())
                <a href="{{route('discussion.unwatch', $d->id)}}" class="btn btn-primary pull-right btn-xs" style="margin-right: 10px;">unWatch</a>
            @else
                <a href="{{route('discussion.watch', $d->id)}}" class="btn btn-info  pull-right btn-xs" style="margin-right: 10px;">Watch</a>
            @endif
        </div>

        <div class="panel-body">
            <h3 class="text-center">
                <b>{{$d->title}}</b>
            </h3>
            <hr>
            <p class="text-center">
                {{$d->content}}
            </p>

            <hr>

            @if($best_answer)
                <div class="text-center" style="padding: 40px;">
                    <h3 class="text-center">
                        Best Answer
                    </h3>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <img src="{{$best_answer->user->avatar}}" alt="" width="40px" height="40px" class="img-circle">&nbsp;&nbsp;&nbsp;
                            <span>{{$best_answer->user->name}} <b>( {{$best_answer->user->points}} )</b></span>
                        </div>
                        <div class="panel-body">
                            {{$best_answer->content}}
                        </div>
                    </div>
                </div>
            @endif

        </div>
        <div class="panel-footer">
            <span class="text-muted">{{$d->replies->count()}} Replies</span>
            <a href="{{route('channel', $d->channel->slug)}}" class="btn btn-default pull-right btn-xs">{{$d->channel->title}}</a>
        </div>
    </div>

    @foreach($d->replies as $r)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{$r->user->avatar}}" alt="" width="40px" height="40px" class="img-circle">&nbsp;&nbsp;&nbsp;
                <span>{{$r->user->name}} <b>( {{$r->user->points}} )</b></span>
                @if(!$best_answer)
                    @if(Auth::id() == $r->user->id)
                        <a href="{{route('discussion.best.answer', $r->id)}}" class="btn btn-xs btn-success pull-right" style="margin-left: 10px;">mark as best answer</a>
                    @endif

                @endif
                @if(Auth::id() == $r->user->id)
                    @if(!$best_answer)
                        <a href="{{route('reply.edit', $r->id)}}" class="btn btn-xs btn-info pull-right">Edit</a>

                    @endif
                @endif
            </div>

            <div class="panel-body">

                <p class="text-center">
                    {{$r->content}}
                </p>
            </div>
            <div class="panel-footer">

                @if($r->is_liked_by_auth_user())
                    <a href="{{route('reply.unlike', $r->id)}}" class="btn btn-danger btn-xs">Unlike <span class="badge"> {{$r->likes->count()}}</span></a>
                @else
                    <a href="{{route('reply.like', $r->id)}}" class="btn btn-primary btn-xs">Like <span class="badge"> {{$r->likes->count()}}</span></a>
                @endif
            </div>
        </div>
    @endforeach

    <div class="panel panel-default">
        <div class="panel-body">
            @if( Auth::check())
                <form action="{{route('discussion.reply', $d->id)}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="reply">Leave a reply...</label>
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm pull-right">Leave a reply</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h2>Sign in to leave a reply...</h2>
                </div>
            @endif

        </div>
    </div>

@endsection
