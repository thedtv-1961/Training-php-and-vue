{{csrf_field()}}
@php
    $genders = [
        config('users.gender.female') => trans('members.user.variable.gender.female'),
        config('users.gender.male') => trans('members.user.variable.gender.male'),
        config('users.gender.other_gender') => trans('members.user.variable.gender.other_gender'),
    ];
@endphp
<div class="form-group {{ $errors->has('email') ? 'has-error':'' }}">
    <label for="email">{{ trans('members.user.attribute.email.label') }}</label>
    <p class="error_message">{{ $errors->first('email') }}</p>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-at"></i>
        </div>
        <input list="suggestionList" id="email"/>
            <datalist id="suggestionList">
                @foreach ($users as $user)
                    <option data-value="{{$user->id}}">{{$user->email}}</option>
                @endforeach
            </datalist>
        <input type="hidden" name="user_id" id="email-hidden"/>
    </div>
</div>

@section('js')
    <script src="{{ asset('/js/admin/groupMember/selectEmail.js') }}"></script>
@stop
