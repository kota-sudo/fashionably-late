<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    @if(!empty($showHeader))
    <header class="page-header">
        <h1 class="page-header__title">FashionablyLate</h1>
        <div class="page-header__link">
            @if(isset($headerLink) && $headerLink === 'login')
                <a href="{{ $headerLinkUrl ?? '/login' }}">login</a>
            @elseif(isset($headerLink) && $headerLink === 'register')
                <a href="{{ $headerLinkUrl ?? '/register' }}">register</a>
            @elseif(isset($headerLink) && $headerLink === 'logout')
                <form class="header-logout" action="/logout" method="POST">
                    @csrf
                    <button type="submit">logout</button>
                </form>
            @endif
        </div>
    </header>
    @endif
    <main class="page-main">
        @yield('content')
    </main>
</body>
</html>
