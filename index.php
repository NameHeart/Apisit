<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page KOI CAFE</title>
    <!--Made with love by Mutiullah Samim -->
    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap" rel="stylesheet">
    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style type="text/css">
    /* Made with love by Mutiullah Samim*/
    @import url('https://fonts.googleapis.com/css?family=Numans');

    html,
    body {
        background-image: url('m_img/koi_cafe.jpg');
        background-size: cover;
        background-position: center;
        height: 100%;
        font-family: 'Kanit', sans-serif;
    }

    .container {
        height: 100%;
        align-content: center;
    }

    .card {
        height: 300px;
        margin-top: 100px;
        margin-bottom: auto;
        width: 400px;
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    .social_icon span {
        font-size: 60px;
        margin-left: 10px;
        color: #FFC312;
    }

    .social_icon span:hover {
        color: white;
        cursor: pointer;
    }

    .card-header h3 {
        color: white;
    }

    .social_icon {
        position: absolute;
        right: 20px;
        top: -45px;
    }

    .input-group-prepend span {
        width: 50px;
        background-color: #FFC312;
        color: black;
        border: 0 !important;
    }

    input:focus {
        outline: 0 0 0 0 !important;
        box-shadow: 0 0 0 0 !important;
    }

    .remember {
        color: white;
    }

    .remember input {
        width: 20px;
        height: 20px;
        margin-left: 15px;
        margin-right: 5px;
    }

    .login_btn {
        color: black;
        background-color: #CACFD2;
        width: 170px;
    }

    .login_btn2 {
        color: black;
        background-color: #CACFD2;
        width: 170px;
    }

    .login_btn:hover {
        color: black;
        background-color: white;
    }

    .links {
        color: white;
    }

    .links a {
        margin-left: 4px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <span class="glyphicon glyphicon-lock"> </span>
                    <h3>KOI CAFE</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <a href="https://www.facebook.com/profile.php?id=100067164667326" target="_blank"><span><i
                                    class="fab fa-facebook-square"></i></span></a>
                    </div>
                </div>
                <div class="card-body">
                    <form ame="formlogin" action="cheack_login.php" method="POST" id="login" class="form-horizontal">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="m_user" class="form-control" placeholder="username">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="m_pass" class="form-control" placeholder="password">
                        </div>
                        <div class="row align-items-center remember">
                            <input type="checkbox">Remember Me
                        </div>
                        <div class="form-group" align="center">
                            <input type="submit" value="เข้าสู่ระบบ" class="btn float-Right login_btn">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>