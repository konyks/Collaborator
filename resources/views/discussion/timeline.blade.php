@extends('templates.default')
@section('sidebar')
    @include('group.partials.groupnav')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('group.partials.groupnav')
        </div>
        <div class="col-md-10">
            @include('discussion.partials.nav')
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="timeline">
                    <h3>{{$group->name}}`s Discussion</h3>
                    <hr>
                    @if (!$posts->count())
                        <p>There are no posts yet. </p>
                    @else
                        @foreach ($posts as $post)
                            <div class="well well">
                                <div class="media">
                                    <a class="pull-left" href="{{route('profile.index', ['username'=> $post->user->username])}}">
                                        <img src="{{ asset('avatars/'.$post->user->getAvatarName()) }}" class="img-circle" alt="{{ $post->user->getNameOrUsername()}}" width="50" height="50">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><a href="{{route('profile.index', ['username'=> $post->user->username])}}">{{$post->user->getNameOrUsername()}}</a></h4>
                                        <h3>{{$post->title}}</h3>
                                        <hr>
                                        <p>{{$post->body}}</p>
                                        <hr>
                                        <ul class="list-inline">
                                            <li>{{$post->created_at->diffForHumans()}}</li>
                                        </ul>
                                        @foreach ($post->reply as $reply)
                                            <div class="well well panel-primary">
                                                <div class="media">
                                                    <a class="pull-left" href="{{route('profile.index', ['username'=> $reply->user->username])}}">
                                                        <img src="{{ asset('avatars/'.$reply->user->getAvatarName()) }}" class="img-circle" alt="{{ $reply->user->getNameOrUsername()}}" width="30" height="30">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="media-heading"><a href="{{route('profile.index', ['username'=> $reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a></h5>
                                                        <p>{{$reply->body}}</p>
                                                        <ul class="list-inline">
                                                            <li>{{$reply->created_at->diffForHumans()}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <form role="form" action="{{route('post.reply', ['postId'=>$post->id]) }}" method="post">
                                            <div class="form-group{{ $errors->has("reply-{$post->id}") ? ' has-error' : '' }}">
                                                <textarea name="reply-{{$post->id}}" class="form-control" rows="10" placeholder="Reply to this post"></textarea>
                                                @if($errors->has("reply-{$post->id}"))
                                                    <span class="help-block">{{$errors->first("reply-{$post->id}")}}</span>
                                                @endif
                                            </div>
                                            <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
                                            <input type="submit" value="Reply" class="btn btn-primary btn-sm">
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {!!$posts->render()!!}
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="post">
                    <h3>Create Discussion</h3>
                    <hr>
                    <form role="form" action="{{route('discussion.post')}}" method="post">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Post Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                            @if($errors->has('title'))
                                <span class="help-block">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('') ? ' has-error' : '' }}">
                            <label for="body" class="control-label">Content</label>
                            <textarea name="body" class="form-control" rows="20"></textarea>
                            @if($errors->has('body'))
                                <span class="help-block">{{$errors->first('body')}}</span>
                            @endif
                        </div>
                        <input type="hidden" name="group_id" id="group_id" value="{{$group->id}}">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop