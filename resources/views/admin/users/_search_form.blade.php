<form action="{{ route('users.index') }}">
    <div class="form-group">
        <div class="input-group">
            <input
                class="form-control"
                id="keyword"
                value="{{ request('keyword') }}"
                placeholder="{{ trans('user.variable.search') }}"
                name="keyword"
                type="text"
            />
            <div class="input-group-btn">
                <button type="submit" class="btn btn-warning">
                    {{ trans('common.button.search') }}
                </button>
            </div>
        </div>
    </div>
</form>
