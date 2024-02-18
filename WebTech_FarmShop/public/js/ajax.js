
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

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});





//ajax thing for retrieving productsd on button pressed, this is the bad one
/*
$(document).ready(function (){
    $('#getProductList').click(function (){
        $.ajax({
            url: '/get-products',
            type: 'GET',
            dataType: 'json',
            success: function (response){
                console.log(response);

                var products = response.products;
                var productList = $('#productList');
                productList.empty();

                products.forEach(function (product){
                    productList.append('<p>' + product.name + '</p>');
                });
            },
            error: function (xhr, status, error){
                console.error(error);
            }
        });
    });
});
*/
//ajax for searching for products
$(document).ready(function() {
    $('#search').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "/search",
            type: "GET",
            data: {query: query},
            success: function(data){
                // Display search results
                $('#search').html(data);
                //print search in console for reasons yes
                console.log(query)
            }
        })
    });
});
