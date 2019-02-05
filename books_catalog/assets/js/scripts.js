jQuery( document ).ready(function($) {
    $("form.add-book-form").on("submit", function (event) {
        event.preventDefault();
        var book_title = $("#book_title").val();
        var book_description = $("#book_description").val();
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            data: {
                action: 'add_book_ajax',
                book_title: book_title,
                book_description: book_description
            },
            success: function (response) {
                $('#add-book-wrapper').html(response);
            }
        });
    });
});