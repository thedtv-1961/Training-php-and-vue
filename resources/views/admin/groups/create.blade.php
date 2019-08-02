@extends('adminlte::page')
@section('title', trans('group.page.create'))
@section('content_header')
    <h1>{{ trans('group.page.create') }}</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/group.css') }}">
@stop
@section('content')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <div>
            <form method="post" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                @include('admin.groups._form')
                <button type="submit" class="btn btn-primary">{{ trans('common.button.create') }}</button>
                <a href="{{ route('groups.index')}}" class="btn btn-default">{{ trans('common.button.back') }}</a>
            </form>
        </div>
    </div>
</div>
@stop
