<form method="post" action="{{ route('roles.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('users_groups.Users_Group_name') }}</label>
                <input type="text" name="name" class="form-control" required placeholder="Role name" value="{{ $resource->name }}"/>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('users_groups.Class') }}</label>
                <select name="class" id="class" class="select2 select2-multiple" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\LabelClasses::$classes as $key => $class)
                        <option @if($resource->class == $class) selected @endif value="{{ $class }}">{{ str_well($class) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>{{ trans('users_groups.Color') }}</label>
                <input type="text" name="color" class="form-control" required placeholder="Color" value="{{ $resource->color }}"/>
            </div>
        </div>

        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label>Icon</label>--}}
                {{--<input type="text" name="icon" class="form-control" required placeholder="Icon" value="{{ $resource->icon }}"/>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    <div class="form-group">
        <label>{{ trans('users_groups.User_Actions') }}
            <span data-select2-target="permissions-groups_update" class="select-all text-success btn-link">({{ trans('users_groups.Select_All') }})</span>
            <span data-select2-target="permissions-groups_update" class="de-select-all text-success btn-link">({{ trans('users_groups.Deselect_All') }})</span>
        </label>

        <div style="border:1px solid #dddddd;padding: 10px;border-radius: 5px;">
            @foreach($permissions as $permission)
                <div class="text-primary mb-2">{{ str_well($permission->name) }}</div>
                <div class="row mb-2">
                    @foreach($permission->permission_groups as $permission_group)
                        <div class="col-md-3 all-checkbox">
                            <label for="{{ $permission_group->uuid }}.{{ $permission->uuid }}">

{{--                                <input @if(in_array($permission->id, $resource->permissions->pluck('id')->toArray()) &&--}}
{{--                                in_array($permission_group->id, $resource->permissionGroups->pluck('id')->toArray())) checked @endif--}}

                                <input @if(\Illuminate\Support\Facades\DB::table('permission_role')
                                            ->where('permission_group_id', $permission_group->id)
                                            ->where('permission_id', $permission->id)
                                            ->where('role_id', $resource->id)
                                            ->first()) checked @endif type="checkbox" name="permissions-groups[]"
                                       id="{{ $permission_group->uuid }}.{{ $permission->uuid }}"
                                       value="{{ $permission_group->uuid }}.{{ $permission->uuid }}">
                                {{ str_well($permission_group->name) }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{--<select name="permissions-groups[]" id="permissions-groups_update" class="select2 select2-multiple" multiple="" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>--}}
            {{--@foreach($permissions as $permission)--}}
                {{--@foreach($permission->permission_groups as $permission_group)--}}
                    {{--<option @if(in_array($permission->id, $resource->permissions->pluck('id')->toArray()) &&--}}
                     {{--in_array($permission_group->id, $resource->permissionGroups->pluck('id')->toArray())) selected @endif--}}
                    {{--value="{{ $permission_group->uuid }}.{{ $permission->uuid }}">{{ $permission_group->name }}.{{ $permission->name }}</option>--}}
                {{--@endforeach--}}
            {{--@endforeach--}}
        {{--</select>--}}
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                {{ trans('users_groups.Update') }}
            </button>
        </div>
    </div>
</form>
