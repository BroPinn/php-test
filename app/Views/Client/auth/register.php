<!-- Register Page -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="bor10 p-lr-40 p-t-40 p-b-40 bg0">
                    <h3 class="mtext-111 cl2 txt-center p-b-30">
                        Create Account
                    </h3>

                    <form action="<?= url('account') ?>" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-b-20">
                                    <label class="stext-102 cl3 p-b-5">First Name *</label>
                                    <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="text" name="firstName" placeholder="John" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-b-20">
                                    <label class="stext-102 cl3 p-b-5">Last Name *</label>
                                    <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="text" name="lastName" placeholder="Doe" required>
                                </div>
                            </div>
                        </div>

                        <div class="p-b-20">
                            <label class="stext-102 cl3 p-b-5">Email Address *</label>
                            <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="email" name="email" placeholder="john.doe@example.com" required>
                        </div>

                        <div class="p-b-20">
                            <label class="stext-102 cl3 p-b-5">Phone Number</label>
                            <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="tel" name="phone" placeholder="+1 (555) 000-0000">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-b-20">
                                    <label class="stext-102 cl3 p-b-5">Password *</label>
                                    <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-b-20">
                                    <label class="stext-102 cl3 p-b-5">Confirm Password *</label>
                                    <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="password" name="confirm_password" required>
                                </div>
                            </div>
                        </div>

                        <div class="p-b-25">
                            <div class="flex-w">
                                <input type="checkbox" id="terms" name="terms" class="m-r-8" required checked>
                                <label for="terms" class="stext-113 cl6">
                                    I agree to the <a href="<?= url('about') ?>" class="cl2 hov-cl1 font-weight-bold">Terms & Conditions</a> and <a href="<?= url('about') ?>" class="cl2 hov-cl1 font-weight-bold">Privacy Policy</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer w-full">
                            Create Account
                        </button>

                        <div class="txt-center p-t-25">
                            <span class="stext-113 cl6">
                                Already have an account?
                            </span>
                            <a href="<?= url('login') ?>" class="stext-113 cl2 hov-cl1 trans-04 font-weight-bold">
                                Sign In
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
