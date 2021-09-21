@extends('_layouts.dashboard')

@section('title') {{ trans('data_entry_screens.Data_Entry_Screens') }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">{{ trans('data_entry_screens.Data_Entry_Screens') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('data_entry_screens.Data_Entry_Screens') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('data_entry_screens.Index') }}</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box ">
                <h4 class="m-t-0 header-title">{{ trans('data_entry_screens.All_Data_Entry_Screens') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    {{ trans('data_entry_screens.Here_you_will_find_all_the_resources_to_make_actions_on_them') }}.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('data_entry_screens.Id') }}</th>
                        <th>{{ trans('data_entry_screens.Name') }}</th>
                        <th>{{ trans('data_entry_screens.Groups') }}</th>
                        <th>{{ trans('data_entry_screens.Created_by') }}</th>
                        <th>{{ trans('data_entry_screens.Updated_by') }}</th>
                        <th>{{ trans('data_entry_screens.Created_at') }}</th>
                        <th>{{ trans('data_entry_screens.Updated_at') }}</th>
                        <th>{{ trans('data_entry_screens.Control') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}</td>
                            <td>{{ $resource->name }}</td>
                            <td>
                                @foreach($resource->permission_groups as $permission_group)
                                    <span class="label label-default" style="display: inline-block">{{ $permission_group->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $resource->createdBy->name }}</td>
                            <td>{{ $resource->updatedBy->name }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', [$resource->uuid]) }}" class="update-modal btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('permissions.destroy', [$resource->uuid]) }}" class="confirm-delete btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <!-- Create new -->
                <h4 class="m-t-0 header-title">Create new {{ trans('data_entry_screens.Data_Entry_Screens') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    {{ trans('data_entry_screens.Create_new_resource_from_here') }}.
                </p>

                @include('permissions.create')
            </div>
        </div>
        <!-- end card-box -->
        </div>
    <!-- end row -->

@endsection
