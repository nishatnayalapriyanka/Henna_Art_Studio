<html>
    <head>
        <meta name="viewport" content="width = device-widtth, intal-scale=1.0">
        <title>Hena Art Studio</title>
        <link rel="stylesheet" href="CSS/login.css">
    </head>

    <body>
        <section>
            <div class="color"></div>
            <div class="color"></div>
            <div class="color"></div>
            <div class="box">
                <div class="square" style="--i:0;"></div>
                <div class="square" style="--i:1;"></div>
                <div class="square" style="--i:2;"></div>
                <div class="square" style="--i:3;"></div>
                <div class="square" style="--i:4;"></div>


                <div class="container">
                    <div class="form">
                        <h2>Login Form</h2>
                        <form method="post" action="/login">
                            @csrf
                            <div class="inputbox">
                                <input type="text" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
                                <div style="color: red;">
                                    @error('phone')
                                        {{$message}}
                                    @enderror
                                </div>                                    
                            </div>
                            <div class="inputbox">
                                <input type="password" name="password" placeholder="Password">
                                <div style="color: red;">
                                    @error('password')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                            @if ($errors->has('error'))
                                <div class="alert alert-danger" style="color: red;">
                                    <p>{{ $errors->first('error') }}</p>
                                </div>
                            @endif
                            <div class="inputbox">
                                <input type="submit" name="submit" value="Login" style="color: #116400;">
                            </div>
                            <div>
                                <p class="forget">Forget Password ?? <a href="phone_number_login" style="color: #116400;">Click Here</a></p>
                                <p class="forget">Don't Have An Account ?? <a href="/phone_number_verify" style="color: #116400;">Sign Up</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
