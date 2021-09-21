@extends('@dashboard._layouts.master')

@section('page_title') Product @endsection

@section('page_contents')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('product.update', $resource->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit '{{ getFromJson($resource->title , lang()) }}' product</h6>
            </div>
            <div class="card-body">
                <div class="row">
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
                            <label class="form-col-form-label" for="brand_id">Brand</label>
                            <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                                @foreach($brands as $brand)
                                    <option @if($resource->brand_id == $brand->id) selected @endif value="{{ $brand->id }}">{{ getFromJson($brand->title , lang()) }}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-col-form-label" for="show_in_home">Show in home</label>
                            <input type="checkbox" class="form-control" @if($resource->show_in_home == 1) checked @endif value="1" name="show_in_home" id="show_in_home">

                            @error('show_in_home')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @foreach(config('vars.langs') as $lang)
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

                    @foreach(config('vars.langs') as $lang)
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

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-col-form-label" for="banner">Banner</label>
                            <input class="form-control @error('banner') is-invalid @enderror" id="banner" type="file" name="banner">

                            @error('banner')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
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
