@extends('layouts.app')

@section('content')

    @foreach($discussions as $d)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{$d->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name}}</span>&nbsp;&nbsp;<span class="text-muted" style="font-size: 10px;font-weight: bold; color: #5e5e5e;"> {{$d->created_at->diffForHumans()}}</span>
                @if($d->hasBestAnswer())
                    <span class="label label-success pull-right ">Closed</span>
                @else
                    <span class="label label-danger pull-right ">Open</span>
                @endif
                <a href="{{route('discussion',  $d->slug)}}" class="btn btn-default pull-right" style="margin-right: 10px;">View</a>
            </div>

            <div class="panel-body">
                <h4 class="text-center">
                    <b>{{$d->title}}</b>
                </h4>
                <hr>
                <p class="text-center">
                    {{str_limit($d->content, 70)}}
                </p>
            </div>
            <div class="panel-footer">
                <p class="text-muted">{{$d->replies->count()}} Replies</p>
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{$discussions->links()}}
    </div>








@endsection
