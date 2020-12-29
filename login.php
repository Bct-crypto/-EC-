<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="navbar px-5 navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Tech Circle.</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </header>

    <div class="container text-center">
        <main class="form-signIn">
            <form action="#" method="post">
                <img src="" alt="">
                <h1 class="h2 text-dark mb-3">サインイン</h1>
                <label for="inputEmail" class="sr-only">E-mail</label>
                <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Emailアドレス" required autofocus>
                <label for="inputPass" class="sr-only">E-mail</label>
                <input type="password" id="inputPass" class="form-control mb-3" placeholder="パスワード" required>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="remember-me" id="rememberCheck">
                    <label class="form-check-label float-start" for="rememberCheck">
                        ログイン状態を保持する
                    </label>
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-primary">サインイン</button>
            </form>
        </main>
    </div>


    <footer class="footer fixed-bottom mt-auto py-3 bg-dark">
        <div class="container center-block text-center">
            <span class="text-white ">Copyright</span>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
