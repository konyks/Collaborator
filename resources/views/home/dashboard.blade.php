@extends('templates.default')

@section('content')
    <div class="well well-sm">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-7">
                    <h2>Welcome {{Auth::user()->getNameOrUsername()}}!</h2>
                    <img src="{{ asset('avatars/'.Auth::user()->getAvatarName()) }}" class="img-circle" alt="{{ Auth::user()->getNameOrUsername()}}" width="50" height="50">
                </div>
                <div class="col-md-5">
                    @if($group_count!=0)
                        <blockquote>
                            <p>You are a member of {{$group_count}} study groups</p>
                        </blockquote>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <h4 align="center">Collaborate, Learn, Inspire</h4>
    <h3 align="center">Create Your Own Study Group</h3>
    <div align="center">
        <a href="{{route('group.create')}}" align="center">
            <button class="btn btn-lg btn-primary" id="add-button">
                <i class="fa fa-plus-circle fa-4x"></i>
            </button>
        </a>
    </div>
    <hr>
    <h3 align="center">There are currently total of {{$total}} study groups available.</h3>
    <div class="well well-lg">
        <div class="row">
            @foreach($departments as $department)
                <div class="col-xs-12 col-sm-3">
                    <div class="summary-block summary-block-primary">
                        <div class="summary-background">
                            <i class="glyphicon glyphicon-education"></i>
                        </div>
                        <div class="summary-body">
                            <div class="summary-line-1">
                                <b>{{$department->total}}</b>
                            </div>
                            <div class="summary-line-2"><b>{{$department->department}}</b></div>
                        </div>
                        <div class="summary-footer">
                            <a href="{{ route('group.departmentgroup', ['department' => $department->department])}}"><b>VIEW GROUPS
                                <i class="glyphicon glyphicon-chevron-right"></i></b>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div align="center">
            {!!$departments->render()!!}
        </div>
    </div>
    <hr>
@stop
