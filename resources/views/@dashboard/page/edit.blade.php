@extends('@dashboard._layouts.master')

@section('title') {{ trans('page.Edit') }} @endsection

@section('head')
    <script src="{{ url('assets_dashboard/libs/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('page.index') }}">{{ trans('page.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ getFromJson($resource->name , lang()) }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('page.Edit_Page') }} "{{ getFromJson($resource->name , lang()) }}"</h4>
    </div>

    <!-- Edit -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('page.update', $resource->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="title_{{ $lang }}">Title ({{ $lang }})</label>
                                    <input class="form-control @error('title_'.$lang) is-invalid @enderror "
                                           id="title_{{ $lang }}"
                                           type="text" name="title_{{ $lang }}"
                                           placeholder="Enter title_{{ $lang }} .." value="{{ getFromJson($resource->title, $lang) }}">

                                    @error('title_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="details_{{ $lang }}">Details ({{ $lang }})</label>
                                    <textarea class="form-control @error('details_'.$lang) is-invalid @enderror "
                                              id="details_{{ $lang }}" name="details_{{ $lang }}"
                                              placeholder="Enter details_{{ $lang }} ..">{{ getFromJson($resource->details, $lang) }}</textarea>

                                    @error('details_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <script>
                                        CKEDITOR.replace('details_{{ $lang }}');
                                    </script>
                                </div>
                            @endforeach

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="banner">Banner</label>
                                <input class="form-control @error('banner') is-invalid @enderror" id="banner" type="text" name="banner" value="{{ $resource->banner }}" placeholder="Enter media file name ..">

                                @error('banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="image">Image</label>
                                <input class="form-control @error('image') is-invalid @enderror" id="image" type="text" name="image" value="{{ $resource->image }}" placeholder="Enter media file name ..">

                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="ordering">Order</label>
                                <input type="number" class="form-control" name="ordering" id="ordering" value="{{ $resource->ordering }}" placeholder="Enter order number ..">

                                @error('ordering')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-3" for="is_active">{{ trans('global.Is_Active') }} <span class="text-danger">*</span></label>
                                <br>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_active_1" value="1" name="is_active" @if($resource->is_active == 1) checked @endif>
                                    <label for="is_active_1"> {{ trans('global.Yes') }} </label>
                                </div>

                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_active_0" value="0" name="is_active" @if($resource->is_active == 0) checked @endif>
                                    <label for="is_active_0"> {{ trans('global.No') }} </label>
                                </div>

                                @if ($errors->has('is_active'))
                                    <div class="invalid-feedback">{{ $errors->first('is_active') }}</div>
                                @endif
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-fw fa-save"></i> {{ trans('global.Update') }}</button>
                        <button type="reset" class="btn btn-warning waves-effect waves-light"><i class="fas fa-fw fa-redo"></i> {{ trans('global.Reset') }}</button>
                    </form>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>

@endsection
