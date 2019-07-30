@if(Session::has('message'))
    <div class="alert alert-{{Session::get('message_class')}}">
        {{Session::get('message')}}
    </div>
@endif
