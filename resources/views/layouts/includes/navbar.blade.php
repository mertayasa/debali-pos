<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand py-0" href="{{ url('/') }}">
            <img src="{{ asset('images/default/logo.png') }}" style="height: 50px" alt="" srcset="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown fs-5">
                        <a class="nav-link {{ isActive('home') }}" href="{{ route('home.index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown fs-5">
                        <a class="nav-link {{ isActive('customer') }}" href="{{ route('customer.index') }}">Customer</a>
                    </li>
                    <li class="nav-item dropdown fs-5">
                        <a class="nav-link {{ isActive('product') }}" href="{{ route('product.index') }}">Product</a>
                    </li>
                    <li class="nav-item dropdown fs-5">
                        <a class="nav-link {{ isActive('sale') }}" href="{{ route('sale.index') }}">Sale</a>
                    </li>
                    <li class="nav-item dropdown fs-5">
                        <a class="nav-link {{ isActive('expense') }}" href="{{ route('expense.index') }}">Expense</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link {{ isActive(['product-category', 'expense-category', 'supplier']) }} dropdown-toggle fs-5 {{ isActive(['product-categories', 'expense-categories']) }}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Master Data
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item fs-5" href="{{ route('product_category.index') }}">Prduct Cat</a>
                            <a class="dropdown-item fs-5" href="{{ route('expense_category.index') }}">Expense Cat</a>
                            <a class="dropdown-item fs-5" href="{{ route('supplier.index') }}">Supplier</a>
                        </div>
                    </li>
                </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item fs-5" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>