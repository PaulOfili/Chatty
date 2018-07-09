@extends ('templates.default')

@section('content')
    <div class="row">
        <div class="col-sm-6">
        <form action="{{ route('status.post')}}" method="post" role="form">
                <div class="form-group{{$errors->has('status') ? ' has-error' : ''}}">
                    <textarea placeholder="What's up {{Auth::user()->getFirstNameOrUsername()}}" name="status" rows="3" class="form-control"></textarea>
                    @if ($errors->has('status'))
                            <span class="help-block">{{$errors->first('status')}}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Update status</button>
            <input type="hidden" name="_token" value={{Session::token()}}>
            </form>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5">
            {{-- <p class="lead">Timeline status and replies</p>  --}}
            @if(!$statuses->count()) 
                <p>Nothing to show here, add more friends</p>
            @else
                @foreach($statuses as $status)
                <div class="media">
                    <a href="{{route('profile.index', ['username'=> $status->user->username])}}" class="pull-left">
                        <img src="../profile1.png" width="45" height = "45" alt="" class="media-object">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{{route('profile.index', ['username'=> $status->user->username])}}">{{$status->user->getNameOrUsername()}}</a></h4>
                        <p>{{$status->body}}</p>
                        <ul class="list-inline">
                            <li>{{$status->created_at->diffForHumans()}}</li>
                            <li><a href="#">Like</a></li>
                            <li>10 likes</li>
                        </ul>                   

                        @foreach($status->replies as $reply)
                            <div class="media">
                                <a href="{{route('profile.index', ['username'=> $reply->user->username])}}" class="pull-left">
                                    <img src="../profile1.png" width="45" height = "45" alt="" class="media-object">
                                </a>
                                <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('profile.index', ['username'=> $reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a></h4>
                                    <p>{{$reply->body}}</p>
                                    <ul class="list-inline">
                                        <li>{{$reply->created_at->diffForHumans()}}</li>
                                        <li><a href="#">Like</a></li>
                                        <li>10 likes</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    <form action="{{route('status.reply', ['statusId'=>$status->id])}}" role="form" method="post">
                        <div class="form-group{{$errors->has("reply-{$status->id}") ? ' has-error' : ''}}">
                        <textarea name="reply-{{$status->id}}" id="" rows="2" class="form-control" placeholder="Reply to this status"></textarea>
                        @if($errors->has("reply-{$status->id}"))
                            <span class="help-block">{{$errors->first("reply-{$status->id}")}}</span>
                        @endif
                        </div>
                        <input type="submit" value="Reply" class="btn btn-default btn-sm">
                        <input type="hidden" name="_token" value={{Session::token()}}>
                    </form>
                    </div>
                </div>
                @endforeach

                {!! $statuses->render() !!}
            @endif
        </div>
    </div>
@endsection