<div class="well panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-4 text-center">
                <img src="{{ asset('avatars/'.$user->getAvatarName()) }}" class="img-circle" alt="{{ $user->getNameOrUsername()}}" width="100" height="100" alt="{{$user->getAvatarName()}}" class="center-block img-circle img-thumbnail img-responsive">
            </div>
            <div class="col-xs-12 col-sm-8">
                <h2>{{ $user->getNameOrUsername()}}</h2>
                @if(!$user->major && !$user->location && !$user->bio)
                    <h3>{{$user->getNameOrUsername()}} decided to remain anonymous</h3>
                @endif
                @if ($user->major)
                    <p><strong>Major: </strong>{{$user->major}}</p>
                @endif
                @if ($user->location)
                    <p><strong>Location: </strong>{{$user->location}}</p>
                    <p><strong>E-mail: </strong>{{$user->email}}</p>
                @endif
                @if($user->bio)
                    <p><strong>About {{$user->getFirstNameOrUsername()}}: </strong><br>{{$user->bio}}</p>
                @endif
            </div>
        </div>
    </div>
</div>