@extends('_layouts.dashboard')

@section('title') {{ trans('users.Users') }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">{{ trans('users.Users') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('users.Users') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('users.Index') }}</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#searchResource" data-toggle="tab" aria-expanded="false" class="nav-link active">{{ trans('users.Search_and_filter') }}</a>
                </li>
                @if(check_authority('add.users'))
                <li class="nav-item">
                    <a href="#createResource" data-toggle="tab" aria-expanded="true" class="nav-link">{{ trans('users.Create_new') }}</a>
                </li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="searchResource">
                    <h4 class="header-title m-t-0">Search all users</h4>
                    <p class="text-muted font-14 m-b-20">
                        {{ trans('users.Search_on_resource_from_here') }}.
                    </p>

                    @include('users.search')

                </div>
                @if(check_authority('add.users'))
                    <div class="tab-pane" id="createResource">
                        <h4 class="m-t-0 header-title">{{ trans('users.Create_new_user') }}</h4>
                        <p class="text-muted font-14 m-b-30">
                            {{ trans('users.Create_new_resource_from_here') }}.
                        </p>

                        @include('users.create')
                    </div>
                @endif
            </div>
        </div>
        <!-- end card-box -->
    </div>

    {{----}}
    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="card-box">--}}
                {{--<!-- Create new -->--}}
                {{--<h4 class="m-t-0 header-title">Create new User</h4>--}}
                {{--<p class="text-muted font-14 m-b-30">--}}
                    {{--Create new resource from here.--}}
                {{--</p>--}}

                {{--@include('users.create')--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- end card-box -->--}}
        {{--</div>--}}
    {{--<!-- end row -->--}}


    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="container-fluid">
                    <h4 class="m-t-0 header-title">{{ trans('users.All_Users') }}</h4>
                    <p class="text-muted font-14 m-b-30">
                        {{ trans('users.Here_you_will_find_all_the_resources_to_make_actions_on_them') }}.
                    </p>
                </div>

                <table data-page-length='50' id="datatable-users-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>{{ trans('users.Id') }}</th>
                            <th>{{ trans('users.Name') }}</th>
                            <th>{{ trans('users.Users_Groups') }}</th>
                            <th>{{ trans('users.Created_by') }}</th>
                            <th>{{ trans('users.Updated_by') }}</th>
                            <th>{{ trans('users.Created_at') }}</th>
                            <th>{{ trans('users.Updated_at') }}</th>
                            <th>{{ trans('users.Control') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>{{ $resource->id }}</td>
                                <td>{{ $resource->name }}</td>
                                <td>
                                    @foreach($resource->roles as $role)
                                        <span class="label {{ $role->class }}">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ ($resource->createdBy)? $resource->createdBy->name : '-'}}</td>
                                <td>{{ ($resource->updatedBy)? $resource->updatedBy->name : '-' }}</td>
                                <td>{{ $resource->created_at }}</td>
                                <td>{{ $resource->updated_at }}</td>
                                <td>
                                    @if(check_authority('edit.users'))
                                        <a href="{{ route('users.edit', [$resource->uuid]) }}" class="update-modal btn btn-sm btn-success" title="{{ trans('users.Update_user') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(check_authority('delete.users'))
                                    <a href="{{ route('users.destroy', [$resource->uuid]) }}" class="confirm-delete btn btn-sm btn-danger" title="{{ trans('users.Delete_user') }}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    @endif

                                    @if(check_authority('reset_password.users'))
                                    <a href="{{ route('users.reset_password', [$resource->uuid]) }}" class="btn btn-sm btn-warning" title="{{ trans('users.Reset_password') }}">
                                        <i class="fa fa-recycle"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        var tableDTUsers = $('#datatable-users-buttons').DataTable({
                lengthChange: false,
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    }
                ],
            });
        tableDTUsers.buttons().container().appendTo('#datatable-users-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection
