/* $(document).ready(function () {
    $('#submit').on('click', function (e) {
        e.preventDefault();
        let message = $('#comment');
        $.post('comment.php', {
            message: message.val()
        }, function (data) {
            console.log(data);
        })
        //affiche en javascript le commentaire
        $('#comments').append(`
            <div class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
            <p class="mb-1">`+commentValue+`</p>
        </div>`
        )
        $('#comment').val("");
    })
}) */