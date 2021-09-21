@extends('@dashboard._layouts.master')

@section('title') {{ trans('lookup.Edit') }} @endsection

@section('contents')

    <!-- Page Heading -->
    <div class="page-title-box">
        <div class="page-title-right">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home.index') }}">{{ trans('home.Title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('lookup.index') }}">{{ trans('lookup.Page_Title') }}</a></li>
                <li class="breadcrumb-item active">{{ getFromJson($resource->name , lang()) }}</li>
            </ol>
        </div>
        <h4 class="page-title">{{ trans('lookup.Edit_Lookup') }} "{{ getFromJson($resource->name , lang()) }}"</h4>
    </div>


    <!-- Edit -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('lookup.update', $resource->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-2" for="parent_id">{{ trans('lookup.Parent') }}</label>
                                    <select class="select2 form-control {{ $errors->has('parent_id') ? ' is-invalid' : '' }}" id="parent_id" name="parent_id">
                                        <option @if($resource->parent_id == 0) selected @endif value="0">{{ trans('lookup.No_Parent') }}</option>
                                        @foreach($parents as $parent)
                                            <option @if($resource->parent_id == $parent->id) selected @endif value="{{ $parent->uuid }}">{{ str_well(getFromJson($parent->name , lang())) }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('parent_id'))
                                        <div class="invalid-feedback">{{ $errors->first('parent_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-3" for="is_active">{{ trans('lookup.Is_Active') }}</label>
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

                            @foreach(langs("short_name") as $lang)
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="mb-2" for="name_{{ $lang }}">{{ trans('lookup.Name') }} ({{ $lang }})</label>
                                        <input class="form-control {{ $errors->has('name_'.$lang) ? ' is-invalid' : '' }}"
                                               id="name_{{ $lang }}"
                                               type="text" name="name_{{ $lang }}"
                                               placeholder="Enter name_{{ $lang }} .." value="{{ getFromJson($resource->name , $lang) }}">

                                        @if ($errors->has('name_'.$lang))
                                            <div class="invalid-feedback">{{ $errors->first('name_'.$lang) }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="fa fa-fw fa-save"></i> {{ trans('global.Update') }}</button>
                        <button type="reset" class="btn btn-warning waves-effect waves-light"><i class="fas fa-fw fa-redo"></i> {{ trans('global.Reset') }}</button>
                    </form>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->

    </div>

@endsection
