@extends('@dashboard._layouts.master')

@section('title') {{ trans('social.Edit') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('social.index') }}">{{ trans('social.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ $resource->name }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('social.Edit_Page') }} "{{ $resource->name }}"</h4>
    </div>

    <!-- Edit -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('social.update', $resource->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="lookup_provider_id">{{ trans('social.Provider') }} <span class="text-danger">*</span></label>
                                <select class="select2 form-control @error('lookup_provider_id') is-invalid @enderror" id="lookup_provider_id" name="lookup_provider_id">
                                    @foreach($providers as $provider)
                                        <option @if($provider->id == $resource->lookup_provider_id) selected @endif value="{{ $provider->id }}">{{ str_well(getFromJson($provider->name, lang())) }}</option>
                                    @endforeach
                                </select>

                                @error('lookup_provider_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="name">{{ trans('social.Name') }} <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror "
                                       id="name" type="text" name="name"
                                       placeholder="Enter name .." value="{{ $resource->name }}">

                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="mb-2" for="link">{{ trans('social.Link') }} <span class="text-danger">*</span></label>
                                <input class="form-control @error('link') is-invalid @enderror "
                                       id="link" type="text" name="link"
                                       placeholder="Enter link .." value="{{ $resource->link }}">

                                @error('link')
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
