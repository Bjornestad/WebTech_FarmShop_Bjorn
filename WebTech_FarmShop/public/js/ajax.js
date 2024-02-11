function getProductList(){
    $(document).ready(function (){
        $('#getProductList').click(function (){
            $.ajax({
                url: '/get-products',
                type: 'GET',
                dataType: 'json',
                success: function (response){
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
}
