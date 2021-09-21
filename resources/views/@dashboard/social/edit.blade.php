@extends('@dashboard._layouts.master')

@section('page_title') Social @endsection

@section('page_contents')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Social</h1>
    </div>

    <!-- Page Forms -->
    <form action="{{ route('social.update', $resource->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit '{{ $resource->name }}' Social</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-col-form-label" for="provider_id">Provider</label>
                            <select class="form-control @error('provider_id') is-invalid @enderror" id="provider_id" name="provider_id">
                                @foreach($providers as $provider)
                                    <option @if($resource->provider_id == $provider->id) selected @endif value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>

                            @error('provider_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror "
                                   id="name" type="text" name="name"
                                   placeholder="Enter name .." value="{{ $resource->name }}">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-col-form-label" for="link">Link</label>
                            <input class="form-control @error('link') is-invalid @enderror "
                                   id="link" type="text" name="link"
                                   placeholder="Enter link .." value="{{ $resource->link }}">

                            @error('link')
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
