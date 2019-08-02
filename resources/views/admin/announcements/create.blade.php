@extends('adminlte::page')
@section('title',  __('announcements.create_announcement'))
@section('css')
    <link rel="stylesheet" href="{{asset('/css/announcements.css')}}">
@stop

@section('content')
@section('content_header')
  <h1 class="title_create"><b>{{ __('announcements.create_announcement') }}</b></h1>
@stop

<div class="panel-body">
    <form action="{{route('groups.announcements.store', $group->id)}}" method="POST" class="form-horizontal announcement">
        {{ csrf_field() }}
        @if ($errors->any())
            <div class="alert alert-danger validate_fail">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label for="task-name" class="col-sm-1 control-label">{{ __('announcements.content') }}</label>

            <div class="col-sm-11">
                <textarea name="content" id="announcement_content" class="form-control" rows="10" cols="30"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-success">
                    {{ __('announcements.create_announcement') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
