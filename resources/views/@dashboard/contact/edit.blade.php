@extends('@dashboard._layouts.master')

@section('title') Contact | Edit @endsection

@section('head')
    <script src="{{ url('assets_dashboard/vendors/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contact/Edit</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('dashboard.contact.update', $resource->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit contact us data</h6>
            </div>
            <div class="card-body">
                <div class="row">

                    @foreach(langs('short_name') as $lang)
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
                            <label class="form-col-form-label" for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $resource->phone }}" id="phone">

                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $resource->email }}" id="email">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-col-form-label" for="map">Map</label>
                            <input type="text" class="form-control" name="map" value="{{ $resource->map }}" id="map">

                            @error('map')
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

