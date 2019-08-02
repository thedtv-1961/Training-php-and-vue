@extends('adminlte::page')
@section('title',  __('announcements.announcement') )
<link rel="stylesheet" href="{{asset('/css/announcements.css')}}">

@section('content')
    <div class="panel-body button_add">
        <a href="{{route('groups.announcements.create', $group->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>&nbsp;{{ __('announcements.add_announcement') }}</a>
    </div>

    @if (count($announcements) > 0)
        <div class="panel panel-default table_announcements">
            <div class="panel-heading">
                <h4>
                    <b>{{ __('announcements.announcements_management') }}</b>
                </h3>
            </div>
            <div class="panel-body">
            <table class="table table-striped announcement-table">
                <thead>
                    <th col="9">{{ __('announcements.content') }}</th>
                    <th col="1">&nbsp;</th>
                </thead>
                <tbody>
                @foreach ($announcements as $announcement)
                    <tr>
                        <td class="table-text" col="9">
                            <div>{{ $announcement->content }}</div>
                        </td>

                        <td class="action_announcements" col="1">
                            <div class="edit_icon">
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditAnnouncementModal"><span class="glyphicon glyphicon-edit"></span></button>
                                </form>
                            </div>
                            <div class="delete_icon">
                                <form action="{{route('groups.announcements.destroy', [$group->id, $announcement->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit"  class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                {{ $announcements->links() }}
            </div>
        </div> 
    @endif

@endsection
