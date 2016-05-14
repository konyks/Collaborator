@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(!$groups->count())
                <p>There are no groups available yet.</p>
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
            <div align="center">
                {!!$groups->render()!!}
            </div>
        </div>
    </div>
@stop