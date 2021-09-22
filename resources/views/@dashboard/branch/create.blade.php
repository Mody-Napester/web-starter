@extends('@dashboard._layouts.master')

@section('title') {{ trans('branch.Create') }} @endsection

@section('head')
    <script src="{{ url('assets_dashboard/libs/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('branch.index') }}">{{ trans('branch.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('branch.Create') }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('branch.Create') }} </h4>
    </div>

    <!-- Create -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('branch.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="name_{{ $lang }}">{{ trans('branch.Name') }} ({{ $lang }})</label>
                                    <input class="form-control @error('name_'.$lang) is-invalid @enderror "
                                           id="name_{{ $lang }}"
                                           type="text" name="name_{{ $lang }}"
                                           placeholder="Enter name_{{ $lang }} .." value="{{ old('name_' . $lang) }}">

                                    @error('name_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach

                            @foreach(langs('short_name') as $lang)
                                <div class="col-md-6 mb-3">
                                    <label class="mb-2" for="address_{{ $lang }}">{{ trans('branch.Address') }} ({{ $lang }})</label>
                                    <textarea class="form-control @error('address_'.$lang) is-invalid @enderror "
                                              id="address_{{ $lang }}" name="address_{{ $lang }}"
                                              placeholder="Enter address_{{ $lang }} .."></textarea>

                                    @error('address_'.$lang)
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <script>
                                        CKEDITOR.replace( 'address_{{ $lang }}' );
                                    </script>
                                </div>
                            @endforeach

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="telephone">{{ trans('branch.Telephone') }}</label>
                                <input class="form-control @error('telephone') is-invalid @enderror "
                                       id="telephone" type="text" name="telephone"
                                       placeholder="Enter telephone .." value="{{ old('telephone') }}">

                                @error('telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="fax">{{ trans('branch.Fax') }}</label>
                                <input class="form-control @error('fax') is-invalid @enderror "
                                       id="fax" type="text" name="fax"
                                       placeholder="Enter fax .." value="{{ old('fax') }}">

                                @error('fax')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="mobile">{{ trans('branch.Mobile') }}</label>
                                <input class="form-control @error('mobile') is-invalid @enderror "
                                       id="mobile" type="text" name="mobile"
                                       placeholder="Enter mobile .." value="{{ old('mobile') }}">

                                @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="email">{{ trans('branch.Email') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror "
                                       id="email" type="text" name="email"
                                       placeholder="Enter email .." value="{{ old('email') }}">

                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="mb-2" for="map_link">{{ trans('branch.Map_link') }}</label>

                                <textarea class="form-control @error('map_link') is-invalid @enderror "
                                          id="map_link" name="map_link"
                                          placeholder="Enter map_link ..">{{ old('map_link') }}</textarea>

                                @error('map_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-3" for="is_default">{{ trans('global.Is_default') }}</label>
                                <br>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_default_1" value="1" name="is_default" checked>
                                    <label for="is_default_1"> {{ trans('global.Yes') }} </label>
                                </div>

                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_default_0" value="0" name="is_default">
                                    <label for="is_default_0"> {{ trans('global.No') }} </label>
                                </div>

                                @error('is_default')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-3" for="is_active">{{ trans('global.Is_Active') }} <span class="text-danger">*</span></label>
                                <br>
                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_active_1" value="1" name="is_active" checked>
                                    <label for="is_active_1"> {{ trans('global.Yes') }} </label>
                                </div>

                                <div class="radio form-check-inline">
                                    <input type="radio" id="is_active_0" value="0" name="is_active">
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
