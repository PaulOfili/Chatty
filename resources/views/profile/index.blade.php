@extends ('templates.default')

@section('content')    
<div class="row">
    <div class="col-lg-5">
        @include('user.partials.userblock')
        <hr>

        @if(!$statuses->count()) 
            <p>Nothing to show here, update your status and add more friends to start connecting</p>
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
                            <a href="{{route('profile.index', ['username'=> $reply->user->getNameOrUsername()])}}" class="pull-left">
                                <img src="../profile1.png" width="45" height = "45" alt="" class="media-object">
                            </a>
                            <div class="media-body">
                            <h4 class="media-heading"><a href="{{route('profile.index', ['username'=> $reply->user->username])}}">{{$reply->user->username}}</a></h4>
                                <p>{{$reply->body}}</p>
                                <ul class="list-inline">
                                    <li>{{$reply->created_at->diffForHumans()}}</li>
                                    <li><a href="#">Like</a></li>
                                    <li>10 likes</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                
                @if(Auth::user()->isFriendsWith($user) || Auth::user()->id===$user->id)
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
                @endif
                </div>
            </div>
            @endforeach

            {!! $statuses->render() !!}
        @endif
    </div>
    <div class="col-lg-4 col-lg-offset-3">

        @if (Auth::user()->hasFriendRequestsPending($user))
            <p>Waiting for {{$user->getNameOrUsername()}} to accept your friend request.</p>
        @elseif (Auth::user()->isFriendsWith($user))
            <p>You and {{$user->getFirstNameOrUsername()}} are friends</p>
        @elseif (Auth::user()->hasFriendRequestsReceived($user))
            <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary">Accept friend request</a> 
        @elseif($user->username !== Auth::user()->username)
            <a href="{{ route('friend.add', ['username' => $user->username]) }}" class="btn btn-primary">Add as friends</a>
            
        @endif

        <h4>{{ $user->getFirstNameOrUsername() }}'s friends</h4>

        @if (!$user->friends()->count())
            <p>{{$user->getFirstNameOrUsername()}} has no friends</p>
        @else
            @foreach($user->friends() as $user)
                @include('user.partials.userblock')
            @endforeach
        @endif
    </div>
</div>
@endsection

