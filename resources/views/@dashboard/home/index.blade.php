@extends('@dashboard._layouts.master')

@section('title') {{ trans('home.Title') }} @endsection

@section('contents')

    <div class="page-title-box">
        <div class="page-title-right">
            <a href="" class="btn btn-primary">Select <i class="fas fa-fw fa-sync-alt fa-spin"></i></a>
        </div>
        <h4 class="page-title">{{ trans('home.Page_Title') }}</h4>
    </div>

@endsection
