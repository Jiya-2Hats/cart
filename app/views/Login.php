<section class="vh-100" style="position: fixed;">
    <div class="container-fluid h-custom py-5">
        <div class="row d-flex justify-content-center align-items-center h-100 py-5">

            <div class="col-md-12 py-4 offset-xl-1 usercard">
                <form method="POST" id="login" class="col-sm-12" action="<?= BASE_URL ?>/login/validateUser">

                    <div class="width-text text-center ">
                        <h5 class="pb-4 text-center ">Login </h5>
                        <span class="text-danger text-small"><?= (!empty($data['message'])) ?  $data['message'] : ""; ?></span>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label required" for="email">Email</label>
                        <input type="text" id="email" class="form-control" name="email" placeholder="email address" value="" required />

                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label required" for="password">Password</label>
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
                        <a href="<?= BASE_URL ?>/register" class="">Create new</a>
                    </div>

                    <div class="text-center align-items-center justify-content-center pb-4">
                        <div class="py-2">
                            <p>OR</span>
                        </div>

                    </div>

                </form>
                <form method="POST" action="<?= BASE_URL ?>/login/validateGuest">
                    <div class="text-center align-items-center justify-content-center py-2">

                        <input type="submit" name="loginGuest" value="Login as Guest" class="text-muted guest ">
                    </div>
                </form>

            </div>
        </div>
    </div>

</section>