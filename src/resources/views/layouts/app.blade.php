<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <script src="https://kit.fontawesome.com/dbdf1c424a.js" crossorigin="anonymous"></script>
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__contents">
            <div class="header__inner">
                <!-- ナビ部分 -->
                <nav class="header__nav">
                    <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
                    <input id="drawer_input" class="drawer_hidden" type="checkbox">

                    <!-- ハンバーガーアイコン -->
                    <label for="drawer_input" class="drawer_open"><span></span></label>

                    <!-- メニュー -->
                    <ul class="header__nav--list">
                        <li class="header__nav--item">
                            <a class="header__nav--link" href="/">Home</a>
                        </li>
                        @if (Auth::check())
                        <li class="header__nav--item">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="header__nav--button">Logout</button>
                            </form>
                        </li>
                        <li class="header__nav--item">
                            <a class="header__nav--link" href="/mypage">Mypage</a>
                        </li>
                        @else
                        <li class="header__nav--item">
                            <a class="header__nav--link" href="/register">Registration</a>
                        </li>
                        <li class="header__nav--item">
                            <a class="header__nav--link" href="/login">Login</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div>
                <a class="header__logo" href="/">
                    Rese
                </a>
            </div>
        </div>
        @yield('header')

    </header>

    <main class="main">
        @yield('content')
    </main>

</body>

</html>