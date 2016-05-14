@extends('templates.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-9">
                <h3 align="center">Create Group</h3>
                <hr>
                <form class="form-vertical" role="form" method="post" action="{{ route('group.create')}}">
                    <div style="margin-bottom: 25px" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="10">
                        @if($errors->has('name'))
                            <span class="help-block">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div style="margin-bottom: 25px" class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                        <label for="department" class="control-label">Academic Department</label>
                        <select class="form-control" name="department" id="department">
                            @foreach($departments as $department)
                                <option>{{$department}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('department'))
                            <span class="help-block">{{$errors->first('department')}}</span>
                        @endif
                    </div>
                    <div style="margin-bottom: 25px" class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="department" class="control-label">Description</label>
                        <textarea placeholder="Few words about your group." name="description" class="form-control" rows="10"></textarea>
                        @if($errors->has('description'))
                            <span class="help-block">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@stop