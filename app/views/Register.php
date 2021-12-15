<section class="vh-100">
    <div class="container-fluid h-custom py-5">
        <div class="row d-flex justify-content-center align-items-center h-100 py-5">
            <!-- <div class="col-md-12 col-lg-6 col-xl-5">
                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png" class="img-fluid" alt="Sample image">
                </div> -->
            <div class="col-md-6 card  py-4 ">
                <div class="row ">
                    <div class="width-text text-center ">
                        <h5 class="pb-4 text-center">Register </h5>
                        <span class="text-danger text-small"><?= (!empty($data['message'])) ?  $data['message'] : ""; ?></span>

                    </div>
                    <form method="POST" class="usercard row" action="<?= BASE_URL ?>/register/registerUser">

                        <div class="col-sm-6">
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="email address" required value="jiya@gmail.com" />

                            </div>
                            <div class="form-outline  mb-4">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" id="username" class="form-control" name="username" required value="jiya" />

                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="phoneNumber">Phone number</label>
                                <input type="tel" id="phoneNumber" class="form-control" name="phoneNumber" required value="9568745869" />

                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password" required />

                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" required />

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-12 mb-4 ">
                                <label for="addressLine1" class="form-label">Address </label>
                                <input type="text" name="addressLine1" id="addressLine1" placeholder="Address" class="form-control" required value="test">

                            </div>
                            <div class="col-sm-12 mb-4">
                                <label for="addressLine2" class="form-label">Landmark </label>
                                <input type="text" name="addressLine2" id="addressLine2" placeholder="Landmark" class="form-control" required value="test">

                            </div>
                            <div class="col-sm-12 mb-4">
                                <div class="row">
                                    <div class="col-sm-6  pr-1">
                                        <label for="city" class="form-label">City </label>
                                        <input type="text" name="city" id="city" placeholder="City" class="form-control" required value="test">
                                    </div>
                                    <div class="col-sm-6 ">
                                        <label for="postalCode" class="form-label">Postal Code </label>
                                        <input type="text" inputmode="numeric" name="postalCode" placeholder="Postal Code" id="postalCode" class="form-control" required value="1254">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-4">

                                <label for="state" class="form-label">State </label>
                                <input type="text" name="state" placeholder="State" id="state" class="form-control" required value="test">

                            </div>
                            <div class="col-sm-12 mb-4">

                                <label for="country" class="form-label">Country </label>
                                <input type="text" name="country" placeholder="Country" id="country" class="form-control" required value="test">

                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 ">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="submit" class="btn  btn-outline-primary  btn-lg btn-block col-sm-10" name="register" value="Register">

                            </div>
                            <div class="col-sm-6"><a href="index.php" class="px-5">Login</a></div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</section>