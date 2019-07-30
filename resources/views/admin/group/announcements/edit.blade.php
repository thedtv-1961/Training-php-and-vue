@extends('adminlte::page')
@section('title',  __('announcement.edit_announcement'))
@section('css')
    <link rel="stylesheet" href="{{ asset('css/edit_announcement.css') }}">
@stop

@section('content')

<div class="modal-content edit-announcement-container">
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <div class="modal-header">
      <h5 class="modal-title edit-announcement-title" id="exampleModalLabel">{{ __('announcements.edit_announcement') }}</h5>
  </div>
  <form action="{{ route('groups.announcements.update', [$group->id, $announcement->id]) }}" method="POST">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group">
          <label for="">{{ __('announcements.group') }}</label>
          <label class="group-announcement-name" for="">{{ $group->name }}</label>
        <div>
        <div class="form-group">
          <label for="">{{ __('announcements.content') }}</label>
          <textarea class="form-input announcement-content" name="content" id="content" placeholder={{ __('announcements.your_content') }}>{{ $announcement->content }}</textarea>
        </div>
    </div>
  </form>
  <div class="modal-footer">
    <a type="button" class="btn btn-secondary btn-close" href={{ route('groups.announcements.index', $group) }}>{{ __('announcements.close') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('announcements.save_change') }}</button>
  </div>
@stop
