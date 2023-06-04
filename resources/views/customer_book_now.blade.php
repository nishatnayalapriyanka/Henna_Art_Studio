<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hena Art Studio</title>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="CSS/customer_book_now.css">
</head>

<body>
    <input type="checkbox" id="nav_toggle">
    <div class="sidebar">
        <div class="sidebar_brand">
            <h2><span class="lab la-pagelines"></span> <span>HennaStudio</span></h2>
        </div>

        <div class="sidebar_menu">
            <ul>
                <li>
                    <a href="/customer_dashboard" class="action"><span class="las la-user-circle"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/customer_profile_update" class="action"><span class="las la-user-edit"></span>
                    <span>Profile Update</span></a>
                </li>
                <li>
                    <a class="book_now"><span class="las la-calendar-day"></span>
                    <span>Book Now</span></a>
                </li>
                <li>
                    <a href="/logout" class="action1"><span class="las la-sign-out-alt"></span>
                    <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main_content">
        <header>
           <h2>
                <label for="nav_toggle">
                    <span class="las la-bars"></span>
                </label>
                Book Now
           </h2>

           <div class="user_wrapper">
                <div>
                    <h4>{{session('name')}}</h4>
                    <small>{{session('type')}}</small>
                </div>
           </div>
        </header>

        <main>
            @foreach($artists as $artist)
                <div class="artist">
                    <p>{{$artist->name}}</p>                                       
				 	<p>
                        <a style="color:green" href="tel:{{"0".$artist->phone}}">
						    <span class="las la-phone"></span>
					    </a>{{"0".$artist->phone}}</p>
                    <form method="post" action="/customer_book_now">
                        @csrf
                        <input type="hidden" name="artist_phone" value="{{"0".$artist->phone}}">
                        <input type="date" name="date" min="{{date('Y-m-d')}}">
                        <div style="color: red;">
                            @if ($errors->has('date') && old('artist_phone') === "0".$artist->phone)
                                {{$errors->first('date')}}
                            @endif
                        </div>
                        <div>
                            <input type="radio" name="packages" value="Mehedi Night"> Mehedi Night(5000Tk)
                        </div>
                        <div>
                            <input type="radio" name="packages" value="Bridal Package"> Bridal Package(3000Tk)
                        </div>
                        <div>
                            <input type="radio" name="packages" value="Semi-Bridal Package"> Semi-Bridal Package(2000Tk)
                        </div>
                        <div>
                             <input type="radio" name="packages" value="Non-Bridal Package"> Non-Bridal Package(1000Tk)
                        </div>
                        <div style="color: red;">
                            @if ($errors->has('packages') && old('artist_phone') === "0".$artist->phone)
                                {{$errors->first('packages')}}
                            @endif
                        </div>
                        @if(session('message') &&
                        session('artist')  === "0".$artist->phone)
                            <div class="msg">
                                {{ session('message') }}
                            </div>
                        @endif
                        <input class="button" type="submit" name="submit" value="Book Now">
                    </form>
                </div>
             @endforeach
        </main>
    </div>
</body>
</html>
