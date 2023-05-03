<div class="modal fade signin" id="signupModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <!-- <button type="button" class="close" data-dismiss="modal"><i class="icon ion-md-close"></i></button> -->
                <ul class="nav nav-pills signin w-100 text-center" role="tablist">
                    <li class="nav-item w-50">
                        <a class="nav-link active" data-toggle="pill" href="#home">Log In <span><i class="fa fa-sign-in"
                                                                                                   aria-hidden="true"></i></span></a>
                    </li>
                    <li class="nav-item w-50">
                        <a class="nav-link" data-toggle="pill" href="#menu1">Sign Up <span><i
                                        class="icon ion-md-person"></i></span></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content pt-3">
                    <div id="home" class="container tab-pane active">
                        <form id="loginForm" method="POST" style="display: contents;">
                            <div class=" row">
                                @csrf
                                <div class="col-md-6 formsign">
                                    <div class="form-group">
                                        <label>Enter your Email</label>
                                        <input id="emailL" class="form-control" value="" name="email" required
                                               type="email" placeholder="Email">
                                        <span class="icon-input"><i class="icon ion-md-mail"></i></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter your Password</label>
                                        <input id="passwordL" class="form-control" value="" name="password" required
                                               type="password" placeholder="Password">
                                        <span class="icon-input"><i class="icon ion-md-unlock"></i></span>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h2 class="heading-social-media py-2">Login with Social Media</h2>
                                    <div class="form-group">
                                        <a href="{{route('social.facebook')}}" class="btn btn-socila fb"><i
                                                    class="icon ion-logo-facebook"></i> Login with facebook
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{route('social.google')}}" class="btn btn-socila gmail"><i
                                                    class="fa fa-google-plus" aria-hidden="true"></i> Login with Gmail
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="successLogin" class="alert alert-success d-none loginmessages">
                                    </div>
                                    <div id="errorLogin" class="alert alert-danger d-none loginmessages">
                                    </div>
                                    <button type="submit" class="btn btn-signin">Sign In</button>
                                </div>

                                <div class="col-sm-6">
                                    <a id="forgotM" class="forgetpass">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="menu1" class="container tab-pane fade">
                        <form method="POST" class="formsign" id="registerForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Display Name</label>
                                        <input class="form-control" value="" name="name" required type="text" id="nameS"
                                               placeholder="Your name">
                                        <span class="icon-input"><i class="icon ion-md-person"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Enter your Email</label>
                                        <input value="" class="form-control" name="email" required type="email"
                                               id="emailS"
                                               placeholder="Email">
                                        <span class="icon-input"><i class="icon ion-md-mail"></i></span>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Enter your Password</label>
                                        <input value="" class="form-control" name="password" type="password"
                                               id="passwordS" placeholder="Password" required>
                                        <span class="icon-input"><i class="icon ion-md-unlock"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                        <span class="icon-input"><i class="icon ion-md-unlock"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="successSignup" class="alert alert-success d-none signupmessages">
                                    </div>
                                    <div id="errorSignup" class="alert alert-danger d-none signupmessages">
                                    </div>
                                    <button type="submit" class="btn btn-signin">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="forgetModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="header-pass-reset">
                    <h3 class="text-center m-0">Forget password</h3>
                </div>
                <div id="successForgot" class="alert alert-success d-none resetmessages"></div>
                <div id="errorForgot" class="alert alert-danger d-none resetmessages"></div>
                <div class="main-body-pass">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <label class="forget-pass">Enter your email and we will send you instructions on how to
                                reset
                                your password</label>
                            <div class="input-group forget-pass">
                                <span class="icon-forgwt-pass"><i class="icon ion-md-mail"></i></span>
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-reset-pass">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>