
//ajax for actually incrementing amount of products showed
$(document).ready(function() {
    var offset = 6;
    $('#loadMore').click(function() {
        $.ajax({
            url: '/buyAjax',
            type: 'GET',
            data: { offset: offset },
            success: function(response){
                // Append the new products to your product list
                $('#productList').append(response.html);
                // Increment the offset for the next click
                offset += 6;
                console.log(response);

                if(response.SENDSTUFF.length ===0){
                    $('#loadMore').hide();
                }

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});




//ajax for searching for products
$(document).ready(function() {
    $('#searchField').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: "/search",
            type: "GET",
            data: {query:query},
            success: function(data){
                $('#productList').html(data.html);
                console.log(query)
            }
        });
    });
});
