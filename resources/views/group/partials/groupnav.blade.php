@if(Auth::user()->isInGroup($group))
    <ul class="nav nav-sidebar">
        <li><a href="{{route('group.profile', ['groupId'=>$group->id])}}"><b><i class="fa fa-users"></i>  Profile</b></a></li>
        @if(Auth::user()->isGroupAdmin($group))
        <li><a href="{{route('group.edit', ['groupId'=>$group->id])}}"><b><i class="fa fa-pencil"></i>  Edit Profile</b></a></li>
        @endif
        <li><a href="{{route('discussion.timeline', ['groupId'=>$group->id])}}"><b><i class="fa fa-commenting"></i>
                      Discussion</b></a></li>
        <li><a href="{{route('documents.index', ['groupId'=>$group->id])}}"><b><i class="fa fa-file-text"></i>  Documents</b></a></li>
        <li><a href="{{route('meetings.index', ['groupId'=>$group->id])}}"><b><i class="fa fa-calendar"></i>  Meetings</b></a></li>
    </ul>
@endif