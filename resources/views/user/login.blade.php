<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng Nhập</title>

    {{-- <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<style>
    .myt-5 {
        margin-top: 10rem !important;
    }

</style>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg myt-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo3.png') }}" alt="">
                                    </div>
                                    <form class="user" action="" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email"
                                                name="email">
                                            @if ($errors->has('email'))
                                                <span id="emailError"
                                                    class="text-danger font-weight-bold">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Mật khẩu" name="password">
                                            @if ($errors->has('password'))
                                                <span id="passwordError"
                                                    class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="checkbox" name="remember" id="remember">
                                                <label for="remember">Remember</label>
                                            </div>
                                            <div class="col-md-6"> <button
                                                    class="btn btn-primary btn-user btn-block">
                                                    Đăng nhập
                                                </button></div>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<?php
$error = Session::get('error');
if ($error) {
    echo "<script>alert('$error')</script>";
    Session::forget('error');
}
?>
<script>
    let emailError = document.querySelector('#emailError');
    let passwordError = document.querySelector('#passwordError');
    $(document).ready(function() {
        if (emailError) {
            $('#exampleInputEmail').css('border', '1px solid red');
        }
        if (passwordError) {
            $('#exampleInputPassword').css('border', '1px solid red');
        }

    });
</script>

</html>
