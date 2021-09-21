<form method="post" action="{{ route('permission-groups.update', $resource->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="form-group">
        <label>{{ trans('user_actions.Name') }}</label>
        <input type="text" name="name" class="form-control" required placeholder="{{ trans('user_actions.Name') }}" value="{{ $resource->name }}"/>
    </div>

    <div class="form-group m-b-0">
        <button type="submit" class="btn btn-success waves-effect waves-light">
            {{ trans('user_actions.Submit') }}
        </button>
    </div>
</form>
