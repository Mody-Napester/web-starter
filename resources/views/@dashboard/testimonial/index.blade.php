@extends('@dashboard._layouts.master')

@section('title') {{ trans('testimonial.Title') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('testimonial.Page_Title') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('testimonial.Page_Title') }} </h4>
    </div>

    <div class="card card-body">
        <div class="row justify-content-between">
            <div class="col-auto">
                <span class="font-17 bg-light p-2">{{ trans('testimonial.Total') }} : ({{ $resources->count() }})</span>
            </div>
            <div class="col-auto">
                <a href="{{ route('testimonial.create') }}" class=" btn btn-sm btn-success waves-effect waves-light me-1">
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
                        <th>{{ trans('testimonial.ordering') }}</th>
                        <th>{{ trans('testimonial.Name') }}</th>
                        <th>{{ trans('testimonial.Work') }}</th>
                        <th>{{ trans('testimonial.Title') }}</th>
                        <th>{{ trans('testimonial.Details') }}</th>
                        <th>{{ trans('testimonial.Image') }}</th>
                        <th>{{ trans('testimonial.is_active') }}</th>
                        <th>{{ trans('testimonial.Created_by') }}</th>
                        <th>{{ trans('testimonial.Update_by') }}</th>
                        <th>{{ trans('testimonial.Created_at') }}</th>
                        <th>{{ trans('testimonial.Update_at') }}</th>
                        <th>{{ trans('testimonial.Controls') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $key => $resource)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $resource->ordering }}</td>
                            <td>{{ getFromJson($resource->name , lang()) }}</td>
                            <td>{{ getFromJson($resource->work , lang()) }}</td>
                            <td>{{ getFromJson($resource->title , lang()) }}</td>
                            <td>{!! getFromJson($resource->details , lang()) !!}</td>
                            <td>
                                <img style="width: 150px;" class="img-fluid" src="{{ url('assets_public/media/'. $resource->image) }}" alt="">
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
                                <a href="{{ route('testimonial.edit' , [$resource->uuid]) }}" class="fire-loader-anchor action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{ route('testimonial.destroy' , [$resource->uuid]) }}" class="confirm-delete action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
