<!-- Login Page -->
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="bor10 p-lr-40 p-t-40 p-b-40 bg0">
                    <h3 class="mtext-111 cl2 txt-center p-b-30">
                        Sign In
                    </h3>

                    <form action="<?= url('account') ?>" method="GET">
                        <div class="p-b-20">
                            <label class="stext-102 cl3 p-b-5">Email Address *</label>
                            <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="email" name="email" value="customer@example.com" required>
                        </div>

                        <div class="p-b-25">
                            <label class="stext-102 cl3 p-b-5">Password *</label>
                            <input class="stext-104 cl2 plh4 size-116 bor13 p-lr-20 w-full" type="password" name="password" value="password123" required>
                        </div>

                        <div class="flex-w flex-sb-m p-b-25">
                            <div class="flex-w">
                                <input type="checkbox" id="remember_me" name="remember_me" class="m-r-8" checked>
                                <label for="remember_me" class="stext-113 cl6">
                                    Remember me
                                </label>
                            </div>
                            
                            <a href="#" class="stext-113 cl6 hov-cl1 trans-04">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer w-full">
                            Sign In
                        </button>

                        <div class="txt-center p-t-25">
                            <span class="stext-113 cl6">
                                Don't have an account?
                            </span>
                            <a href="<?= url('register') ?>" class="stext-113 cl2 hov-cl1 trans-04 font-weight-bold">
                                Create Account
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
