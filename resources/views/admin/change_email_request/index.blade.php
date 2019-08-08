@extends('adminlte::page')
@section('title',  __('announcements.announcement') )
@section('css')
    <link rel="stylesheet" href="{{asset('/css/change_email_requests.css')}}">
@stop

@section('content')
<div class="panel-body button_add">
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <b>{{ trans('change_email_requests.index.change_email_requests_management') }}</b>
        </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12">

            @include('admin.notifies._message')

            <table class="table table-striped ">
                <thead>
                    <th>{{ trans('change_email_requests.index.user_name') }}</th>
                    <th>{{ trans('change_email_requests.index.email_change') }}</th>
                    <th>{{ trans('change_email_requests.index.status') }}</th>
                    <th colspan="2">{{ trans('change_email_requests.index.action') }}</th>
                </thead>
                <tbody>
                @if (count($changeEmailRequests) > 0)
                    @foreach ($changeEmailRequests  as $changeEmailRequest)
                        <tr>
                            <td>
                                <div>{{ $changeEmailRequest->user->name }}</div>
                            </td>

                            <td>
                                <div>{{ $changeEmailRequest->email_change }}</div>
                            </td>

                            <td>
                                <div>{{ $changeEmailRequest->status }}</div>
                            </td>

                            <td>
                                @if ($changeEmailRequest->status == 'Pending')
                                    <div class="btn_approve">
                                        <form action="{{route('change_email_requests.update', [$changeEmailRequest->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input name="status" type="hidden" value="1">
                                            <button type="submit" onclick="return confirm('{{ trans('change_email_requests.confirm_message') }}')" class="btn btn-primary">{{ trans('change_email_requests.index.approve') }}</button>
                                        </form>
                                    </div>
                                    <div class="btn_reject">
                                        <form action="{{route('change_email_requests.update', [$changeEmailRequest->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <input name="status" type="hidden" value="2">
                                            <button type="submit" onclick="return confirm('{{ trans('change_email_requests.confirm_message') }}')" class="btn btn-danger">{{ trans('change_email_requests.index.reject') }}</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="btn_approve">
                                        <button type="submit"  class="btn btn-primary" disabled= "true">{{ trans('change_email_requests.index.approve') }}</button>
                                    </div>
                                    <div class="btn_reject">
                                        <button type="submit"  class="btn btn-danger" disabled= "true">{{ trans('change_email_requests.index.reject') }}</button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{ $changeEmailRequests->links() }}
        </div>
    </div>
</div>
@endsection
