$(function () {
    $('#submit').on('click', function (e) {
        e.preventDefault();
        let pseudoValue = $('#pseudo').val();
        let commentValue = $('#comment').val();
        $.post('comment.php', {
                pseudo: pseudoValue,
                comment: commentValue
            },
            function (data) {
                if (data.status === 'success') {
                    $('#comment').val('');
                    $('#comment').append(`<p><strong>${data.pseudo}</strong> : ${data.comment}</p>`);
                } else {
                    alert('error');
                }
            }, 'json');
    });
});

//affiche en javascript le commentaire
/*                 $('#comments').append(`
            <div class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
            <p class="mb-1">` + commentValue + `</p>
            </div>`)
                $('#comment').val("");
                $('#pseudo').val("");
            })
    })
}) */