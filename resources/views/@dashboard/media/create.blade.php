@extends('@dashboard._layouts.master')

@section('title') {{ trans('media.Create') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('media.index') }}">{{ trans('media.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('media.Create') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('media.Create') }} </h4>
    </div>

    <!-- Create -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="file" class="mb-2">File <span class="text-danger">*</span></label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-3">File Type <span class="text-danger">*</span></label>
                                <br>
                                @foreach($types as $key => $type)
                                    <div class="radio form-check-inline">
                                        <input type="radio" id="lookup_file_id_{{$key}}" value="{{ $type->id }}" name="lookup_file_id">
                                        <label for="lookup_file_id_{{$key}}"> {{ str_well(getFromJson($type->name, lang())) }} </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-3" for="is_active">{{ trans('global.Is_Active') }} <span class="text-danger">*</span></label>
                                <br>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_active_1" value="1" name="is_active">
                                    <label for="is_active_1"> {{ trans('global.Yes') }} </label>
                                </div>

                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_active_0" value="0" name="is_active" checked>
                                    <label for="is_active_0"> {{ trans('global.No') }} </label>
                                </div>

                                @if ($errors->has('is_active'))
                                    <div class="invalid-feedback">{{ $errors->first('is_active') }}</div>
                                @endif
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-fw fa-save"></i> {{ trans('global.Save') }}</button>
                        <button type="reset" class="btn btn-warning waves-effect waves-light"><i class="fas fa-fw fa-redo"></i> {{ trans('global.Reset') }}</button>
                    </form>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>

@endsection
