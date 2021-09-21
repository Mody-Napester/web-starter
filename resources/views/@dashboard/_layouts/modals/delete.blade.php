<div class="modal fade" id="confirm_delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" id="confirm-delete-form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete this?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Are you sure you want to delete this for ever?</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="fire-loader-button btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
