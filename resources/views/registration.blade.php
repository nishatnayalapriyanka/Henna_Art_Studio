<html>
    <head>
        <meta name="viewport" content="width = device-widtth, intal-scale=1.0">
        <title>Registration</title>
        <link rel="stylesheet" href="CSS/registration.css">
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
                        <h2>Sign Up Form</h2>
                        <form method="post" action="/registration">
                            @csrf
                            <div class="inputbox">
                                <input type="text" name="name" placeholder="Enter Name" value="{{old('name')}}">
                                <div style="color: red;">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </div> 
                            </div>
                            <div class="inputbox">
                                <input id="phone" type="phone" name="phone" placeholder="Enter Phone Number" value="{{session('reg_phone')}}">
                                <div style="color: red;">
                                    @error('phone')
                                        {{$message}}
                                    @enderror
                                </div> 
                            </div>
                            <div class="inputbox">
                                <input type="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
                                <div style="color: red;">
                                    @error('email')
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
                            <div style="padding-top:20px; font-size: large; font-weight: 600; color: #116400;">
                                <input type="radio" name="type" value="Customer"> Customer
                                <input type="radio" name="type" value="Henna Artist"> Henna Artist                      
                            </div>
                            <div style="color: red;">
                                    @error('user_type')
                                        {{$message}}
                                    @enderror
                            </div>
                            @if ($errors->has('error'))
                                <div class="alert alert-danger" style="color: red;">
                                    <p>{{ $errors->first('error') }}</p>
                                </div>
                            @endif
                            <div class="inputbox">
                                <input type="submit" name="submit" value="Sign Up" style="color: #116400;">
                            </div>
                            <div>
                                <p class="login">Have An Account ?? <a href="/login" style="color: #116400;">Log In</a></p>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
