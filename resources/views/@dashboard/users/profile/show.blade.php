@extends('_layouts.dashboard')

@section('title') {{ $user->name }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">{{ trans('users.Edit_user') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('users.Users') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('users.Edit') }}</li>
            </ol>

        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title m-t-0">{{ trans('users.Edit_user_profile') }}</h4>
                <p class="text-muted font-14 m-b-20">
                    {{ trans('users.Edit_and_update_on_resource_from_here') }}.
                </p>

                <form method="post" action="{{ route('users.update', $user->uuid) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="email">{{ trans('users.Email_Or_Username') }}</label>
                                <input type="text" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required autofocus/>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="name">{{ trans('users.Name') }}</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="phone">{{ trans('users.Phone') }}</label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-b-0">
                        <div>
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                {{ trans('users.Update_Data') }}
                            </button>
                        </div>
                    </div>
                </form>

                <hr>

                <div class="border border-danger p-2">
                    <form method="post" action="{{ route('users.update_password', $user->uuid) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <label class="text-danger" for="password">{{ trans('users.Update_Password') }}</label>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="password" placeholder="{{ trans('users.Enter_new_password') }} .." id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"/>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-block btn-danger waves-effect waves-light">
                                    {{ trans('users.Update_Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- end card-box -->
    </div>

@endsection
