@if(Session::has('message'))
    <div class="alert alert-{{Session::get('message_class')}}">
        {{Session::get('message')}}
        <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<script src="{{ asset('/js/alert.js') }}"></script>
