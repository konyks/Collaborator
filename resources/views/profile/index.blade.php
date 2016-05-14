@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-5">
            @include('user.partials.userblock')
        </div>
        <div class="col-md-5">
            <h4>{{$user->getFirstNameOrUsername()}}'s study groups.</h4>
            @if(!$groups->count())
                <p>{{$user->getFirstNameOrUsername()}} has no groups</p>
            @else
                <div class="row">
                    @foreach($groups as $group)
                        @include('group.partials.groupblock')
                    @endforeach
                </div>
                <div align="center">
                    {!!$groups->render()!!}
                </div>
            @endif
        </div>
        @if(Auth::user()->id == $user->id)
        <div class="col-md-2">
            <div align="right">
                <a href="{{route('profile.edit', ['username' => Auth::user()->username])}}">
                    <button class="btn btn-default">
                        <i class="fa fa-pencil"></i> Update
                    </button>
                </a>
            </div>
        </div>
        @endif
    </div>
    @if(Auth::user()->id != $user->id)
        <hr>
        <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
    @endif
@stop