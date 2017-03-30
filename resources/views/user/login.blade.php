<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{!! $data['title'] !!}</title>
    <link rel="icon" href="/assets/default_icons/logo.png">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">

    <?php
        if (isset($data['styles'])) {
            foreach ($data['styles'] as $style) {
                echo '<link rel="stylesheet" href="/css/' . $style . '">';
            }
        }
    ?>

</head>
<body class="hold-transition register-page">

    <div class="register-box">
        <div class="register-logo">
            <b>SWAN</b> Scripter
        </div>
        <div class="alert alert-danger" id="error"></div>
        <div class="register-box-body">
            <p class="login-box-msg">Login as a SWAN</p>
            <form action="" id="login">
                <div class="form-group has-feedback">
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
{{--
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                                    <input type="checkbox" name="agree-terms" id="agree-terms">
                                </div> I agree to the
                                <a href="">terms</a>
                            </label>
                        </div>
                    </div>
--}}
                    <div class="col-xs-4 col-xs-offset-8">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </div>
            </form>
            <div class="register-login-related">
                <a href="/">I have no SWAN account.</a>
            </div>
        </div>
    </div> {{-- end of register-box--}}

</body>
    <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <?php
    if (isset($data['scripts'])) {
        foreach ($data['scripts'] as $script) {
            echo '<script src="/js/'. $script . '"></script>';
        }
    }
    ?>
</html>