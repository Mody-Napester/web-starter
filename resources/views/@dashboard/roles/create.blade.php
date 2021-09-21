<form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>{{ trans('users_groups.Users_Group_name') }}</label>
                <input type="text" name="name" class="form-control" required placeholder="{{ trans('users_groups.Users_Group_name') }}"/>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('users_groups.Class') }}</label>

{{--                <select name="class" id="class" class="select2 select2-multiple" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>--}}
{{--                    @foreach(App\Enums\LabelClasses::$classes as $key => $class)--}}
{{--                        <option value="{{ $class }}"><span class="label {{ $class }}" style="width: 10px;height: 10px;display: inline-block"></span> {{ str_well($class) }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

                @foreach(App\Enums\LabelClasses::$classes as $key => $class)
                    <label for="class{{ $key }}" style="display: block">
                        <input type="radio" name="class" id="class{{ $key }}" value="{{ $class }}">
                        <div class="label {{ $class }}">{{ str_well($class) }}</div>
                    </label>
                @endforeach

                @if ($errors->has('class'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('class') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label>{{ trans('users_groups.Permissions') }}
                    <span data-select2-target="permissions-groups_create" class="select-all text-success btn-link">({{ trans('users_groups.Select_All') }})</span>
                    <span data-select2-target="permissions-groups_create" class="de-select-all text-success btn-link">({{ trans('users_groups.Deselect_All') }})</span>
                </label>
                @if ($errors->has('permissions-groups'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('permissions-groups') }}</strong>
            </span>
                @endif

                <div style="border:1px solid #dddddd;padding: 10px;border-radius: 5px;">
                    @foreach($permissions as $permission)
                        <div class="text-primary mb-2">{{ str_well($permission->name) }}</div>
                        <div class="row mb-2">
                            @foreach($permission->permission_groups as $permission_group)
                                <div class="col-md-3 all-checkbox">
                                    <label for="{{ $permission_group->uuid }}.{{ $permission->uuid }}">
                                        <input type="checkbox" name="permissions-groups[]"
                                               id="{{ $permission_group->uuid }}.{{ $permission->uuid }}"
                                               value="{{ $permission_group->uuid }}.{{ $permission->uuid }}">
                                        {{ str_well($permission_group->name) }} {{ str_well($permission->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>


                {{--<select name="permissions-groups[]" id="permissions-groups_create" class="select2 select2-multiple" multiple="" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>--}}
                {{--@foreach($permissions as $permission)--}}
                {{--@foreach($permission->permission_groups as $permission_group)--}}
                {{--<option value="{{ $permission_group->uuid }}.{{ $permission->uuid }}">{{ $permission_group->name }}.{{ $permission->name }}</option>--}}
                {{--@endforeach--}}
                {{--@endforeach--}}
                {{--</select>--}}



            </div>
        </div>

{{--        <div class="col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <label>{{ trans('users_groups.Color') }}</label>--}}
{{--                <input type="text" name="color" class="form-control" required placeholder="Color"/>--}}
{{--                @if ($errors->has('color'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $errors->first('color') }}</strong>--}}
{{--                    </span>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}

        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label>Icon</label>--}}
                {{--<input type="text" name="icon" class="form-control" required placeholder="Icon"/>--}}
                {{--@if ($errors->has('icon'))--}}
                    {{--<span class="invalid-feedback" role="alert">--}}
                        {{--<strong>{{ $errors->first('icon') }}</strong>--}}
                    {{--</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}


    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                {{ trans('users_groups.Submit') }}
            </button>
        </div>
    </div>
</form>
