$(document).on('click', '.manage-cart', function () {
    var url = $(this).parents('form').attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        method : "POST",
        success: function(res) {
            console.log(res);
        }
    });
});
