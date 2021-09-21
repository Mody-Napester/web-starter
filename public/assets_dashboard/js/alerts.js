// Alert
function addAlert(type, text, forever = 0){
    var alertDiv = '<div class="row alert-div alert alert-'+ type +' clearfix"><div class="col-md-10 p-0 m-0">'+ text +'</div> <div class="col-md-2 p-0 m-0 text-right"><i class="alert-close fa fa-fw fa-close"></i></div></div>';
    $('.float-alert').append(alertDiv);

    if (forever == 0){
        setTimeout(function () {
            $('.alert-close').trigger('click');
        }, 5000);
    }
}
$('body').on('click', '.alert-close', function () {
    $(this).parents('.alert-div').hide(500, function () {
        $(this).remove();
    });
});