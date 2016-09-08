<html><head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>iPrint | Log in</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/bower_components/AdminLTE/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/bower_components/AdminLTE/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            .login-page {
                background-image: url(static-img/background.jpg);
                background-color: transparent;   
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: scroll;
                background-size: cover;
            }        
        </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html">
                    <img src="/static-img/iprintlogo.jpg">
                </a>
            </div>
            <!-- /.login-logo -->

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-register-user" data-toggle="tab">Register User</a></li>
                    <li><a href="#tab-register-store" data-toggle="tab">Register My Store</a></li>                   
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-register-user">
                        <div class="row">

                            <div class="col-sm-12">

                                <form id="form-register-user" action="/register/user" method="POST">

                                    <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" name="email" required class="form-control" placeholder="Email" value="{{ old('email') }}">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <input type="name" name="name" required class="form-control" placeholder="Display Name" value="{{ old('name') }}">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" name="password" required class="form-control" placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                        @if ($errors->has('password1'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input type="password" name="password" required class="form-control" placeholder="Repeat Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                        @if ($errors->has('password2'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-xs-offset-7 col-xs-5">
                                        <button id="action-register-user" type="button" class="btn btn-primary btn-block btn-flat">Register User</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab-register-store">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div><!-- /.tab-pane -->                  
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->

        </div>
        <!-- /.login-box -->

        <!-- jQuery 2.2.3 -->
        <script src="/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="/bower_components/AdminLTE/plugins/iCheck/icheck.min.js"></script>

        <script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
        </script>

        <script src="/vendor/jquery/jquery.validate.js"></script>
        <script src="/js/pages/registration/register.js"></script>

    </body>
</html>