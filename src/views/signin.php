<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=<?= assets("admin/plugins/fontawesome-free/css/all.min.css") ?>>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href=<?= assets("admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css") ?>>
    <!-- Theme style -->
    <link rel="stylesheet" href=<?= assets("admin/dist/css/adminlte.min.css") ?>>
</head>
<body class="hold-transition login-page">

    <div class="login-box">
    <?php 
        if(!empty($error)){
    ?>
    <div class="alert alert-warning opacity-0">
            <?=$error?>
    </div>
    <?php } ?>
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1">
                <b>Reveal </b><b class="text-primary">Me</b>
                </a>
            </div>
            
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                
                <form action="/Auth/signin" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-3">
                        <div class="col-8">
                            <p class="mb-0">
                                <a href="/home/signUp" class="text-center">Register a new membership</a>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-4 align-self-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-5 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src=<?= assets("admin/plugins/jquery/jquery.min.js") ?>></script>
    <!-- Bootstrap 4 -->
    <script src=<?= assets("admin/plugins/bootstrap/js/bootstrap.bundle.min.js") ?>></script>
    <!-- AdminLTE App -->
    <script src=<?= assets("admin/dist/js/adminlte.min.js") ?>></script>
</body>
</html>
