@extends('@dashboard._layouts.master')

@section('title') {{ trans('branch.Title') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('branch.Page_Title') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('branch.Page_Title') }} </h4>
    </div>

    <div class="card card-body">
        <div class="row justify-content-between">
            <div class="col-auto">
                <span class="font-17 bg-light p-2">{{ trans('branch.Total') }} : ({{ $resources->count() }})</span>
            </div>
            <div class="col-auto">
                <a href="{{ route('branch.create') }}" class=" btn btn-sm btn-success waves-effect waves-light me-1">
                    <i class="mdi mdi-plus-circle me-1"></i> {{ trans('global.Add_New_Button_Text') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Page List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">

                <table id="datatable-buttons" class="table table-responsive table-striped dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable-buttons_info" style="width: 100%;">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('branch.Name') }}</th>
                        <th>{{ trans('branch.Address') }}</th>
                        <th>{{ trans('branch.Telephone') }}</th>
                        <th>{{ trans('branch.Fax') }}</th>
                        <th>{{ trans('branch.Mobile') }}</th>
                        <th>{{ trans('branch.Email') }}</th>
                        <th>{{ trans('branch.Map_link') }}</th>
                        <th>{{ trans('branch.Is_default') }}</th>
                        <th>{{ trans('branch.is_active') }}</th>
                        <th>{{ trans('branch.Created_by') }}</th>
                        <th>{{ trans('branch.Update_by') }}</th>
                        <th>{{ trans('branch.Created_at') }}</th>
                        <th>{{ trans('branch.Update_at') }}</th>
                        <th>{{ trans('branch.Controls') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $key => $resource)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ getFromJson($resource->name , lang()) }}</td>
                            <td>{!! getFromJson($resource->address , lang()) !!}</td>
                            <td>{{ $resource->telephone }}</td>
                            <td>{{ $resource->fax }}</td>
                            <td>{{ $resource->mobile }}</td>
                            <td>{{ $resource->email }}</td>
                            <td>
                                <div style="width: 200px;">
                                    {{ $resource->map_link }}
                                </div>
                            </td>
                            <td>
                                @if($resource->is_default == 1)
                                    <span class="badge bg-soft-success text-success">Yes</span>
                                @else
                                    <span class="badge bg-soft-danger text-danger">No</span>
                                @endif
                            </td>
                            <td>
                                @if($resource->is_active == 1)
                                    <span class="badge bg-soft-success text-success">{{ trans('global.Yes') }}</span>
                                @else
                                    <span class="badge bg-soft-danger text-danger">{{ trans('global.No') }}</span>
                                @endif
                            </td>
                            <td>{{ ($cb = $resource->created_by_user)? $cb->name : '-' }}</td>
                            <td>{{ ($ub = $resource->updated_by_user)? $ub->name : '-' }}</td>
                            <td>{{ custom_date($resource->created_at) }}</td>
                            <td>{{ custom_date($resource->updated_at) }}</td>
                            <td>
                                <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                <a href="{{ route('branch.edit' , [$resource->uuid]) }}" class="fire-loader-anchor action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{ route('branch.destroy' , [$resource->uuid]) }}" class="confirm-delete action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
