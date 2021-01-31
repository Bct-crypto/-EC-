<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6138d6e315.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/top.css">
    <link rel="stylesheet" href="css/style.css">
    <title><?php echo $title; ?></title>
</head>

<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="index.php" class="navbar-brand">Tech Circle.</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navmenu1">
                <ul class="navbar-nav">
                    <?php if (empty($_SESSION['user_id'])) :  ?>
                        <li class="nav-item active">
                            <a class="nav-link mr-3" href="signup.php">SignUp</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item active">
                            <a class="nav-link mr-3" href="mypage.php">MyPage</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

    </header>

    <p id="js-show-msg" style="display:none;" class="alert-success msg-slide">
        <?php echo getSessionFlash('msg_success'); ?>
    </p>

    <!-- Main -->
    <?php include $content; ?>

    <!-- Footer -->
    <footer id="footer" class="footer fixed-bottom mt-auto py-3 bg-dark">
        <div class="container center-block text-center">
            <span class="text-white ">Copyright</span>
        </div>
    </footer>

    <!-- 自作のjs -->
    <script>
        $(function() {
            // メッセージ表示
            var $jsShowMsg = $('#js-show-msg');
            var msg = $jsShowMsg.text();
            if (msg.replace(/^[\s　]+|[\s　]+$/g, "").length) {
                $jsShowMsg.slideToggle('slow');
                setTimeout(function() {
                    $jsShowMsg.slideToggle('slow');
                }, 5000);
            }

            // お気に入り登録・削除
            var $like,
                likeProductId;
            $like = $('#js-click-like') || null; //nullというのはnull値という値で、「変数の中身は空ですよ」と明示するためにつかう値

            console.log($like);
            likeProductId = $like.attr('data-product_id') || null;
            // 数値の0はfalseと判定されてしまう。product_idが0の場合もありえるので、0もtrueとする場合にはundefinedとnullを判定する
            console.log(likeProductId);
            if (likeProductId !== undefined && likeProductId !== null) {
                $like.on('click', function() {
                    var $this = $(this);
                    $.ajax({
                        type: "POST",
                        url: "ajax.php",
                        data: {
                            productId: likeProductId
                        }
                    }).done(function(data) {
                        console.log('Ajax Success');
                        // クラス属性をtoggleでつけ外しする
                        $this.toggleClass('active');
                    }).fail(function(msg) {
                        console.log('Ajax Error');
                    });
                });
            }

            var jsMsgCount = $('#js-count-msg'),
                jsCountView = $('#js-count-view');
            jsMsgCount.on('keyup', function(e) {
                jsCountView.html($(this).val().length);
            });


        });
    </script>
</body>

</html>
