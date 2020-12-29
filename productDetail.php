<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>商品詳細 | WEBUKATU MARKET</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
        .badge {
            padding: 5px 10px;
            color: white;
            background: #7acee6;
            margin-right: 10px;
            vertical-align: middle;
            position: relative;
            top: -4px;
        }

        #main .title {
            font-size: 28px;
            padding: 10px 0;
        }

        .product-img-container {
            overflow: hidden;
        }

        .product-img-container img {
            width: 100%;
        }

        .product-img-container .img-main {
            width: 650px;
        }
    </style>
</head>

<body class="page-productDetail page-1colum">

    <!-- メニュー -->
    <header>
        <div class="site-width">
            <h1><a href="index.html">WEBUKATU MARKET</a></h1>
            <nav id="top-nav">
                <ul>
                    <li><a href="signup.html" class="btn btn-primary">ユーザー登録</a></li>
                    <li><a href="">ログイン</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <div id="contents" class="site-width">
        <!-- Main -->
        <section id="main">
            <div class="title">
                <span class="badge">スマホ</span>
                iPhoneX
            </div>

            <div class="product-img-container">
                <div class="img-main">
                    <img src="img/sample01.jpg" alt="">
                </div>
            </div>
        </section>

    </div>

    <!-- footer -->
    <footer id="footer">
        Copyright <a href="http://webukatu.com/">ウェブカツ!!WEBサービス部</a>. All Rights Reserved.
    </footer>

    <script src="js/vendor/jquery-2.2.2.min.js"></script>
    <script>
        $(function() {
            var $ftr = $('#footer');
            if (window.innerHeight > $ftr.offset().top + $ftr.outerHeight()) {
                $ftr.attr({
                    'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) + 'px;'
                });
            }
        });
    </script>
</body>

</html>
