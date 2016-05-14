@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>{{Auth::user()->getNameOrUsername()}}'s Groups</h3>
            @if(!$groups->count())
                <p>You are not a part of any study group</p>
            @else
                <div class="row">
                    @foreach ($groups as $group)
                        @include('group.partials.groupblock')
                    @endforeach
                </div>
            @endif
            <div align="center">
                {!!$groups->render()!!}
            </div>
        </div>
        @if($adminGroups->count())
        <div class="col-lg-6">
            <h3>Administrator</h3>
                <div class="row">
                    @foreach ($adminGroups as $group)
                        @include('group.partials.groupblock')
                    @endforeach
                </div>
            <div align="center">
                {!!$adminGroups->render()!!}
            </div>
        </div>
        @endif
    </div>
@stop