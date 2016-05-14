@extends('templates.default')

@section('content')
    <div class="row">
        <h4><b>Study Groups of {{$department}} Department</b></h4>
        <hr>
        <div class="col-lg-6">
            @if(!$groups->count())
                <p>There are no groups available for your selection yet.</p>
                <p>Be the first one to create one!</p>
                <a href="{{route('group.create')}}">
                    <button class="btn btn-primary">
                        Create Group
                    </button>
                </a>
            @else
                <div class="row">
                    @foreach ($groups as $group)
                            @include('group.partials.groupblock')
                    @endforeach
                </div>
                <hr>
            @endif
        </div>
    </div>
@stop