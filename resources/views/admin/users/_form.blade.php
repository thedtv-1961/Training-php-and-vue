@php
    $genders = [
        config('users.gender.female') => trans('user.variable.gender.female'),
        config('users.gender.male') => trans('user.variable.gender.male'),
        config('users.gender.other_gender') => trans('user.variable.gender.other_gender'),
    ];
@endphp
{{ csrf_field() }}
<!-- Email -->
<div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
    <label for="email">{{ trans('user.attribute.email.label') }}</label>
    <p class="error_message">{{ $errors->first('email') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-at"></i>
        </div>
        <input type="text"
               value="{{ old('email', $user->email) }}"
               id="email" name="email"
               placeholder="{{ trans('user.attribute.email.placeholder') }}"
               class="form-control">
    </div>
</div>
<!-- /Email -->

<!-- Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
    <label for="name">{{ trans('user.attribute.name.label') }}</label>
    <p class="error_message">{{ $errors->first('name') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-user"></i>
        </div>
        <input type="text"
               value="{{ old('name', $user->name) }}"
               id="name" name="name"
               placeholder="{{ trans('user.attribute.name.placeholder') }}"
               class="form-control">
    </div>
</div>
<!-- /Name -->

<!-- Password -->
<div class="form-group {{ $errors->has('password') ? 'has-error':'' }}">
    <label for="password">{{ trans('user.attribute.password.label') }}</label>
    <p class="error_message">{{ $errors->first('password') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-key"></i>
        </div>
        <input type="password" id="password"
               name="password"
               placeholder="{{ trans('user.attribute.password.placeholder') }}"
               class="form-control">
    </div>
</div>
<!-- /Password -->

<!-- Password Confirmation -->
<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error':'' }}">
    <label for="password_confirmation">{{ trans('user.attribute.password_confirmation.label') }}</label>
    <p class="error_message">{{ $errors->first('password_confirmation') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-key"></i>
        </div>
        <input type="password"
               id="password_confirmation" name="password_confirmation"
               placeholder="{{ trans('user.attribute.password_confirmation.placeholder') }}"
               class="form-control">
    </div>
</div>
<!-- /Password Confirmation-->

<!-- Gender -->
<div class="form-group">
    <label for="gender">{{ trans('user.attribute.gender.label') }}</label>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-mars"></i>
        </div>
        <select name="gender" id="gender" class="form-control">
            @foreach($genders as $key => $value)
                @if(old('gender') != null && old('gender') == $key)
                    <option value="{{ $key }}" selected>{{ $value }}</option>
                @elseif(old('gender') == null && isset($user->getAttributes()['gender']) && $user->getAttributes()['gender'] == $key)
                    <option value="{{ $key }}" selected>{{ $value }}</option>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<!-- /Gender-->

<!-- Birthday -->
<div class="form-group {{ $errors->has('birthday') ? 'has-error':'' }}">
    <label for="birthday">{{ trans('user.attribute.birthday.label') }}</label>
    <p class="error_message">{{ $errors->first('birthday') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control" id="birthday" name="birthday"
               value="{{ old('birthday', $user->birthday) }}">
    </div>
</div>
<!-- /Birthday-->

<!-- Phone -->
<div class="form-group {{ $errors->has('phone') ? 'has-error':'' }}">
    <label for="phone">{{ trans('user.attribute.phone.label') }}</label>
    <p class="error_message">{{ $errors->first('phone') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-phone"></i>
        </div>
        <input type="text"
               value="{{ old('phone', $user->phone) }}"
               id="phone" name="phone"
               placeholder="{{ trans('user.attribute.phone.placeholder') }}"
               class="form-control">
    </div>
</div>
<!-- /Phone-->

<!-- Address -->
<div class="form-group {{ $errors->has('phone') ? 'has-error':'' }}">
    <label for="address">{{ trans('user.attribute.address.label') }}</label>
    <p class="error_message">{{ $errors->first('address') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-map-marker"></i>
        </div>
        <input type="text"
               value="{{ old('address', $user->address) }}"
               id="address" name="address"
               placeholder="{{ trans('user.attribute.address.placeholder') }}"
               class="form-control">
    </div>
</div>
<!-- /Address-->

<!-- Avatar -->
<div class="form-group {{ $errors->has('avatar') ? 'has-error':'' }}">
    <label for="avatar">{{ trans('user.attribute.avatar.label') }} (<=
        2MB)</label>
    <p class="error_message">{{ $errors->first('avatar') }}</p>
    <div class="image-upload">
        <div class="image-edit">
            <input type="file"
                   id="avatar"
                   name="avatar"
                   accept="image/x-png,image/jpeg"
                   class="image-picture avatar-picture">
            <label for="avatar" class="avatar-picture-icon-edit"></label>
        </div>
        <div class="image-preview">
            <div id="image-preview"
                 style="background-image: url('{{ $user->avatar }}')">
            </div>
        </div>
    </div>
</div>
<!-- /Avatar -->
