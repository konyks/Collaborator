@extends('templates.default')

@section('content')
	<h3>Your search for "{{Request::input('query')}}"</h3>
    <div class="row">
        <div class="col-lg-6">
            @if (!$groups->count())
                <p>No study groups were located.</p>
            @else
            <div class="row">
                @foreach ($groups as $group)
                        @include('group.partials.groupblock')
                @endforeach
                <hr>
            </div>
            @endif
        </div>
    </div>
@stop