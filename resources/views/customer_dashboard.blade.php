<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hena Art Studio</title>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>

<body>
    <input type="checkbox" id="nav_toggle">
    <div class="sidebar">
        <div class="sidebar_brand">
            <h2><span class="lab la-pagelines"></span> <span>Hena Art Studio</span></h2>
        </div>

        <div class="sidebar_menu">
            <ul>
                <li>
                    <a class="dashboard"><span class="las la-user-circle"></span>
                    <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/customer_profile_update" class="action"><span class="las la-user-edit"></span>
                    <span>Profile Update</span></a>
                </li>
                <li>
                    <a href="/customer_book_now" class="action"><span class="las la-calendar-day"></span>
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

                Dashboard
           </h2>

           <div class="user_wrapper">
                <div>
                    <h4>{{session('name')}}</h4>
                    <small>{{session('type')}}</small>
                </div>
           </div>
        </header>

        <main>
            <h1 class="title">Upcoming Appointment</h1>
            <table>
              
                <tr>
                    <th>Appointment ID</th>
                    <th>Henna Artist Phone</th>
                    <th>Date</th>
                    <th>Package</th>
                    <th>Price</th>
                </tr>
              
              @foreach($todo_appointments as $todo_appointment)
                <tr>
                    <td>{{$todo_appointment->appointment_id}}</td>
                    <td>{{$todo_appointment->henna_artist_phone}}</td>
                    <td>{{$todo_appointment->date}}</td>
                    <td>{{$todo_appointment->package}}</td>
                    <td>{{$todo_appointment->price}} TK</td>
                </tr>
              @endforeach
            </table>
            
            <br><br>

            <h1 class="title" >Personal Infomation </h1>
            <p class="text">
                <span class="text-title">Name : </span>{{session('name')}}
                <br>
                <span class="text-title">Phone : </span>{{"0".session('phone')}}
                <br>
                <span class="text-title">Email : </span>{{session('email')}}
            </p>
        </main>
    </div>
</body>
</html>
