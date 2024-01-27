(function () {
    "use strict";

    $(".delete-button").on("click", function (e) {
        e.preventDefault();
        var item = $(this).data('item');
        item = JSON.parse(item);
        var action = $(this).data('action');

        $("#delete-form").attr("action", action);
    });
})();
