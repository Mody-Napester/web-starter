<form method="post" action="{{ route('permission-groups.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label>{{ trans('user_actions.Name') }}</label>
        <input type="text" name="name" class="form-control" required placeholder="{{ trans('user_actions.Name') }}"/>
    </div>

    <div class="form-group m-b-0">
        <button type="submit" class="btn btn-primary waves-effect waves-light">
            {{ trans('user_actions.Submit') }}
        </button>
    </div>
</form>
