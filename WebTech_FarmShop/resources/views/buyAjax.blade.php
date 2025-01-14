@extends('ViewTemplate')

@section('script')
    <script defer src="{{asset('js/cookieManager.js')}}"></script>
    <script defer src="{{asset('js/ajax.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/ajax.css')}}"

@endsection


@section('title')
    <title>Basket</title>
@endsection


@section('header')
@endsection
{{--

(moved all comments up here because they were annoying, not gonna make alot of sense, move if remember)
        The names of the product currently go by database name and not "screen name"
        meaning that if you want to search for Beef Sausage it has to be beef_sausage
        as that is its name in the database

        This loads the initial n products, where n is chosen in the AjaxController, if
        it isnt limited, it will just load all products, which isnt really wanted

        Div and button for loading more products beyong the initial n that is there on start up
        loadMore calls the ajax function in Ajax.js, which then request data from the database through
        the AjaxController method LimitShowing
--}}
@section('main')

    <div>
        <h1>Buy Local Organic Products</h1>
        <div>
            <div>
                <input type="text" id="searchField" class="searchAjax" placeholder="search">

                <div class="buy-main" id="initialList">
                    @foreach($SENDSTUFF as $product)
                        @include('components.product-card', [
                            'productTitle' => ucfirst(str_replace('_', ' ', $product->name)),
                            'src' => asset('images/' . $product->pictures->fileName . $product->pictures->fileExtension),
                            'productInput' => $product->name . '-input',
                            'productDescription' => $product->description,
                            'product' => $product
                        ])
                    @endforeach
                </div>


                <div id="productList" class="buy-main"></div>
                <div id="loadingText" style="display: none;" class="center">Loading...</div>
                <button id="loadMore" class="btnAjax">Load more products</button>
            </div>
        </div>
    </div>
@endsection

