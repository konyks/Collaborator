<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" rel="home" href="{{ route('home')}}" title="Buy Sell Rent Everyting">
                <img id="project-logo" alt="Collaborator" src="{{ asset('img/group_project.png') }}">
            </a>
        </div>
        @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="{{route('home')}}"><b>Dashboard <i class="fa fa-th"></i></b></a></li>
                <li><a href="{{route('group.index')}}"><b>Groups <i class="fa fa-users"></i></b></a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="{{route('search.results')}}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find study groups">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
            </form>
        @endif
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li class="dropdown">
                    <a href="{{route('profile.index', ['username' => Auth::user()->username])}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('avatars/'.Auth::user()->getAvatarName()) }}" class="img-circle" alt="{{ Auth::user()->getNameOrUsername()}}" width="20" height="20"> <b>{{ Auth::user()->getNameOrUsername() }} <i class="fa fa-caret-down"></i></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('profile.index', ['username' => Auth::user()->username])}}"><img src="{{ asset('avatars/'.Auth::user()->getAvatarName()) }}" class="img-circle" alt="{{ Auth::user()->getNameOrUsername()}}" width="100" height="100"> View Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('profile.groups')}}"><i class="fa fa-users"></i> My Groups </a></li>
                        <li><a href="{{route('profile.edit')}}"><i class="fa fa-pencil"></i> Update Profile </a></li>
                        <li><a href="{{route('profile.changepassword')}}"><i class="fa fa-key"></i> Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('issue')}}"><i class="fa fa-bug" aria-hidden="true"></i> Report a Problem</a></li>
                        <li><a href="{{route('feedback')}}"><i class="fa fa-smile-o" aria-hidden="true"></i> User Feedback</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('auth.signout')}}"> <i class="fa fa-sign-out"></i> Sign Out</a></li>
                    </ul>
                </li>
            @else
                <li><a href="{{route('auth.signup')}}"><b>Sign Up  <span class="glyphicon glyphicon-check"></span></b></a></li>
                <li><a href="{{route('auth.signin')}}"><b>Sign In  <span class="glyphicon glyphicon-log-in"></span></b></a></li>
            @endif
        </ul>
    </div>
</nav>
