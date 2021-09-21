$(document).ready(function(){

    $('body').on('click', '.select-all', function () {
        var target = $(this).attr('data-select2-target');

        // Select
        $("#"+target+" > option").prop("selected",true);
        $("#"+target).select2();

        // Checkbox
        $(".all-checkbox input").prop("checked",true);
    });

    $('body').on('click', '.de-select-all', function () {
        var target = $(this).attr('data-select2-target');

        // Select
        $("#"+target+" > option").prop("selected",false);
        $("#"+target).select2();

        // Checkbox
        $(".all-checkbox input").prop("checked",false);
    });

    var loader = '<div class="loading"><div class="loader"></div></div>';
    function addLoader() {
        $('body').append(loader);
    }
    function removeLoarder() {
        $('.loading').hide(200).remove();
    }

    // General Update
    $('body').on('click', '.update-modal', function (event) {
        event.preventDefault();
        var url, targetModal;
        url = $(this).attr('href');
        targetModal = $('#update-modal');

        // Get contents
        $.ajax({
            method:'GET',
            url:url,
            beforeSend:function () {
                addLoader();
            },
            success:function (data) {
                targetModal.find('#editModalLabel').text(data.title);
                targetModal.find('.modal-body').html(data.view);
                // Select2
                $(".select2").select2();
                removeLoarder();
            },
            error:function () {

            }
        });

        // Show modal
        targetModal.modal();
    });

    // General Confirm Delete
    $('body').on('click', ".confirm-delete", function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        $('#confirm-delete-form').attr('action', link);
        $("#confirm_delete_modal").modal('toggle');
    });
});
