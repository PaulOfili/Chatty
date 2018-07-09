<div class="media">
    <a href="{{ route('profile.index', ['username' => $user->username]) }}" class="pull-left">
        <img src="../profile1.png" width="45" height = "45" alt="{{$user->getNameOrUsername()}}" class="media-object">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username]) }}">{{ $user->getNameOrUsername()}}</a></h4>
       
        @if ($user->location)
            <h5>{{ $user->location }}</h5>  
        @endif
    </div>
</div>
