<div class="navbar">
    <img class="logo" src="{{asset('images/FarmShop-logos_white.png')}}" alt="logo">
    <nav class="bar">
        <ul class="nav_links">
            <li><a href="{{route('home')}}">Home</a></li>
            {{--            <li><a href="{{route('userpage')}}">User</a></li>--}}
            {{--            <li><a href="{{route('buy')}}">Buy</a></li>--}}
            {{--            <li><a href="{{route('basket')}}">Basket</a></li>--}}
            {{--            <li><a href="{{route('logOut')}}">Logout</a></li>--}}
            @if(Auth::check())
                {{--user is logged in--}}
                <li><a href="{{route('userpage',['id'=>Auth::user()->id])}}">User</a></li>
                <li><a href="{{route('buy')}}">Buy</a></li>
                <li><a href="{{route('buyAjax')}}">Ajax</a></li>
                <li><a href="{{route('basket')}}">Basket</a></li>
                <li><a href="{{route('logOut')}}">Logout</a></li>
                @if(Auth::user()->isAdmin)
                    {{--user is also admin, and can access the adminpage--}}
                    <li><a href="/admin">Admin</a></li>
                @endif
            @else()
                {{--is not logged in--}}
                <li><a href="{{route('login')}}">Login</a></li>
            @endif
        </ul>
    </nav>
</div>


