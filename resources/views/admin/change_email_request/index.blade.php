@extends('adminlte::page')
@section('title',  __('announcements.announcement') )
@section('css')
    <link rel="stylesheet" href="{{asset('/css/change_email_requests.css')}}">
@stop

@section('content')
<div class="panel-body button_add">
</div>

@if (count($changeEmailRequests) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <b>{{ trans('change_email_requests.index.change_email_requests_management') }}</b>
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-striped ">
                    <thead>
                        <th>{{ trans('change_email_requests.index.user_name') }}</th>
                        <th>{{ trans('change_email_requests.index.email_change') }}</th>
                        <th>{{ trans('change_email_requests.index.status') }}</th>
                        <th colspan="2">{{ trans('change_email_requests.index.action') }}</th>
                    </thead>
                    <tbody>
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
                                <div class="btn_approve">
                                    <button type="button" class="btn btn-primary">{{ trans('change_email_requests.index.approve') }}</button>
                                </div>
                                <div class="btn_reject">
                                    <button type="submit"  class="btn btn-danger">{{ trans('change_email_requests.index.reject') }}</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $changeEmailRequests->links() }}
            </div>
        </div>
    </div> 
@endif

@endsection
