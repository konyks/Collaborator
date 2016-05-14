<div class="media">
    <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username])}}">
        <img src="{{ asset('avatars/'.$user->getAvatarName()) }}" class="img-circle" alt="{{ $user->getNameOrUsername()}}" width="100" height="100">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username])}}" style="text-decoration:none">{{ $user->getNameOrUsername()}}</a></h4>
        @if(!$user->major && !$user->location && !$user->bio)
            <h4>{{$user->getNameOrUsername()}} decided to remain anonymous</h4>
        @endif
        @if ($user->major)
            <p><strong>Major: </strong>{{$user->major}}</p>
        @endif
        @if ($user->location)
            <p><strong>Location: </strong>{{$user->location}}</p>
            <p><strong>E-mail: </strong>{{$user->email}}</p>
        @endif
        @if ($user->bio)
        	<p><strong>About {{$user->getNameOrUsername()}}: </strong></p>
            <p>{{$user->bio}}</p>
        @endif
    </div>
</div>