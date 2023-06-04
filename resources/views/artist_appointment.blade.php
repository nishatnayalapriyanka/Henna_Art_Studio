<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hena Art Studio</title>

    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="CSS/artist_appointment.css">
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
                    <a href="/artist_profile_update" class="action"><span class="las la-user-edit"></span>
                    <span>Profile Update</span></a>
                </li>
                <li>
                    <a class="appointment"><span class="las la-calendar-alt"></span>
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
                Appointment
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
                <div class="card_single" style="overflow-x:auto;">
                    <h3 class="appointment_list">Appointment List</h3>
                    <table>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Customer Phone</th>
                            <th>Date</th>
                            <th>Package</th>
                            <th>Price</th>
                            <th>Confirmation</th>
                        </tr>
                        @foreach($pending_appointments as $pending_appointment)
                        <tr>
                          <td>{{$pending_appointment->appointment_id}}</td>
                          <td>{{$pending_appointment->customer_phone}}</td>
                          <td>{{$pending_appointment->date}}</td>
                          <td>{{$pending_appointment->package}}</td>
                          <td>{{$pending_appointment->price}} TK</td>
                          <td>
                            <form method="post" action="/artist_appointment">
                            @csrf
                                <input type="hidden" name="apponitment_id" value="{{$pending_appointment->appointment_id}}">
                                <input class="button" type="submit" name="submit" value="Accept">
                                <input class="button color" type="submit" name="submit" value="Reject">
                            </form>
                          </td>
                        </tr>
                        @endforeach                     
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
