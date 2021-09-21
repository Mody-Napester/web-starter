@extends('@dashboard._layouts.master')

@section('page_title') Slider @endsection

@section('page_contents')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Slider</h1>
        <a href="{{ route('slider.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add new</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Text 1</th>
                            <th>Text 2</th>
                            <th>Text 3</th>
                            <th>Button 1 text</th>
                            <th>Button 2 text</th>
                            <th>Button 1 link</th>
                            <th>Button 2 link</th>
                            <th>Image</th>
                            <th>Created at</th>
                            <th>Controls</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>{{ getFromJson($resource->text_1 , lang()) }}</td>
                                <td>{{ getFromJson($resource->text_2 , lang()) }}</td>
                                <td>{!! getFromJson($resource->text_3 , lang()) !!}</td>
                                <td>{{ getFromJson($resource->button_1_text , lang()) }}</td>
                                <td>{{ getFromJson($resource->button_2_text , lang()) }}</td>
                                <td>{{ $resource->button_1_link }}</td>
                                <td>{{ $resource->button_2_link }}</td>
                                <td>
                                    <img style="width: 150px;" class="img-fluid" src="{{ url('assets_public/images/slider/'. $resource->image) }}" alt="">
                                </td>
                                <td>{{ $resource->created_at }}</td>
                                <td>
                                    <a href="{{ route('slider.edit' , [$resource->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-edit"></i></a>
                                    <a href="{{ route('slider.destroy' , [$resource->id]) }}" class="btn btn-danger btn-sm confirm-delete"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
