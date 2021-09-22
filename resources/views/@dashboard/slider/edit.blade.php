@extends('@dashboard._layouts.master')

@section('title') {{ trans('slider.Edit') }} @endsection

@section('head')
    <script src="{{ url('assets_dashboard/libs/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">{{ trans('slider.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('slider.slider_number') }} : {{ $resource->id }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('slider.Edit_Page') }} "{{ trans('slider.slider_number') }} : {{ $resource->id }}"</h4>
    </div>

    <!-- Edit -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('slider.update', $resource->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="text_1_{{ $lang }}">Text 1 ({{ $lang }})</label>
                                    <input class="form-control @error('text_1_'.$lang) is-invalid @enderror "
                                           id="text_1_{{ $lang }}"
                                           type="text" name="text_1_{{ $lang }}"
                                           placeholder="Enter text 1 {{ $lang }} .." value="{{ getFromJson($resource->text_1 , $lang) }}">

                                    @error('text_1_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="text_2_{{ $lang }}">Text 2 ({{ $lang }})</label>
                                    <input class="form-control @error('text_2_'.$lang) is-invalid @enderror "
                                           id="text_2_{{ $lang }}"
                                           type="text" name="text_2_{{ $lang }}"
                                           placeholder="Enter text 2 {{ $lang }} .." value="{{ getFromJson($resource->text_2 , $lang) }}">

                                    @error('text_2_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="text_3_{{ $lang }}">Text 3 ({{ $lang }})</label>
                                    <textarea class="form-control @error('text_3_'.$lang) is-invalid @enderror "
                                              id="text_3_{{ $lang }}" name="text_3_{{ $lang }}"
                                              placeholder="Enter text 3 {{ $lang }} ..">{{ getFromJson($resource->text_3 , $lang) }}</textarea>

                                    @error('text_3_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <script>
                                        CKEDITOR.replace( 'text_3_{{ $lang }}' );
                                    </script>
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="button_1_text_{{ $lang }}">Button 1 Text ({{ $lang }})</label>
                                    <input class="form-control @error('button_1_text_'.$lang) is-invalid @enderror "
                                           id="button_1_text_{{ $lang }}"
                                           type="text" name="button_1_text_{{ $lang }}"
                                           placeholder="Enter button 1 text {{ $lang }} .." value="{{ getFromJson($resource->button_1_text , $lang) }}">

                                    @error('button_1_text_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="button_2_text_{{ $lang }}">Button 2 Text ({{ $lang }})</label>
                                    <input class="form-control @error('button_2_text_'.$lang) is-invalid @enderror "
                                           id="button_2_text_{{ $lang }}"
                                           type="text" name="button_2_text_{{ $lang }}"
                                           placeholder="Enter button 2 text {{ $lang }} .." value="{{ getFromJson($resource->button_2_text , $lang) }}">

                                    @error('button_2_text_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="button_1_link">Button 1 link</label>
                                <input class="form-control @error('button_1_link') is-invalid @enderror "
                                       id="button_1_link" type="text" name="button_1_link"
                                       placeholder="Enter button 1 link .." value="{{ $resource->button_1_link }}">

                                @error('button_1_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="button_2_link">Button 2 link</label>
                                <input class="form-control @error('button_2_link') is-invalid @enderror "
                                       id="button_2_link" type="text" name="button_2_link"
                                       placeholder="Enter button 2 link .." value="{{ $resource->button_2_link }}">

                                @error('button_2_link')
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
