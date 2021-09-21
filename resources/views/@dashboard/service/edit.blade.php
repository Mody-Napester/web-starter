@extends('@dashboard._layouts.master')

@section('title') Service | Edit @endsection

@section('head')
    <script src="{{ url('assets_dashboard/vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Service/Edit</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('service.update', $resource->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit '{{ getFromJson($resource->title , lang()) }}' service</h6>
            </div>
            <div class="card-body">
                <div class="row">

                    @foreach(langs('short_name') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="category_{{ $lang }}">Category ({{ $lang }})</label>
                                <input class="form-control @error('category_'.$lang) is-invalid @enderror "
                                       id="category_{{ $lang }}"
                                       type="text" name="category_{{ $lang }}"
                                       placeholder="Enter category_{{ $lang }} .." value="{{ getFromJson($resource->category , $lang) }}">

                                @error('category_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(langs('short_name') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="title_{{ $lang }}">Title ({{ $lang }})</label>
                                <input class="form-control @error('title_'.$lang) is-invalid @enderror "
                                       id="title_{{ $lang }}"
                                       type="text" name="title_{{ $lang }}"
                                       placeholder="Enter title_{{ $lang }} .." value="{{ getFromJson($resource->title , $lang) }}">

                                @error('title_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(langs('short_name') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="details_{{ $lang }}">Details ({{ $lang }})</label>
                                <textarea class="form-control @error('details_'.$lang) is-invalid @enderror "
                                          id="details_{{ $lang }}" name="details_{{ $lang }}"
                                          placeholder="Enter details_{{ $lang }} ..">{{ getFromJson($resource->details , $lang) }}</textarea>

                                @error('details_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <script>
                                    CKEDITOR.replace( 'details_{{ $lang }}' );
                                </script>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-col-form-label" for="ordering">Order</label>
                            <input type="text" class="form-control" name="ordering" value="{{ $resource->ordering }}" id="ordering">

                            @error('ordering')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-col-form-label" for="banner">Banner</label>
                            <input class="form-control @error('banner') is-invalid @enderror" id="banner" type="file" name="banner">

                            @error('banner')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-col-form-label" for="image">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" id="image" type="file" name="image">

                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-save"></i> Save</button>
            </div>
        </div>
    </form>


@endsection

@section('footer') @endsection

