$(document).on('click', '.manage-cart', function () {

    var element = $(this);
    var form = element.parents('form');
    var url = form.attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        method : "POST",
        success: function(res) {
            var inCartDiv = form.children('.in-cart');
            var notInCartDiv = form.children('.not-in-cart');
            inCartDiv.show();
            notInCartDiv.hide();
        }
    });
});
