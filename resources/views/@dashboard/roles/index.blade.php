@extends('_layouts.dashboard')

@section('title') {{ trans('users_groups.Users_Groups') }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">{{ trans('users_groups.Users_Groups') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('users_groups.Users_Groups') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('users_groups.Index') }}</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">{{ trans('users_groups.All_Users_Groups') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    {{ trans('users_groups.Here_you_will_find_all_the_resources_to_make_actions_on_them') }}.
                </p>

                <table id="datatable" class="table table-responsive table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('users_groups.Id') }}</th>
                        <th>{{ trans('users_groups.Name') }}</th>
                        <th>{{ trans('users_groups.Permissions') }}</th>
                        <th>{{ trans('users_groups.Created_by') }}</th>
                        <th>{{ trans('users_groups.Updated_by') }}</th>
                        <th>{{ trans('users_groups.Created_at') }}</th>
                        <th>{{ trans('users_groups.Updated_at') }}</th>
                        <th>{{ trans('users_groups.Control') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}</td>
                            <td>
                                <span class="label {{ $resource->class }}">({{ count($resource->permissions) }}) {{ $resource->name }}</span>
                            </td>
                            <td>
                                @foreach($resource->permissions as $permission)
                                    <span style="color: #333;border: 1px solid #333;display: inline-block" class="label m-b-5">{{ str_well(\App\PermissionGroup::getBy('id', $permission->pivot->permission_group_id)->name) }} {{ str_well($permission->name) }}</span>
                                @endforeach
                            </td>
                            <td>{{ $resource->createdBy->name }}</td>
                            <td>{{ $resource->updatedBy->name }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>
                                @if(check_authority('edit.user_groups'))
                                    <a href="{{ route('roles.edit', [$resource->uuid]) }}" class="update-modal btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endif
                                @if(check_authority('delete.user_groups'))
                                    <a href="{{ route('roles.destroy', [$resource->uuid]) }}" class="confirm-delete btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
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

    @if(check_authority('add.user_groups'))
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <!-- Create new -->
                <h4 class="m-t-0 header-title"> {{ trans('users_groups.Create_new_Users_Group') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    {{ trans('users_groups.Create_new_resource_from_here') }}.
                </p>

                @include('roles.create')
            </div>
        </div>
        <!-- end card-box -->
        </div>
    <!-- end row -->
    @endif

@endsection
