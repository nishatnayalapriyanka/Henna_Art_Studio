<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hena Art Studio</title>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="CSS/profile_update.css">
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
                    <a href="/artist_dashboard" class="action"><span class="las la-user-circle"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a class="update"><span class="las la-user-edit"></span>
                    <span>Profile Update</span></a>
                </li>
                <li>
                    <a href="/artist_appointment" class="action"><span class="las la-calendar-alt"></span>
                    <span>Appointment</span></a>
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
                Profile Update
           </h2>

           <div class="user_wrapper">
                <div>
                    <h4>{{session('name')}}</h4>
                    <small>{{session('type')}}</small>
                </div>
           </div>
        </header>

        <main>
            <div class="cards">
                <form method="post" action="/artist_profile_update">
                    @csrf
                    <div class="inputbox">
                        <label class="text-title" for="name">
                        <span class="las la-pen"></span>
                            Name
                        </label>                        
                        <input class="text" type="text" id="name" name="name" value="{{session('name')}}">
                        <div class="error-text">
                            @error('name')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="inputbox">
                        <label class="text-title" for="phone">
                            <span class="las la-pen"></span>
                            Phone Number
                        </label>
                        <input class="text" id="phone" type="text" name="phone" value="{{"0".session('phone')}}">
                        <div class="error-text">
                            @error('phone')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="inputbox">
                        <label class="text-title" for="email">
                            <span class="las la-pen"></span>
                            Email
                        </label>
                        <input class="text" id="email" type="email" name="email" value="{{session('email')}}">
                        <div class="error-text">
                            @error('email')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="inputbox">
                        <label class="text-title" for="password">
                            <span class="las la-pen"></span>   
                            Password
                        </label>
                        <input class="text" id="password" type="password" name="password" value="{{session('password')}}">
                        <div class="error-text">
                            @error('password')
                                {{$message}}
                            @enderror
                        </div>
                        </div>                   
                    <br>
                    <input class="button" type="submit" name="submit" value="Update">
                </form>
                <br><br><br><br>
            </div>
        </main>
    </div>
</body>
</html>
