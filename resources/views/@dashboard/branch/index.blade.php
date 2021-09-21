@extends('@dashboard._layouts.master')

@section('page_title') Branch @endsection

@section('page_contents')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Branch</h1>
        <a href="{{ route('branch.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add new</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Controls</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Fax</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Map link</th>
                            <th>Is default</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>
                                    <a href="{{ route('branch.edit' , [$resource->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-edit"></i></a>
                                    <a href="{{ route('branch.destroy' , [$resource->id]) }}" class="btn btn-danger btn-sm confirm-delete"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                                <td>{{ getFromJson($resource->name , lang()) }}</td>
                                <td>{!! getFromJson($resource->address , lang()) !!}</td>
                                <td>{{ $resource->telephone }}</td>
                                <td>{{ $resource->fax }}</td>
                                <td>{{ $resource->mobile }}</td>
                                <td>{{ $resource->email }}</td>
                                <td>
                                    <div style="width: 200px;">
                                        {{ $resource->map_link }}
                                    </div>
                                </td>
                                <td>
                                    @if($resource->is_default == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td>{{ $resource->created_at }}</td>
                                <td>{{ $resource->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
