//global var for offsetting loaded items, so no replicates from database
var offset = 3;
//array to keep track of loaded products
var loadedProducts = [];
//Function for incrementing showed products with an ajax call
$(document).ready(function () {
    $(document).on('click', '#loadMore', function () {
        $.ajax({
            url: '/buyAjax',
            type: 'GET',
            data: {offset: offset},
            success: function (data) {
                /*entire html "object"? not sure to call it that or not
                *gets sent to this function, and gets appended to the page
                * would assume its bad practise to send the entire object
                * but i could not find any other way to load the products
                * while using the product-card as i wanted.
                * would most likely be better if i made a js file to load the product card
                * instead, but this was about expanding the original project, and not
                * remaking it.
                */
                $('#productList').append(data.html);
                //stuff loaded products into array to load after search
                loadedProducts.push(data.html)
                offset += 3;
                //console.log(data);
                console.log(offset)

                //hides button, if ::count(); = 0
                if (offset >= data.total) {
                    $('#loadMore').hide();
                }

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
//function for searching for products in the database using ajax
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
                    //hides initial items and fades in searched products to
                    //better show whats being loaded
                    $('#initialList').html("");
                    $('#productList').html(data.html).fadeIn();
                    console.log(query);
                }
            });
        } else if ($('#searchField').val() === '') {
            //load loaded products again
            $('#productList').html(loadedProducts.join(''));
            //show initial products again
            $('#initialList').html(initialSearchedProducts);
            //show button if it for some reason decided to hide again
            //feels random if it shows up or not again without this
            $('#loadMore').show();
            //set offset back to 3, as to let the load know we are back to the
            //beginning, should prob do something along the lines of saving where the load
            //got to, and then reloading it after the search, but like damn
            //i got no clue how to do that
            //offset = 3;
            console.log("i got to here");
        }
    });
});
