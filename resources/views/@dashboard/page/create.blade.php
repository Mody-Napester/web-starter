@extends('@dashboard._layouts.master')

@section('title') {{ trans('page.Create') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">{{ trans('page.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('page.Create') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('page.Create') }} </h4>
    </div>

    <!-- Create -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-2" for="is_active">{{ trans('page.Is_Active') }}</label>
                                    <select class="select2 form-control {{ $errors->has('is_active') ? ' is-invalid' : '' }}" id="is_active" name="is_active">
                                        <option value="1">{{ trans('global.Yes') }}</option>
                                        <option value="0">{{ trans('global.No') }}</option>
                                    </select>

                                    @if ($errors->has('is_active'))
                                        <div class="invalid-feedback">{{ $errors->first('is_active') }}</div>
                                    @endif
                                </div>
                            </div>

                            @foreach(langs("short_name") as $lang)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="mb-2" for="name_{{ $lang }}">{{ trans('page.Name') }} ({{ $lang }})</label>
                                        <input class="form-control {{ $errors->has('name_'.$lang) ? ' is-invalid' : '' }}"
                                               id="name_{{ $lang }}"
                                               type="text" name="name_{{ $lang }}"
                                               placeholder="Enter name_{{ $lang }} .." value="{{ old('name_' . $lang) }}">

                                        @if ($errors->has('name_'.$lang))
                                            <div class="invalid-feedback">{{ $errors->first('name_'.$lang) }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-fw fa-save"></i> {{ trans('global.Save') }}</button>
                        <button type="reset" class="btn btn-warning waves-effect waves-light"><i class="fas fa-fw fa-redo"></i> {{ trans('global.Reset') }}</button>
                    </form>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>

@endsection
