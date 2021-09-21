<form method="post" action="{{ route('users.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="email">{{ trans('users.Username') }} ({{ trans('users.Email') }})</label>
                <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $resource->email }}" required autofocus/>

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
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $resource->name }}" required>

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
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $resource->phone }}" required>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
{{--        <div class="col-md-6">--}}
{{--            <div class="form-group">--}}
{{--                <label class="" for="password">{{ trans('users.Password') }}</label><i class="bar"></i>--}}
{{--                <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"/>--}}

{{--                @if ($errors->has('password'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('password') }}</strong>--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-md-6">
            <div class="form-group">
                <label>{{ trans('users.Users_Groups') }} <span data-select2-target="roles_update" class="select-all text-success btn-link">({{ trans('users.Select_All') }})</span></label>
                <select name="roles[]" id="roles_update" class="select2 select2-multiple" multiple="" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($roles as $role)
                        <option @if(in_array($role->id, $resource->roles->pluck('id')->toArray())) selected @endif value="{{ $role->uuid }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                <i class="fa fa-fe fa-edit"></i> {{ trans('users.Update') }}
            </button>
        </div>
    </div>
</form>

<hr>

<div class="border border-danger p-2">
    <form method="post" action="{{ route('users.update_password', $resource->uuid) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label class="text-danger" for="password">{{ trans('users.Update_Password') }}</label>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="password" placeholder="Enter new password .." id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"/>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-block btn-danger waves-effect waves-light">
                    <i class="fa fa-fe fa-edit"></i> {{ trans('users.Update_User_Password') }}
                </button>
            </div>
        </div>
    </form>
</div>

