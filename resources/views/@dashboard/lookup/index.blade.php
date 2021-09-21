@extends('@dashboard._layouts.master')

@section('title') {{ trans('lookup.Title') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('lookup.Page_Title') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('lookup.Page_Title') }} </h4>
    </div>

    <div class="card card-body">
        <div class="row justify-content-between">
            <div class="col-auto">
                <span class="font-17 bg-light p-2">{{ trans('lookup.Total') }} : ({{ $resources->count() }})</span>
                <span class="font-17 bg-light p-2">{{ trans('lookup.Parents') }} : ({{ $resources->where('parent_id', 0)->count() }})</span>
                <span class="font-17 bg-light p-2">{{ trans('lookup.Child') }} : ({{ \App\Models\Lookup::where('parent_id', '>', 0)->count() }})</span>
            </div>
            <div class="col-auto">
                <a href="{{ route('lookup.export') }}" class=" btn btn-sm btn-primary waves-effect waves-light me-1">
                    <i class="mdi mdi-download me-1"></i> {{ trans('global.export') }}
                </a>
                <a href="{{ route('lookup.create') }}" class=" btn btn-sm btn-success waves-effect waves-light me-1">
                    <i class="mdi mdi-plus-circle me-1"></i> {{ trans('global.Add_New_Button_Text') }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">

                <table id="datatable-buttons" class="table table-responsive table-striped dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable-buttons_info" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>#</th>
{{--                        <th>{{ trans('lookup.Parent') }}</th>--}}
                        <th>{{ trans('lookup.Key') }}</th>
                        <th>{{ trans('lookup.Parent') }}</th>
                        <th>{{ trans('lookup.Name_ar') }}</th>
                        <th>{{ trans('lookup.Name_en') }}</th>
                        <th>{{ trans('lookup.Active') }}</th>
                        <th>{{ trans('lookup.Created_by') }}</th>
                        <th>{{ trans('lookup.Updated_by') }}</th>
                        <th>{{ trans('lookup.Created_at') }}</th>
                        <th>{{ trans('lookup.Updated_at') }}</th>
                        <th>{{ trans('lookup.Actions') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $resource)
                        <tr style="@if($resource->parent_id == 0) background-color:#eeeeee; @endif">
                            <td>{{ $resource->id }}</td>
{{--                            <td>{{ $resource->parent_id }}</td>--}}
                            <td>{{ $resource->key }}</td>
                            <td>
                                @if($resource->parent_id != 0)
                                    {{ getFromJson(\App\Models\Lookup::getOneBy('id', $resource->parent_id)->name , lang()) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ getFromJson($resource->name , 'ar') }}</td>
                            <td>{{ getFromJson($resource->name , 'en') }}</td>
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
                                @if(!in_array($resource->key, \App\Enums\LookupParents::$keys))
                                    @if(check_authority('edit.lookups'))
                                        <a href="{{ route('lookup.edit' , [$resource->uuid]) }}" class="fire-loader-anchor action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    @endif
                                    @if(check_authority('delete.lookups'))
                                        <a href="{{ route('lookup.destroy' , [$resource->uuid]) }}" class="confirm-delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @foreach($resource->child as $child)
                            <tr>
                                <td>{{ $child->id }}</td>
{{--                                <td>{{ $child->parent_id }}</td>--}}
                                <td>{{ $child->key }}</td>
                                <td>
                                    @if($child->parent_id != 0)
                                        {{ getFromJson(\App\Models\Lookup::getOneBy('id', $child->parent_id)->name , lang()) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ getFromJson($child->name , 'ar') }}</td>
                                <td>{{ getFromJson($child->name , 'en') }}</td>
                                <td>
                                    @if($child->is_active == 1)
                                        <span class="badge bg-soft-success text-success">{{ trans('lookup.Yes') }}</span>
                                    @else
                                        <span class="badge bg-soft-danger text-danger">{{ trans('lookup.No') }}</span>
                                    @endif
                                </td>
                                <td>{{ ($cb = $child->created_by_user)? $cb->name : '-' }}</td>
                                <td>{{ ($ub = $child->updated_by_user)? $ub->name : '-' }}</td>
                                <td>{{ custom_date($child->created_at) }}</td>
                                <td>{{ custom_date($child->updated_at) }}</td>
                                <td>
                                    @if(check_authority('edit.lookups'))
                                        <a href="{{ route('lookup.edit' , [$child->uuid]) }}" class="fire-loader-anchor action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    @endif
                                    @if(check_authority('delete.lookups'))
                                        <a href="{{ route('lookup.destroy' , [$child->uuid]) }}" class="confirm-delete action-icon"> <i class="mdi mdi-delete"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
