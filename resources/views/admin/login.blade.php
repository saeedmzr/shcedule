<!DOCTYPE html>


<html dir="ltr" lang="en">


<head>


    <meta charset="utf-8">

    <title>schedule</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/style.css')}}">


</head>


<body>


<div class="login">
    <div class="loginform">
        <div class="r-loginform">
            <div class="title-form">
                <strong>Login</strong>
            </div>
            <!--title-form-->
            <form action="{{Url('loginAdmin')}}" method="post">
                @csrf


                <input type="text" placeholder="Email" name="email" id="username">
                <input type="password" placeholder="Password" name="password" id="password">
                <input type="submit" value="Sign In">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="alert alert-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
            </form>
        </div>
        <!--r-loginform-->
    </div>

</div>

<div class="shadow"></div>
</body>

</html>

<style>
    html {
        height: 100%
    }
    .alert {
        color: black;
    }
    ::-moz-selection {
        background: #fe57a1;
        color: #fff;
        text-shadow: none;
    }


    ::selection {


        background: #fe57a1;


        color: #fff;


        text-shadow: none;


    }


    body {


        background: url('http://techno.test-web.ir/AdminLTE/dist/img/login-back.jpg') no-repeat;
        background-size: cover;


    }


    .login,
    .forget-pass {


        background: #eceeee;


        border-radius: 6px;


        height: 350px;


        margin: 12% auto 0;


        width: 60%;


    }


    .login h1 {


        background-image: linear-gradient(top, #f1f3f3, #d4dae0);


        border-bottom: 1px solid #a6abaf;


        border-radius: 6px 6px 0 0;


        box-sizing: border-box;


        color: #727678;


        display: block;


        height: 43px;


        font: 600 14px/1 'Open Sans', sans-serif;


        padding-top: 14px;


        margin: 0;


        text-align: center;


        text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2), 0 1px 0 #fff;


    }


    input[type="password"],
    input[type="text"] {


        background: url('http://i.minus.com/ibhqW9Buanohx2.png') center left no-repeat, linear-gradient(top, #d6d7d7, #dee0e0);


        border: 1px solid #a1a3a3;


        border-radius: 4px;


        box-shadow: 0 1px #fff;


        box-sizing: border-box;


        color: #696969;


        height: 39px;


        margin: 8px auto 0;


        padding: 0 15px;


        transition: box-shadow 0.3s;


        width: 240px;


    }


    input[type="password"]:focus,
    input[type="text"]:focus {


        box-shadow: 0 0 4px 1px rgba(55, 166, 155, 0.3);


        outline: 0;


    }


    .show-password {


        display: block;


        height: 16px;


        margin: 26px 0 0 28px;


        width: 87px;


    }


    input[type="checkbox"] {


        cursor: pointer;


        height: 16px;


        opacity: 0;


        position: relative;


        width: 64px;


    }


    input[type="checkbox"]:checked {


        left: 29px;


        width: 58px;


    }


    .toggle {


        background: url(http://i.minus.com/ibitS19pe8PVX6.png) no-repeat;


        display: block;


        height: 16px;


        margin-top: -20px;


        width: 87px;


        z-index: -1;


    }


    input[type="checkbox"]:checked + .toggle {


        background-position: 0 -16px
    }


    input[type="submit"] {


        width: 240px;


        height: 35px;


        display: block;


        font-family: Arial, "Helvetica", sans-serif;


        font-size: 16px;


        font-weight: bold;


        color: #fff;


        text-decoration: none;


        text-transform: uppercase;


        text-align: center;


        text-shadow: 1px 1px 0px #37a69b;


        margin: 20px auto 0;


        position: relative;


        cursor: pointer;


        border: none;


        background-color: #37a69b;


        background-image: linear-gradient(top, #3db0a6, #3111);


        border-top-left-radius: 5px;


        border-top-right-radius: 5px;


        border-bottom-right-radius: 5px;


        border-bottom-left-radius: 5px;


        box-shadow: inset 0px 1px 0px #2ab7ec, 0px 5px 0px 0px #497a78, 0px 10px 5px #999;


    }


    .shadow {


        background: #000;


        border-radius: 12px 12px 4px 4px;


        box-shadow: 0 0 20px 10px #000;


        height: 12px;


        margin: 30px auto;


        opacity: 0.2;


        width: 60%;


    }


    input[type="submit"]:active {


        top: 3px;


        box-shadow: inset 0px 1px 0px #2ab7ec, 0px 2px 0px 0px #31524d, 0px 5px 3px #999;


    }


    .l-loginform,
    .r-loginform {
        width: 100%;
        float: left;
        height: 350px;
    }


    .l-loginform {
        text-align: center;
        background: url('http://techno.test-web.ir/AdminLTE/dist/img/welcome.jpg') no-repeat;
        background-size: cover;
    }
    .l-loginform p {
        color: #fff;
    }
    .r-loginform {
        text-align: center;
    }
    .l-loginform img {
        margin-top: 40px;
        max-height: 140px;
    }
    .top-loginform {
        border-bottom: 1px solid #ddd;
        width: 80%;
        margin: 0 auto;
        padding-bottom: 30px;
    }
    .title-form {
        margin: 30px 0;
    }
    .title-form strong {
        font-size: 24px;
        color: #001f70;
    }

    span.forgetpass,
    span.login-sp {
        display: inline-block;
        margin-top: 30px;
        color: #0061c4;
        cursor: pointer;
    }

    .login ul {
        margin-top: 30px;
        float: left;
    }

    .login ul li {
        line-height: 30px;
        list-style: none;
    }
</style>
