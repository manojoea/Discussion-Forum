@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update discussion</div>

                    <div class="panel-body">
                        <form action="{{route('discussions.update', $discussion->id)}}" method="post">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="content">Ask a question</label>
                                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$discussion->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right">Save discussion changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
