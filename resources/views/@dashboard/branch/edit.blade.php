@extends('@dashboard._layouts.master')

@section('page_title') Branch @endsection

@section('page_contents')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Branch</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('branch.update', $resource->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit '{{ getFromJson($resource->name , lang()) }}' Branch</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="name_{{ $lang }}">Name ({{ $lang }})</label>
                                <input class="form-control @error('name_'.$lang) is-invalid @enderror "
                                       id="name_{{ $lang }}"
                                       type="text" name="name_{{ $lang }}"
                                       placeholder="Enter name_{{ $lang }} .." value="{{ getFromJson($resource->name , $lang) }}">

                                @error('name_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                    @foreach(config('vars.langs') as $lang)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-col-form-label" for="address_{{ $lang }}">Address ({{ $lang }})</label>
                                <textarea class="form-control @error('address_'.$lang) is-invalid @enderror "
                                          id="address_{{ $lang }}" name="address_{{ $lang }}"
                                          placeholder="Enter address_{{ $lang }} ..">{{ getFromJson($resource->address , $lang) }}</textarea>

                                @error('address_'.$lang)
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <script>
                                    CKEDITOR.replace( 'address_{{ $lang }}' );
                                </script>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="telephone">Telephone</label>
                            <input class="form-control @error('telephone') is-invalid @enderror "
                                   id="telephone" type="text" name="telephone"
                                   placeholder="Enter telephone .." value="{{ $resource->telephone }}">

                            @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="fax">Fax</label>
                            <input class="form-control @error('fax') is-invalid @enderror "
                                   id="fax" type="text" name="fax"
                                   placeholder="Enter fax .." value="{{ $resource->fax }}">

                            @error('fax')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="mobile">Mobile</label>
                            <input class="form-control @error('mobile') is-invalid @enderror "
                                   id="mobile" type="text" name="mobile"
                                   placeholder="Enter mobile .." value="{{ $resource->mobile }}">

                            @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="email">email</label>
                            <input class="form-control @error('email') is-invalid @enderror "
                                   id="email" type="email" name="email"
                                   placeholder="Enter email .." value="{{ $resource->email }}">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="map_link">Map link</label>
                            <input class="form-control @error('map_link') is-invalid @enderror "
                                   id="map_link" type="text" name="map_link"
                                   placeholder="Enter map_link .." value="{{ $resource->map_link }}">

                            @error('map_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="is_default">Is default</label>
                            <select class="form-control @error('is_default') is-invalid @enderror" id="is_default" name="is_default">
                                <option @if($resource->is_default == 0) selected @endif value="0">No</option>
                                <option @if($resource->is_default == 1) selected @endif value="1">Yes</option>
                            </select>

                            @error('is_default')
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
