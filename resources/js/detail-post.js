function changeLike (id) {
    const likesText = $('#likes');
    $(id).click(function(){
        let urlChangeLike  = $(id).data('url');
        $.ajax({
            type: 'GET',
            url: urlChangeLike,
            success: function (data) {
                likesText.text(data)
            },
            error: function(data){
                console.log("error", data)
            }
        })
    })
}

$(document).ready(function(){
    const increaseId = '#increase-like';
    const decreaseId = '#decrease-like';
    changeLike(increaseId);
    changeLike(decreaseId);
})

