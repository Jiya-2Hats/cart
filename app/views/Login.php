<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BaseURL ?>/app/assets/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BaseURL ?>/app/assets/css/login.css" />
</head>

<body>
    <section class="vh-100" style="position: fixed;">
        <div class="container-fluid h-custom py-5">
            <div class="row d-flex justify-content-center align-items-center h-100 py-5">

                <div class="col-md-12 py-4 offset-xl-1 usercard">
                    <form method="POST" id="login" class="col-sm-12" action="<?= BaseURL ?>/login/validateUser">

                        <div class="width-text text-center ">
                            <h5 class="pb-4 text-center">Login </h5>
                            <span class="text-danger text-small"><?= (!empty($data['message'])) ?  $data['message'] : ""; ?></span>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" id="email" class="form-control" name="email" placeholder="email address" value="" required />

                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" value="" required />
                            <br />
                            <a class="text-muted" href="#!">Forgot password?</a>

                        </div>

                        <div class="text-center pt-1 mb-1 pb-5">

                            <div class="col-sm-12">
                                <input type="submit" name="login" value="Login" class="btn  btn-outline-primary  btn-lg btn-block col-sm-12">
                            </div>


                        </div>

                        <div class="d-flex align-items-center justify-content-center pb-4">
                            <p class="mb-0 me-2">Don't have an account?</p>
                            <a href="register.php" class="">Create new</a>
                        </div>

                        <div class="text-center align-items-center justify-content-center pb-4">
                            <div class="py-2">
                                <p>OR</span>
                            </div>

                        </div>

                    </form>
                    <form method="POST" action="<?= BaseURL ?>/login/validateGuest">
                        <div class="text-center align-items-center justify-content-center py-2">

                            <input type="submit" name="loginGuest" value="Login as Guest" class="text-muted guest ">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </section>
</body>

</html>