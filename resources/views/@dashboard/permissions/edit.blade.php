<form method="post" action="{{ route('permissions.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="form-group">
        <label>{{ trans('data_entry_screens.Name') }}</label>
        <input type="text" name="name" class="form-control" required placeholder="Name" value="{{ $resource->name }}"/>
    </div>

    <div class="form-group">
        <label>{{ trans('data_entry_screens.User_Actions') }}
            <span data-select2-target="permission_groups_update" class="select-all text-success btn-link">({{ trans('data_entry_screens.Select_All') }})</span>
            <span data-select2-target="permission_groups_update" class="de-select-all text-success btn-link">({{ trans('data_entry_screens.Deselect_All') }})</span>
        </label>
        <select name="permission_groups[]" id="permission_groups_update" class="select2 select2-multiple" multiple="" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
            @foreach($groups as $group)
                <option @if(in_array($group->id, $resource->permission_groups->pluck('id')->toArray() )) selected @endif value="{{ $group->uuid }}">{{ $group->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                {{ trans('data_entry_screens.Update') }}
            </button>
        </div>
    </div>
</form>
