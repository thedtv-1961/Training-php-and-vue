<div class="form-group">
    <label for="first_name">{{ trans('group.attribute.name.label') }}</label>
    <input type="text" class="form-control" name="name" value="{{ $group->name }}"/>
</div>
<div class="form-group">
    <label for="last_name">{{ trans('group.attribute.description.label') }}</label>
    <input type="text" class="form-control" name="description" value="{{ $group->description }}"/>
</div>

<div class="form-group">
    <label for="image">{{ trans('group.attribute.image.label') }}</label>
    <div class="image-upload">
        <div class="image-edit">
            <input
                type="file"
                id="image"
                name="image"
                accept="image/x-png,image/jpeg"
                class="image-picture"
            >
            <label for="image" class="avatar-picture-icon-edit"></label>
        </div>
        <div class="preview">
            <div id="image-preview" style="background-image: url('{{ $group->getImage() }}')">
            </div>
        </div>
    </div>
</div>

@section('js')
    <script src="{{ asset('/js/upload_image.js') }}"></script>
@stop
