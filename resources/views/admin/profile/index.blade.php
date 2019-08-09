@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>@lang('user.profile.title')</h1>
@stop
@section('content')
    <div class="container">
        <div class="row">
            @if(session()->has('profile.success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session('profile.success') !!}
                </div>
            @endif

            @if(session()->has('profile.error'))
                <div class="alert alert-danger alert-dismissible">">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session('profile.error') !!}
                </div>
            @endif
        </div>
        <div class="user-profile">
            <div class="row">
                <div class="col-sm-3">
                    <form class="form" action="{{ route('change_avatar') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="text-center">
                            <img src="{{ $user->avatar }}" class="avatar img-circle img-thumbnail" alt="avatar">
                            <div class="form-group {{ $errors->has('avatar') ? 'has-error':'' }}">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <input type="file" class="text-center center-block" name="avatar" id="avatar">
                                <p class="text-danger">{{ $errors->first('avatar') }}</p>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-block btn-primary">@lang('user.profile.change_avatar')</button>
                    </form>
                </div>
                <div class="col-sm-9">
                    <div class="form-profile">
                        <div class="form-profile-group">
                            <hr>
                            <form class="form" action="{{ route('update_profile') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label for="name"><h4>@lang('user.attribute.name.label')</h4></label>
                                        </div>
                                        <div class="col-xs-6">
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label for="email"><h4>@lang('user.attribute.email.label')</h4></label>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('birthday') ? 'has-error':'' }}">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label for="birthday"><h4>@lang('user.attribute.birthday.label')</h4></label>
                                        </div>
                                        <div class="col-xs-6">
                                                <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}">
                                                <p class="text-danger">{{ $errors->first('birthday') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('gender') ? 'has-error':'' }}">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label for="gender"><h4>@lang('user.attribute.gender.label')</h4></label>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="gender" id="gender" class="form-control">
                                                @foreach($genders as $key => $value)
                                                    <option value="{{ $key }}" {{ $user->getOriginal('gender') === $key ? 'selected':'' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('address') ? 'has-error':'' }}">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label for="address"><h4>@lang('user.attribute.address.label')</h4></label>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('phone') ? 'has-error':'' }}">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label for="phone"><h4>@lang('user.attribute.phone.label')</h4></label>
                                        </div>
                                        <div class="col-xs-6">
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
                                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <br>
                                            <button class="btn btn-lg btn-success btn-block" type="submit">
                                                <i class="glyphicon glyphicon-ok-sign"></i>
                                                @lang('user.control.button.save')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
