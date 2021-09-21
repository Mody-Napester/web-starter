@extends('@dashboard._layouts.master')

@section('title') Applicant @endsection

@section('head')

@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Applicant</h1>
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
                            <th>name</th>
                            <th>gender</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>y_o_experience</th>
                            <th>lang_pair</th>
                            <th>daily_out_put_capacity</th>
                            <th>job_type</th>
                            <th>speciality</th>
                            <th>cv</th>
                            <th>address</th>
                            <th>Created at</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>{{ $resource->name }}</td>
                                <td>{{ $resource->gender }}</td>
                                <td>{{ $resource->email }}</td>
                                <td>{{ $resource->phone }}</td>
                                <td>{{ $resource->y_o_experience }}</td>
                                <td>{{ $resource->lang_pair }}</td>
                                <td>{{ $resource->daily_out_put_capacity }}</td>
                                <td>{{ $resource->job_type }}</td>
                                <td>{{ $resource->speciality }}</td>
                                <td>
                                    @if($resource->cv != '')
                                        <a class="btn btn-sm btn-primary" href="{{ url('assets/images/career/'. $resource->cv) }}"><i class="fa fa-fw fa-download"></i></a>
                                    @endif
                                </td>
                                <td>{{ $resource->address }}</td>
                                <td>{{ $resource->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('footer') @endsection
