@extends ('templates.default')

@section('content')
   <div class="row">
       <div class="col-sm-6">
           <h3>Your friends</h3>
        @if (!$friends->count())
            <p>You have no friends</p>
        @else
            @foreach($friends as $user)
                @include('user.partials.userblock')
                <hr>
            @endforeach
        @endif
       </div>
       <div class="col-sm-6">           
           <h4>Friend Requests</h4>
        @if (!$requests->count())
            <p>You have no friend requests</p>
        @else            
            @foreach($requests as $user)
                <div class = "row">
                    <div class = "col-sm-8">
                        @include('user.partials.userblock')
                        
                    </div >
                    
                    <div class = "col-sm-4">
                        <a href="{{ route('friend.accept', ['username' => $user->username]) }}" class="btn btn-primary">Accept friends request</a>
                        {{-- @if(Auth::user()->hasFriendRequestsReceived($user))
                            <a href="#" class="btn btn-primary">Accept request</a>
                        @endif --}}
                    </div>                    
                </div>
                <hr>
            @endforeach                
        @endif
       </div>
   </div>
@endsection