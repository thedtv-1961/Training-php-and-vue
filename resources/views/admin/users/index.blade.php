@extends('adminlte::page')
@section('title', trans('user.page.title'))
@section('content_header')
    <h1>{{ trans('user.page.title') }}</h1>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/css/user.css') }}">
@stop
@section('content')
    @include('admin.notifies._message')
    <div class="row">
        <div>
            <div class="col-md-4">
                @include('admin.users._search_form')
            </div>
            <div class="text-right col-md-8">
                <a href="{{ route('users.create')}}" class="btn btn-primary">
                    {{ trans('common.button.create') }}
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <table class="table table-striped table-users">
                <thead>
                <tr>
                    <th>{{ trans('user.attribute.id.label') }}</th>
                    <th>{{ trans('user.attribute.avatar.label') }}</th>
                    <th>
                        <a href="?keyword={{ request('keyword') }}&field=name&sort={{ request('sort') == 'asc' ? 'desc' : 'asc' }}&page={{ request('page') }}">
                            {{ trans('user.attribute.name.label') }}
                        </a>
                    </th>
                    <th>
                        <a href="?keyword={{ request('keyword') }}&field=email&sort={{ request('sort') == 'asc' ? 'desc' : 'asc' }}&page={{ request('page') }}">
                            {{ trans('user.attribute.email.label') }}
                        </a>
                    </th>
                    <th>
                        <a href="?keyword={{ request('keyword') }}&field=birthday&sort={{ request('sort') == 'asc' ? 'desc' : 'asc' }}&page={{ request('page') }}">
                            {{ trans('user.attribute.birthday.label') }}
                        </a>
                    </th>
                    <th>
                        <a href="?keyword={{ request('keyword') }}&field=gender&sort={{ request('sort') == 'asc' ? 'desc' : 'asc' }}&page={{ request('page') }}">
                            {{ trans('user.attribute.gender.label') }}
                        </a>
                    </th>
                    <th colspan=2>{{ trans('common.button.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <img class="avatar-preview"
                                 src="{{ $user->avatar }}"
                                 alt="{{ $user->name }}">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>
                            <a href="{{ route('users.edit',$user->id) }}"
                               class="btn btn-primary">
                                {{ trans('common.button.edit') }}
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}"
                                  method="post">
                                {!! csrf_field() !!}
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('{{ trans('user.message.confirm_delete') }}')">
                                    {{ trans('common.button.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <nav class="text-right">
                <ul class="pagination justify-content-end text-right">
                    {{ $users->links() }}
                </ul>
            </nav>
        </div>
    </div>
@stop
