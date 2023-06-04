<html>
    <head>
        <meta name="viewport" content="width = device-widtth, intal-scale=1.0">
        <title>Hena Art Studio</title>
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
                        <h2>Phone Number Varification</h2>
                        <form method="post" action="/phone_number_verify">
                           @csrf   
                            <div class="inputbox">
                                <input type="text" name="phone" placeholder="Enter Phone Number">
                            </div>
                            <div style="color: red;">
                                @error('phone')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="inputbox">
                                <input type="submit" value="Verify">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
