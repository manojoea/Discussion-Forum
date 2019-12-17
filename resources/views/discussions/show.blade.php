@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px" class="img-circle">&nbsp;&nbsp;&nbsp;
            <span>{{$d->user->name}}</span>&nbsp;&nbsp;<span class="text-muted" style="font-size: 10px;font-weight: bold; color: #5e5e5e;"> {{$d->created_at->diffForHumans()}}</span>
{{--            <a href="{{route('discussion',  $d->slug)}}" class="btn btn-default pull-right">View</a>--}}
        </div>

        <div class="panel-body">
            <h3 class="text-center">
                {{$d->title}}
            </h3>
            <hr>
            <p class="text-center">
                {{$d->content}}
            </p>
        </div>
        <div class="panel-footer">
            <p class="text-muted">{{$d->replies->count()}} Replies</p>
        </div>
    </div>

    @foreach($d->replies as $r)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{$r->user->avatar}}" alt="" width="40px" height="40px" class="img-circle">&nbsp;&nbsp;&nbsp;
                <span>{{$r->user->name}}</span>&nbsp;&nbsp;<span class="text-muted" style="font-size: 10px;font-weight: bold; color: #5e5e5e;"> {{$r->created_at->diffForHumans()}}</span>

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

        </div>
    </div>

@endsection
