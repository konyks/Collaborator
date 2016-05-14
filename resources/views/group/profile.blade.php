@extends('templates.default')
@section('content')
    @if (Auth::user()->isInGroup($group))
    <div class="row">
    @endif
            @if (Auth::user()->isInGroup($group))
                <div class="col-md-2 sidebar-offcanvas">
                    @include('group.partials.groupnav')
                </div>
            @endif
            @if (Auth::user()->isInGroup($group))
            <div class="col-md-10">
            @endif
                <div class="row">
                    <div class="col-md-10"><h3>Profile</h3></div>
                    <div class="col-md-2">
                        <div align="right">
                            @if (Auth::user()->isInGroup($group))
                                <a href="{{ route('group.delete', ['groupId'=>$group->id])}}" class="btn btn-primary">Unjoin <i class="fa fa-user-times"></i></a>
                            @else
                                <a href="{{ route('group.add', ['groupId'=>$group->id])}}" class="btn btn-primary">Join <i class="fa fa-user-plus"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr>
                <label for="name">Group Name</label>
                <h1>{{$group->name}}</h1>
                <label for="department">Academic Department</label>
                <h4>{{$group->department}}</h4>
                <hr>
                <label for="description">Group`s Description</label>
                <div class="well-lg">
                    <p>{{$group->description}}</p>
                </div>
                <hr>
                @if(Auth::user()->isInGroup($group))
                    <h3>Group Members</h3>
                    <div class="row">
                        @foreach($users as $user)
                            <div class="col-md-4">
                                <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username])}}">
                                    <img src="{{ asset('avatars/'.$user->getAvatarName()) }}" class="img-circle" alt="{{ $user->getNameOrUsername()}}" width="100" height="100">
                                </a>
                                <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username])}}" style="text-decoration:none">{{ $user->getNameOrUsername()}}</a></h4>
                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ProfileModal{{$user->id}}">
                                    View Profile
                                </button>
                                <div class="modal fade" id="ProfileModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="ProfileModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="ProfileModalLabel">{{$user->getNameOrUsername()}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @include('user.partials.userblockmodal')
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('profile.index', ['username' => $user->username])}}" class="btn btn-primary">View More</a>
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            @if (Auth::user()->isInGroup($group))
            </div>
            @endif
        @endif
    @if (Auth::user()->isInGroup($group))
    </div>
    @endif
@stop
