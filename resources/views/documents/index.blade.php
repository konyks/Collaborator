@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-2">
            @include('group.partials.groupnav')
        </div>
        <div class="col-md-10">
            @include('documents.partials.nav')
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="documents">
                    <h3>{{$group->name}}`s Shared Documents</h3>
                    <hr>
                    @if($documents->count())
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($documents as $document)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{$document->id}}">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$document->id}}" aria-expanded="false" aria-controls="collapse{{$document->id}}">
                                            {{$document->title}}
                                        </a>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-8"><p>Posted by <b>{{$document->user->getNameOrUsername()}}</b></p></div>
                                        <div class="col-md-4" align="right">{{$document->created_at->diffForHumans()}}</div>
                                    </div>
                                </div>
                                <div id="collapse{{$document->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$document->id}}">
                                    <div class="panel-body">
                                        <table align='center' bgcolor='white' cellspacing='10' class='text'>
                                            <tr>
                                                <td align='center'>
                                                    <p><embed src="{{ asset('documents/'.$document->path)}}" width='850' height='1076'>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <p>There are no documents present.</p>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="post">
                    <h3>Documents Upload</h3>
                    <hr>
                    <h4><b>Upload Documents Only in PDF Format</b></h4>
                    {{--Start of Document Upload Form--}}
                    <div class="alert alert-info" role="alert">
                    <form action="{{route('document.upload')}}" method="post" enctype="multipart/form-data">
                        <div style="margin-bottom: 25px" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Document Name">
                            @if($errors->has('title'))
                                <span class="help-block">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <input type="file" name="document" id="document">
                            @if($errors->has('document'))
                                <span class="help-block">{{$errors->first('document')}}</span>
                            @endif
                        </div>
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <div class="form-group" align="right">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
