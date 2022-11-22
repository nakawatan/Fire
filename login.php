<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BFP R4A Mabini</title>
    <link rel="icon" type="img/png" sizes="16x16" href="img/bfp.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://accounts.google.com/gsi/client" async defer></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-gradient-primary">
                              <img src="img/bfp.png" alt=""
                                style="width: 35%; margin-left: auto; margin-right: auto; display: block; margin-top: 50%;" >
                              <p 
                                style="color: beige; text-align: center; margin-top: -45%; font-size: 24px; font-weight: 800;">
                                BFP R4A Mabini Fire Station</p>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php if (isset($_GET['error'])) { ?>
	  		                          <div class="alert alert-danger" role="alert">
			                             <?=htmlspecialchars($_GET['error'])?>
			                          </div>
		                            <?php } ?>
                                    <form action="d_login.php" class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter User Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-user btn-primary btn-block" >Login</button>
                                        <hr>
                                        <div id="g_id_onload"
                                            data-client_id="604330538667-7dui7fgm950clhlr6tfnurq6gigbnlro.apps.googleusercontent.com"
                                            data-callback="onSignIn">
                                        </div>
                                        <div class="g_id_signin" data-type="standard"></div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        function parseJwt (token) {
                var base64Url = token.split('.')[1];
                var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join(''));

                return JSON.parse(jsonPayload);
            }
            function onSignIn(googleUser) {
                jwt = parseJwt(googleUser.credential);
                console.log(jwt);
                $.ajax({
                    url: '/api/',
                    data: {
                        method:"check_client",
                        email:jwt.email
                    },
                    method: 'POST',
                    dataType:"json",
                    success: function(response) {
                        if (!response.exist) {
                            $.ajax({
                                url: '/api/',
                                data: {
                                    method:"login_client",
                                    email:jwt.email,
                                    name:jwt.name,
                                    username:jwt.email,
                                    password:+new Date + ""
                                },
                                method: 'POST',
                                dataType:"json",
                                success: function(response) {
                                    if(response.status == "ok"){
                                        // window.location.href="/index.php";
                                    }
                                }
                            });
                        }else {
                            window.location.href="/index.php";
                        }
                    }
                });
            }
    </script>
</body>

</html>