<form action="{{ route('groups.index') }}">
    {!! csrf_field() !!}
    <div class="form-group">
        <div class="input-group">
            <input class="form-control" id="search"
                   value="{{ request('search') }}"
                   placeholder="{{ trans('group.control.search.placeholder') }}" name="search"
                   type="text"/>
            <div class="input-group-btn">
                <button type="submit" class="btn btn-warning">
                    {{ trans('common.button.search') }}
                </button>
            </div>
        </div>
    </div>
</form>
