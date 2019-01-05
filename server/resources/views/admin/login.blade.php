<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dipacommerce</title>

    <!-- Bootstrap Core CSS -->
    <link href="/public/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/public/admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/public/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/public/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form class="frm_login" role="form" action="/admin/login" method="post">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input required="true" class="form-control ip_username" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input required="true" class="form-control ip_password" placeholder="Password" name="password" type="password" value="">
                                </div>
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input name="remember" type="checkbox" value="Remember Me">Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="javascript: void(0);" class="btn btn-lg btn-success btn-block btn-login">Login</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/public/admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/public/admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/public/admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/public/admin/dist/js/sb-admin-2.js"></script>

    <script src="/public/admin/js/message.js"></script>

    <script>
        $(".btn-login").on('click', function (event) {
            let username = $(".ip_username").val();
            let password = $(".ip_password").val();

            let isValidUsername = regex.test(username);
            let isValidPassword = regex.test(password);

            if (isValidUsername === false) {
                showMessage(usernameRequired);
                return;
            }

            if (isValidPassword === false) {
                showMessage(passwordRequired);
                // $('.alertMessage').html(passwordRequired);
                // $(".alertModal").modal('show');
                return;
            }
            $(".frm_login").submit();
        });
    </script>

    @if(isset($message))
        <script>
            showMessage("{{$message->getContent()}}");
        </script>
    @endif
</body>
</html>
