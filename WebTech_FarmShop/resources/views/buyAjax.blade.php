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
                <div id="productList"></div>

                <button id="loadMore">Load more products</button>
</div>

        </div>
    </div>
    <div>




        <input type="text" id="search" placeholder="search">
        <div id="search"></div>
    </div>


@endsection

