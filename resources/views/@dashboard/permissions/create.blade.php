<form method="post" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label>{{ trans('data_entry_screens.Name') }}</label>
        <input type="text" name="name" class="form-control" required placeholder="Name"/>
    </div>

    <div class="form-group">
        <label>{{ trans('data_entry_screens.User_Actions') }}
            <span data-select2-target="permission_groups_create" class="select-all text-success btn-link">({{ trans('data_entry_screens.Select_All') }})</span>
            <span data-select2-target="permission_groups_create" class="de-select-all text-success btn-link">({{ trans('data_entry_screens.Deselect_All') }})</span>
        </label>
        <select name="permission_groups[]" id="permission_groups_create" class="select2 select2-multiple" multiple="" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
            @foreach($groups as $group)
                <option value="{{ $group->uuid }}">{{ $group->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                {{ trans('data_entry_screens.Submit') }}
            </button>
        </div>
    </div>
</form>
