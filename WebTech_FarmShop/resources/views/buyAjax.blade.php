@extends('ViewTemplate')

@section('script')
    <script defer src="{{asset('js/cookieManager.js')}}"></script>
    <script defer src="{{asset('js/ajax.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection


@section('title')
    <title>Basket</title>
@endsection


@section('header')
@endsection


@section('main')
    {{-- just here to test, moved to actual js file
    <script>
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
    </script>
    --}}

    <div>
        <h1>Buy Local Organic Products</h1>

        <div class="buy-main">
            {{--
            This loads the initial n products, where n is chosen in the AjaxController, if
            it isnt limited, it will just load all products, which isnt really wanted
            --}}
            @foreach($SENDSTUFF as $product)
                @include('components.product-card', [
                    'productTitle' => ucfirst(str_replace('_', ' ', $product->name)),
                    'src' => asset('images/' . $product->pictures->fileName . $product->pictures->fileExtension),
                    'productInput' => $product->name . '-input',
                    'productDescription' => $product->description,
                    'product' => $product
                ])
            @endforeach
            <div>
    {{--
    Div and button for loading more products beyong the initial n that is there on start up
    loadMore calls the ajax function in Ajax.js, which then request data from the database through
    the AjaxController method LimitShowing
    --}}
                <div class="buy-main" id="productList"></div>

                <button id="loadMore">Load more products</button>
            </div>

        </div>
    </div>

    <div>
{{--
        The names of the product currently go by database name and not "screen name"
        meaning that if you want to search for Beef Sausage it has to be beef_sausage
        as that is its name in the database
--}}
        <input type="text" id="searchField" placeholder="search">
        <div id="productList"></div>
    </div>


@endsection

