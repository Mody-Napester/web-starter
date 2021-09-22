@extends('@dashboard._layouts.master')

@section('title') {{ trans('media.Title') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('media.Page_Title') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('media.Page_Title') }} </h4>
    </div>

    <div class="card card-body">
        <div class="row justify-content-between">
            <div class="col-auto">
                <span class="font-17 bg-light p-2">{{ trans('media.Total') }} : ({{ $resources->count() }})</span>
            </div>
            <div class="col-auto">
                <a href="{{ route('media.create') }}" class=" btn btn-sm btn-success waves-effect waves-light me-1">
                    <i class="mdi mdi-plus-circle me-1"></i> {{ trans('global.Add_New_Button_Text') }}
                </a>
            </div>
        </div>
    </div>

    <!-- All Medias -->
    <div class="row">
        @foreach($resources as $resource)

            <div class="col-xl-2">
                <div class="card product-box">
                    <div class="card-body">
                        <div class="product-action">
                            <a href="javascript: void(0);" class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-content-copy"></i></a>
                            <a href="{{ route('media.destroy' , [$resource->id]) }}" class="btn btn-danger btn-xs waves-effect waves-light confirm-delete"><i class="mdi mdi-trash-can-outline"></i></a>
                        </div>

                        <div class="bg-light" style="height: 100px;text-align: center;vertical-align: middle;display: table-cell;width: 100%;">
                            <img src="{{ url('assets_public/media/'. $resource->file) }}" style="max-height: 100%;max-width: 100%;margin: auto;" alt="product-pic" class="">
                        </div>

                        <div class="product-info">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="font-16 mt-0 sp-line-1">
                                        <a href="" class="text-dark">{{ str_well(getFromJson(lookup('id', $resource->lookup_file_id)->name, lang())) }}</a>

                                        <span class="pull-right">
                                            @if($resource->is_active == 1)
                                                <span class="badge bg-soft-success text-success">{{ trans('global.Active') }}</span>
                                            @else
                                                <span class="badge bg-soft-danger text-danger">{{ trans('global.Not_active') }}</span>
                                            @endif
                                        </span>
                                    </h5>
                                    <h5 class="mb-2"> <span class="text-muted"> {{ $resource->file }}</span></h5>
                                    <h5 class="m-0"> <span class="badge badge-outline-blue"> {{ custom_date($resource->created_at) }}</span></h5>
                                </div>
                            </div> <!-- end row -->
                        </div> <!-- end product info-->
                    </div>
                </div> <!-- end card-->
            </div>

        @endforeach
    </div>

@endsection
