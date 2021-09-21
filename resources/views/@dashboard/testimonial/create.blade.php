@extends('@dashboard._layouts.master')

@section('title') Testimonial | Create @endsection

@section('head')
    <script src="{{ url('assets_dashboard/vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Testimonial/Create</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create new testimonial</h6>
            </div>
            <div class="card-body">
                <div class="row">

                    @foreach(langs('short_name') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="name_{{ $lang }}">Name ({{ $lang }})</label>
                                <input class="form-control @error('name_'.$lang) is-invalid @enderror "
                                       id="name_{{ $lang }}"
                                       type="text" name="name_{{ $lang }}"
                                       placeholder="Enter name {{ $lang }} .." value="{{ old('name_' . $lang) }}">

                                @error('name_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(langs('short_name') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="work_{{ $lang }}">Work ({{ $lang }})</label>
                                <input class="form-control @error('work_'.$lang) is-invalid @enderror "
                                       id="work_{{ $lang }}"
                                       type="text" name="work_{{ $lang }}"
                                       placeholder="Enter work {{ $lang }} .." value="{{ old('work_' . $lang) }}">

                                @error('work_'.$lang)
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
                                       placeholder="Enter title_{{ $lang }} .." value="{{ old('title_' . $lang) }}">

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
                                          placeholder="Enter details_{{ $lang }} .."></textarea>

                                @error('details_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <script>
                                    CKEDITOR.replace('details_{{ $lang }}');
                                </script>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="ordering">Order</label>
                            <input type="number" class="form-control" name="ordering" id="ordering">

                            @error('ordering')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
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

