@extends('adminlte::page')
@section('title', __('members.add'))
@section('content_header')
    <h1>{{ __('members.add') }}</h1>
@stop
@section('content')
    @include('admin.notifies._message')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <form action="{{ route('groups.members.store', $group->id) }}" method="post"
                      enctype="multipart/form-data">
                    @include('admin.group.members.form', $users)
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> {{ __('members.add') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop
