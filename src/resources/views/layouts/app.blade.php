<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    <header class="site-header">
        <h1 class="site-header__logo">FashionablyLate</h1>
        @if(!empty($headerLink))
        <div class="site-header__nav">
            @if($headerLink === 'login')
                <a href="{{ $headerLinkUrl ?? '/login' }}" class="site-header__link">login</a>
            @elseif($headerLink === 'register')
                <a href="{{ $headerLinkUrl ?? '/register' }}" class="site-header__link">register</a>
            @elseif($headerLink === 'logout')
                <form class="header-logout" action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="site-header__link site-header__link--button">logout</button>
                </form>
            @endif
        </div>
        @endif
    </header>
    <main class="page-main">
        @yield('content')
    </main>
</body>
</html>
