/*
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



//Above method, but hides the initial 3 products when called
//Fades in and out to easier show that something is being loaded
$(document).ready(function() {
    $('#searchField').on('keyup', function() {
        var query = $(this).val();
        if(query) {
            $.ajax({
                url: "/search",
                type: "GET",
                data: {query:query},
                success: function(data){
                    $('#initialList').fadeOut();
                    $('#productList').html(data.html).fadeIn();
                    console.log(query);
                }
            });
        }
        else {
            $('#productList').fadeOut();
            $('#initialList').fadeIn();
        }
    });
});
*/
var offset = 6;

$(document).ready(function () {
    $(document).on('click', '#loadMore', function () {
        $.ajax({
            url: '/buyAjax',
            type: 'GET',
            data: {offset: offset},
            success: function (response) {
                $('#productList').append(response.html);
                offset += 6;
                console.log(response);
                console.log(offset)

                if (response.SENDSTUFF.length === 0) {
                    $('#loadMore').hide();
                }

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function () {
    var initialSearchedProducts = $('#initialList').html();
    $('#searchField').on('keyup', function () {
        var query = $(this).val();
        if (query) {
            $.ajax({
                url: "/search",
                type: "GET",
                data: {query: query},
                success: function (data) {
                    $('#initialList').html("");
                    $('#productList').html(data.html).fadeIn();
                    console.log(query);
                }
            });
        } else if ($('#searchField').empty()) {
            $('#productList').html("");
            $('#initialList').html(initialSearchedProducts);
            $('#loadMore').show();
            offset = 6;
            console.log("i got to here")
        }
    });
});
