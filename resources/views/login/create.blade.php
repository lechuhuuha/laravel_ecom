@component('layouts.layout')
    <section id="form" style="margin-top: 0px;">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Login to your account</h2>
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="">Email</label>
                                <input class="form-control" name="email" value="{{ old('email') }}" type="email"
                                    placeholder="Email Address" />
                                @error('email')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="">Password</label>
                                <input class="form-control" name="password" type="password" placeholder="Password" />
                                @error('password')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                        <a href="/register"> or register an account</a>

                    </div>
                    <!--/login form-->
                </div>

            </div>
        </div>
    </section>
    <!--/form-->
@endcomponent
