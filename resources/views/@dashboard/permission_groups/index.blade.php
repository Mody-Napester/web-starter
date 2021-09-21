@extends('_layouts.dashboard')

@section('title') {{ trans('user_actions.User_Actions') }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">{{ trans('user_actions.User_Actions') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('user_actions.User_Actions') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('user_actions.Index') }}</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">{{ trans('user_actions.All') }} {{ trans('user_actions.User_Actions') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    {{ trans('user_actions.Here_you_will _ind_all_the_resources_to_make_actions_on_them') }}.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>{{ trans('user_actions.Id') }}</th>
                        <th>{{ trans('user_actions.Name') }}</th>
                        <th>{{ trans('user_actions.Created_by') }}</th>
                        <th>{{ trans('user_actions.Updated_by') }}</th>
                        <th>{{ trans('user_actions.Created_at') }}</th>
                        <th>{{ trans('user_actions.Updated_at') }}</th>
                        <th>{{ trans('user_actions.Control') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}</td>
                            <td>{{ $resource->name }}</td>
                            <td>{{ $resource->createdBy->name }}</td>
                            <td>{{ $resource->updatedBy->name }}</td>
                            <td>{{ $resource->created_at }}</td>
                            <td>{{ $resource->updated_at }}</td>
                            <td>
                                <a href="{{ route('permission-groups.edit', [$resource->uuid]) }}" class="update-modal btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('permission-groups.destroy', [$resource->uuid]) }}" class="confirm-delete btn btn-sm btn-danger">
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
                <h4 class="m-t-0 header-title">{{ trans('user_actions.Create_new') }} {{ trans('user_actions.User_Actions') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    {{ trans('user_actions.Create_new_resource_from_here') }}.
                </p>

                @include('permission_groups.create')
            </div>
        </div>
        <!-- end card-box -->
        </div>
    <!-- end row -->

@endsection
