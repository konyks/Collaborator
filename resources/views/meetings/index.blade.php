@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('group.partials.groupnav')
        </div>
        <div class="col-md-10">
            @include('meetings.partials.nav')
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="meeting">
                    <h3>{{$group->name}}`s Meetings</h3>

                    <p>Today is {{Carbon\Carbon::today()->toFormattedDateString()}}</p>

                    <hr>
                    @if($meetings->count())
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Attendees</th>
                                <th>Confirm Attendance</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($meetings as $meeting)
                                <tr>
                                    <td>{{$dt = Carbon\Carbon::parse($meeting->time)->toDayDateTimeString()}}</td>
                                    <td>{{$meeting->location}}</td>
                                    <td align="center">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#AttModal{{$meeting->id}}">
                                            {{$meeting->users()->get()->count()}}  <i class="fa fa-eye"></i>
                                        </button>
                                        <div class="modal fade" id="AttModal{{$meeting->id}}" tabindex="-1" role="dialog" aria-labelledby="ProfileModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="ProfileModalLabel">Meeting Attendees</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($meeting->users()->get()->count())
                                                        <div class="row">
                                                            @foreach($meeting->users()->get() as $user)
                                                                <div class="col-md-6">
                                                                    <a class="pull-left" href="{{ route('profile.index', ['username' => $user->username])}}">
                                                                        <img src="{{ asset('avatars/'.$user->getAvatarName()) }}" class="img-circle" alt="{{ $user->getNameOrUsername()}}" width="100" height="100">
                                                                    </a>
                                                                    <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $user->username])}}" style="text-decoration:none">{{ $user->getNameOrUsername()}}</a></h4>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        @else
                                                            <p>No Attendees.</p>
                                                            <p><i class="fa fa-frown-o fa-5x" aria-hidden="true"></i></p>
                                                            <p>Click <a href="{{ route('meeting.confirm', ['meetingId'=>$meeting->id])}}" class="btn btn-success">Confirm</a> and be the first one.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center">
                                        @if (Auth::user()->isInMeeting($meeting))
                                            <a href="{{ route('meeting.decline', ['meetingId'=>$meeting->id])}}" class="btn btn-danger">Decline</a>
                                        @else
                                            <a href="{{ route('meeting.confirm', ['meetingId'=>$meeting->id])}}" class="btn btn-success">Confirm</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>There are no meetings present.</p>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="schedule">
                    <h3>Meeting Scheduler</h3>
                    <h4 align="center">{{Carbon\Carbon::today()->toFormattedDateString()}}</h4>
                    <hr>
                    <form class="form-vertical" role="form" method="post" action="{{route('meetings.create')}}">
                        <div style="overflow:hidden;">
                            <div class="form-group">
                                <div id="picker">
                                    <input type='hidden' name="time" class="form-control" />
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#picker').datetimepicker({
                                        inline: true,
                                        sideBySide: true
                                    });
                                });
                            </script>
                        </div>
                        <div style="margin-bottom: 25px" class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="control-label">Location</label>
                            <input type="text" name="location" class="form-control" id="location" placeholder="ex: Library">
                            @if($errors->has('location'))
                                <span class="help-block">{{$errors->first('location')}}</span>
                            @endif
                        </div>
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Schedule</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
