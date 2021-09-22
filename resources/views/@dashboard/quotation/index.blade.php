@extends('@dashboard._layouts.master')

@section('title') {{ trans('quotation.Title') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ trans('quotation.Page_Title') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('quotation.Page_Title') }} </h4>
    </div>

    <div class="card card-body">
        <div class="row justify-content-between">
            <div class="col-auto">
                <span class="font-17 bg-light p-2">{{ trans('quotation.Total') }} : ({{ $resources->count() }})</span>
            </div>
            <div class="col-auto">
                <a href="{{ route('quotation.export') }}" class=" btn btn-sm btn-primary waves-effect waves-light me-1">
                    <i class="mdi mdi-download me-1"></i> {{ trans('global.export') }}
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
                        <th>{{ trans('message.BName') }}</th>
                        <th>{{ trans('message.Name') }}</th>
                        <th>{{ trans('message.Email') }}</th>
                        <th>{{ trans('message.Phone') }}</th>
                        <th>{{ trans('message.Comments') }}</th>
                        <th>{{ trans('message.Created at') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ $resource->id }}</td>
                            <td>{{ $resource->bname }}</td>
                            <td>{{ $resource->name }}</td>
                            <td>{{ $resource->email }}</td>
                            <td>{{ $resource->phone }}</td>
                            <td>{{ $resource->comments }}</td>
                            <td>{{ $resource->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
