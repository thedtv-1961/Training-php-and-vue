@php
    $genders = [
        config('users.gender.female') => trans('user.variable.gender.female'),
        config('users.gender.male') => trans('user.variable.gender.male'),
        config('users.gender.other_gender') => trans('user.variable.gender.other_gender'),
    ];
@endphp

<form class="form-horizontal frm-filter col-md-12" action="{{ route('users.index') }}">
    <div class="form-header-container col-md-10 col-md-offset-1">
        <div class="id-form-field no-padding">
            <label for="id"
                   class="label-text">{{ trans('user.attribute.id.label') }}</label>

            <input type="number" class="form-control field-control" name="id"
                   id="id"
                   placeholder="{{ trans('user.attribute.id.placeholder_filter') }}"
                   value="{{ request('id') }}">
        </div>
        <div class="no-padding">
            <label for="name"
                   class="label-text">{{ trans('user.attribute.name.label') }}</label>
            <input class="form-control field-control" type="text" name="name"
                   id="name"
                   placeholder="{{ trans('user.attribute.name.placeholder_filter') }}"
                   value="{{ request('name') }}">
        </div>
        <div class="no-padding">
            <label for="email"
                   class="label-text">{{ trans('user.attribute.email.label') }}</label>
            <input class="form-control field-control" name="email" id="email"
                   placeholder="{{ trans('user.attribute.email.placeholder_filter') }}"
                   value="{{ request('email') }}">
        </div>
        <div class="no-padding">
            <label class="label-text lb-gender">{{ trans('user.attribute.gender.label') }}</label>
            <label class="label-field-gender lb-rad-gender">
                <input type="radio" name="gender"
                       value="" {{ request('gender') == '' ? 'checked' : '' }}>
                {{ trans('user.variable.all') }}
            </label>
            @foreach($genders as $key => $value)
                <label class="label-field-gender lb-rad-gender">
                    <input type="radio" name="gender"
                           value="{{ $key }}" {{ request('gender') != '' && request('gender') == $key ? 'checked' : '' }}>
                    {{ $value }}
                </label>
            @endforeach
        </div>
        <div class="no-padding">
            <label for="birthday"
                   class="label-text">{{ trans('user.attribute.birthday.label') }}</label>
            <input class="form-control field-control field-control-email" name="birthday"
                   id="birthday"
                   type="date"
                   value="{{ request('birthday') }}">
        </div>
        <div class="no-padding">
            <button type="submit" class="btn btn-warning">
                <i class="fa fa-search"></i>
                {{ trans('common.button.search') }}
            </button>
        </div>
    </div>
</form>
