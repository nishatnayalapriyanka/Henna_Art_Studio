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
                    <a href="/artist_profile_update" class="action"><span class="las la-user-edit"></span>
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
            <div class="cards">
                <div class="card_single">
                    <div>
                        <h1>{{$confirmed_appointments_count}}</h1>
                        <span>Confirmed Appointments</span>
                    </div>
                    <div>
                        <span class="las la-calendar-check"></span>
                    </div>
                </div>

                <div class="card_single">
                    <div>
                        <h1>{{$pending_appointments_count}}</h1>
                        <span>Pending Appointments</span>
                    </div>
                    <div>
                        <span class="las la-calendar-alt"></span>
                    </div>
                </div>

                <div class="card_single">
                    <div>
                        <h1>{{$todo_appointments_count}}</h1>
                        <span>Upcoming Appointments</span>
                    </div>
                    <div>
                        <span class="las la-calendar-alt"></span>
                    </div>
                </div>

            </div>
            <br><br>
            <div class="chart-container">
                <div class="bar-title">                  
                    <p><i class="lar la-chart-bar"></i>
                    Appointment {{date('Y')}}</p>
                </div>
        
                <div class="bar-line-container">
                    <div class="bar-line">
                        <p class="bar-y-axis-text">40</p>
                    </div>
                    <div class="bar-line">
                        <p class="bar-y-axis-text">30</p>
                    </div>
                    <div class="bar-line">
                        <p class="bar-y-axis-text">20</p>
                    </div>
                    <div class="bar-line" style="border-bottom: 1px solid gray">
                        <p class="bar-y-axis-text">10</p>
                    </div>
                </div>

                <div class="bar-container">
                    @php
                        for($i = 1; $i <= 12; $i++){
                            if (!array_key_exists($i, $appointments)) {
                                $appointments[$i] = 0; 
                            }
                        }
                        ksort($appointments);
                    @endphp
                    @foreach($appointments as $month_count => $appointment)
                        @php
                            $bar_height = ($appointment/40) * 100;

                            if($month_count==1){
                                $month = "Jan";
                            }
                            elseif($month_count==2){
                                $month = "Feb";
                            }
                            elseif($month_count==3){
                                $month = "Mar";
                            }
                            elseif($month_count==4){
                                $month = "Apr";
                            }
                            elseif($month_count==5){
                                $month = "May";
                            }
                            elseif($month_count==6){
                                $month = "Jun";
                            }
                            elseif($month_count==7){
                                $month = "Jul";
                            }
                            elseif($month_count==8){
                                $month = "Aug";
                            }
                            elseif($month_count==9){
                                $month = "Sep";
                            }
                            elseif($month_count==10){
                                $month = "Oct";
                            }
                            elseif($month_count==11){
                                $month = "Nov";
                            }
                            elseif($month_count==12){
                                $month = "Dec";
                            }
                        @endphp

                        <div class="bar" style="height: {{ $bar_height }}%">
                            <p class="bar-text" style="bottom:calc({{ $bar_height }}%)">
                                {{ $appointment }}
                            </p>
                            <p class="bar-x-axis-text">{{ $month }}</p>
                    
                        </div>
                    @endforeach
                </div>
            </div>
            <br><br>

            <h1  class="title">Upcoming Appointment</h1>
            <table>            
                <tr>
                    <th>Appointment ID</th>
                    <th>Customer Phone</th>
                    <th>Date</th>
                    <th>Package</th>
                    <th>Price</th>
                </tr>              
              @foreach($todo_appointments as $todo_appointment)
                <tr>
                    <td>{{$todo_appointment->appointment_id}}</td>
                    <td>{{$todo_appointment->customer_phone}}</td>
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
