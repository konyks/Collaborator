<a href="{{ route('group.profile', ['groupID' => $group->id])}}" class="btn btn-sq-lg btn-default" style="margin-button: 15px;margin-top: 15px; margin-right: 15px; margin-left: 15px">
    <i class="fa fa-users fa-5x"></i><br/>
    <div class="group-name"><b>{{$group->name}}</b></div>
    <b>{{$group->department}}</b>
</a>

