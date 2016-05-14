@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('group.partials.groupnav')
        </div>
        <div class="col-md-10">
            <h3>Edit Profile</h3>
            <hr>
            <form class="form-vertical" role="form" method="post" action="{{ route('group.update')}}">
                <div style="margin-bottom: 25px" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Group`s Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{$group->name}}" maxlength="10">
                    @if($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div style="margin-bottom: 25px" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="control-label">Group`s Description</label>
                    <textarea placeholder="Few words about your group." name="description" class="form-control" rows="10">{{$group->description}}</textarea>
                    @if($errors->has('description'))
                        <span class="help-block">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <input type="hidden" name="groupId" id="groupId" value="{{$group->id}}">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@stop