
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Registro - GameSpeak.com.br</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->


<div class="container">
    <!-- BASIC FORM ELELEMNTS -->
    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <h2 class="form-login-heading">Registre-se</h2>
                @include('partials.error_display')
                <form class="form-horizontal style-form" method="POST" action="{{ route('auth.register') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            <span class="help-block">seu nome</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            <span class="help-block">Email da conta.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Senha</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                            <span class="help-block">Digite uma senha.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Confirme a senha</label>
                        <div class="col-sm-10">
                            <input type="password" name="cpassword" class="form-control" value="{{ old('cpassword') }}">
                            <span class="help-block">Confirme uma senha.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">

                        </div>
                        <div id="col-sm-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Inserir servidor</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- col-lg-12-->
    </div><!-- /row -->
</div>


<!-- js placed at the end of the document so the pages load faster -->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="/assets/js/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("/assets/img/bg-login.jpg", {speed: 500});
</script>


</body>
</html>