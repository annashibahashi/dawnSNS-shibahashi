<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id="head">
            <a href="/top"><img src="/storage/images/main_logo.png"></a>
            <div id="accordion" class="accordion-container">
                <h1 class="accordion-title js-accordion-title">
                    <img src="{{ asset('/storage/images/'.$auth->images) }}" class="top_icon">
                    <p>{{$auth->username}}さん</p>
                </h1>
                <div class="container-item-img">
                    <div class="accordion-content">
                        <ul>
                            <li><a href="/top">ホーム</a></li>
                            <li><a href="/profile">プロフィール</a></li>
                            <li><a href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p>{{$auth->username}}さんの</p>
                <div class='list'>
                    <p class="left">フォロー数</p>
                    <p class="right">{{$followlist}}名</p>
                </div>
                <p class="list_btn"><a href="/follow-list">フォローリスト</a></p>
                <div class='list'>
                    <p class="left">フォロワー数</p>
                    <p class="right">{{$followerlist}}名</p>
                </div>
                <p class="list_btn"><a href="/follower-list">フォロワーリスト</a></p>
            </div>
            <p class="search_btn"><a href="/search">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('js/accordion.js')}}"></script>
    <script src="{{asset('js/style.js')}}"></script>
</body>

</html>
