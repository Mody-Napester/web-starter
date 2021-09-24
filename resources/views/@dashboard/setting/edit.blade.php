@extends('@dashboard._layouts.master')

@section('title') {{ trans('setting.Edit') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('setting.edit') }}">{{ trans('setting.Page_Title') }}</a></li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('setting.Edit_Page') }}</h4>
    </div>

    <!-- Edit -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="logos_{{ $lang }}">{{ trans('setting.Logo') }} ({{ $lang }}) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('text_1_'.$lang) is-invalid @enderror "
                                           id="logos_{{ $lang }}"
                                           type="text" name="logos_{{ $lang }}"
                                           placeholder="Enter logos media file {{ $lang }} .." value="{{ getFromJson($resource->logos , $lang) }}">

                                    @error('logos_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="name_{{ $lang }}">{{ trans('setting.Name') }} ({{ $lang }}) <span class="text-danger">*</span></label>
                                    <input class="form-control @error('name_'.$lang) is-invalid @enderror "
                                           id="name_{{ $lang }}"
                                           type="text" name="name_{{ $lang }}"
                                           placeholder="Enter name {{ $lang }} .." value="{{ getFromJson($resource->name , $lang) }}">

                                    @error('name_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="slogan_{{ $lang }}">{{ trans('setting.Slogan') }} ({{ $lang }}) <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('slogan_'.$lang) is-invalid @enderror "
                                              id="slogan_{{ $lang }}" name="slogan_{{ $lang }}"
                                              placeholder="Enter slogan {{ $lang }} ..">{{ getFromJson($resource->slogan , $lang) }}</textarea>

                                    @error('slogan_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            <div class="col-md-6 mb-3">
                                <label class="mb-3" for="default_language_id">{{ trans('setting.default_language_id') }} <span class="text-danger">*</span></label>
                                <br>

                                @foreach(\App\Enums\SiteLanguages::$languages as $key => $language)
                                    <div class="radio form-check-inline">
                                        <input type="radio" id="default_language_id_{{$key}}" value="{{ $key }}" name="default_language_id" @if($resource->default_language_id == $key) checked @endif>
                                        <label for="default_language_id_{{$key}}"> {{ $language }} </label>
                                    </div>
                                @endforeach

                                @if ($errors->has('default_language_id'))
                                    <div class="invalid-feedback">{{ $errors->first('default_language_id') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-3" for="default_theme_id">{{ trans('setting.default_theme_id') }} <span class="text-danger">*</span></label>
                                <br>

                                @foreach(\App\Enums\SiteThemes::$themes as $key => $theme)
                                    <div class="radio form-check-inline">
                                        <input type="radio" id="default_theme_id_{{$key}}" value="{{ $key }}" name="default_theme_id" @if($resource->default_theme_id == $key) checked @endif>
                                        <label for="default_theme_id_{{$key}}"> {{ $theme }} </label>
                                    </div>
                                @endforeach

                                @if ($errors->has('default_theme_id'))
                                    <div class="invalid-feedback">{{ $errors->first('default_theme_id') }}</div>
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
