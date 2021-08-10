@component('layouts.layout')
    <section id="form" style="margin-top: 0px;">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="/register" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="">Username</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text"
                                    placeholder="Name" />
                                @error('name')
                                    <div class="invalid-feedback text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endcomponent
