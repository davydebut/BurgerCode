$(function () {
    $('#submit').on('click', function (e) {
        e.preventDefault();
        let message = $('#comment');
        $.post('/comment.php', {
            message: message.val()
        }, function (data) {
            console.log(data);
        });
    });
});