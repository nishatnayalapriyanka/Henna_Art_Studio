<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserModel;
use App\Models\AppointmentModel;

class UserController extends Controller
{
    //print_r($request->input('hidden_otp')); 

    //login
    public function phone_number_login(Request $request){
        $request->validate(
        [
            'phone'=>'required|numeric|digits:11'
        ]
        );

        $otp = rand(1000,9999);
       
        //send sms start
        $to = $request->input('phone');
        $token = "9362190009168130440922097a7112d433081b807595ea7ed8f3";
        $message = "Your login OTP is: " . $otp . "\n@Henna Art Studio";

        $url = "http://api.greenweb.com.bd/api.php?json";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        //send sms close

        Session :: put('login_phone',$request->input('phone'));
        Session :: put('login_otp',$otp);

        return redirect('/otp_login');
    }

    public function otp_login(Request $request){
        $request->validate(
        [
            'otp'=>'required|numeric|digits:4'
        ]
        );

        $phone = Session::get('login_phone');
        $otp = Session::get('login_otp');       

        if($otp == $request->input('otp')){

            Session::forget('login_otp');
            
            $user = UserModel :: where ('phone',$phone)->get();

            if (count($user) === 0) {
                 return redirect('/phone_number_login')->withErrors(['error' => 'Wrong phone number, try again...']);
            }
            else {
                Session :: put('name',$user[0]->name);
                Session :: put('phone',$user[0]->phone);
                Session :: put('email',$user[0]->email);
                Session :: put('password',$user[0]->password);
                Session :: put('type',$user[0]->type);

                Session::forget('login_phone');
                if($user[0]->type=="Henna Artist"){
                    return redirect('/artist_dashboard');
                }
                else if($user[0]->type=="Customer"){
                    return redirect('/customer_dashboard');
                }
            } 
        }
        else{
            return Redirect::back()->withErrors(['error' => 'Wrong OTP, try again...']);
        }
    }

    public function login(Request $request){
        $request->validate(
        [
            'phone'=>'required|numeric|digits:11',
            'password'=>'required'
        ]
        );
        
        $user = UserModel :: where ('phone',$request->input('phone'))->where ('password',$request->input('password'))->get();

        if (count($user) === 0) {
             return Redirect::back()->withErrors(['error' => 'Invalid Log In, please try again...']);
        } else {
            Session :: put('name',$user[0]->name);
            Session::put('phone',$user[0]->phone);
            Session :: put('email',$user[0]->email);
            Session :: put('password',$user[0]->password);
            Session :: put('type',$user[0]->type);

            if($user[0]->type=="Henna Artist"){             
                return redirect('/artist_dashboard');
            }
            else if($user[0]->type=="Customer"){
                return redirect('/customer_dashboard');
            }
        }       
    }

    //registration
    public function verify_phone(Request $request){
        $request->validate(
        [
            'phone'=>'required|numeric|digits:11'
        ]
        );

        $otp = rand(1000,9999);
       
        //send sms start
        $to = $request->input('phone');
        $token = "9362190009168130440922097a7112d433081b807595ea7ed8f3";
        $message = "Your sign-up OTP is: ".$otp."\n@Henna Art Studio";

        $url = "http://api.greenweb.com.bd/api.php?json";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        //send sms close

        Session :: put('reg_phone',$request->input('phone'));
        Session :: put('reg_otp',$otp);

        return redirect('/otp_verify');
    }

    public function otp_verify(Request $request){
        $request->validate(
        [
            'otp'=>'required|numeric|digits:4'
        ]
        );
       
        $otp = Session::get('reg_otp');

        if($otp==$request->input('otp')){
            Session::forget('reg_otp');
            return redirect('/registration');
        }
        else{
            return Redirect::back()->withErrors(['error' => 'Wrong OTP, try again...']);
        }       
    }

    public function registration(Request $request){
        $request->validate(
        [
            'name'=>'required',
            'phone'=>'required|numeric|digits:11',
            'email'=>'required|email',
            'password'=>'required',
            'type'=>'required'
        ]
        );

        $phone = Session::get('reg_phone');

        if($phone == $request->input('phone')){

            Session::forget('reg_phone');

            $user = new  UserModel();
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->type = $request->input('type');
            $user->save();

            //send sms start
            $to = $request->input('phone');
            $token = "9362190009168130440922097a7112d433081b807595ea7ed8f3";
            $message = "Hello, ".$request->input('name').
            "! You have been successfully registered at
            Henna Art Studio\n@Henna Art Studio";


            $url = "http://api.greenweb.com.bd/api.php?json";


            $data= array(
            'to'=>"$to",
            'message'=>"$message",
            'token'=>"$token"
            ); 
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            //send sms close

            return redirect('/login');
        }
        else{
            return Redirect::back()->withErrors(['error' => 'Can not change verified phonr number...']);
        }     
    }

    //artist_dashboard
    public function artist_dashboard(){       
        if (Session::has('phone') && Session::get('type') == "Henna Artist") {
            $currentYear = date('Y');
            $appointments = AppointmentModel::selectRaw('EXTRACT(MONTH FROM date) AS month, COUNT(*) AS row_count')
                ->where('henna_artist_phone', Session::get('phone'))
                ->where('status', 'confirmed')
                ->whereRaW("EXTRACT(YEAR FROM date) = $currentYear")
                ->groupByRaw('EXTRACT(MONTH FROM date)')
                ->orderByRaw('month')
                ->get()
                ->pluck('row_count', 'month')
                ->toArray();

            $todo_appointments = AppointmentModel :: where ('status','confirmed')
            ->where ('henna_artist_phone',Session::get('phone'))
            ->where('date', '>', now())
            ->orderByRaw('date')
            ->get();

            $confirmed_appointments_count = AppointmentModel::where('status','confirmed')
            ->where ('henna_artist_phone',Session::get('phone'))
            ->count();

            $pending_appointments_count = AppointmentModel::where('status','pending')
            ->where ('henna_artist_phone',Session::get('phone'))
            ->where('date', '>', now())
            ->count();

            $todo_appointments_count = AppointmentModel::where('status','confirmed')
            ->where ('henna_artist_phone',Session::get('phone'))
            ->where('date', '>', now())
            ->count();

            return view('artist_dashboard', compact('appointments', 'todo_appointments','confirmed_appointments_count','pending_appointments_count','todo_appointments_count'));
        } else {
           return redirect('/login');
        }
    }

    public function artist_profile_update(Request $request){       
        $request->validate(
        [
            'name'=>'required',
            'phone'=>'required|numeric|digits:11',
            'email'=>'required|email',
            'password'=>'required',
        ]
        );

        $user = UserModel :: where ('phone',Session::get('phone'))->get();       
        $user[0]->name = $request->input('name');
        $user[0]->phone = $request->input('phone');
        $user[0]->email = $request->input('email');
        $user[0]->password = $request->input('password');
        $user[0]->save();

        Session :: put('name',$user[0]->name);
        Session::put('phone',$user[0]->phone);
        Session :: put('email',$user[0]->email);
        Session :: put('password',$user[0]->password);

        return redirect('/artist_profile_update');
    }

    public function artist_appointment(){
        if (Session::has('phone') && Session::get('type') == "Henna Artist") {
            $pending_appointments = AppointmentModel :: where ('status','pending')
            ->where ('henna_artist_phone',Session::get('phone'))
            ->where('date', '>', now())
            ->orderByRaw('date')
            ->get();
            return view('artist_appointment', compact('pending_appointments'));
        } else {
            return redirect('/login');
        }       
    }

    public function artist_appointment_confirm(Request $request){
        $appointment = AppointmentModel :: where ('appointment_id',$request->input('apponitment_id'))
            ->get();
        if ($request->input('submit') === 'Accept') {
            $message = "Congratulations! Your booking on "
            . $appointment[0]->date .
            " is confirmed, please check your dashboard
            \n@Henna Art Studio";
            $appointment[0]->status = "confirmed";
            $appointment[0]->save();
        } elseif ($request->input('submit') === 'Reject') {
            $message = "Sorry! Your booking on "
            .$appointment[0]->date .
           " has been cancelled, you can request again
            \n@Henna Art Studio";
            $appointment[0]->delete();
        }

        //send sms start
        $to = $appointment[0]->customer_phone;
        $token = "9362190009168130440922097a7112d433081b807595ea7ed8f3";

        $url = "http://api.greenweb.com.bd/api.php?json";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        //send sms close
        return redirect('/artist_appointment');
    }

    //customer_dashboard
    public function customer_dashboard(){       
        if (Session::has('phone') && Session::get('type') == "Customer") {
            $todo_appointments = AppointmentModel :: where ('status','confirmed')
            ->where ('customer_phone',Session::get('phone'))
            ->where('date', '>', now())
            ->orderByRaw('date')
            ->get();

            return view('customer_dashboard', compact('todo_appointments'));
        } else {
           return redirect('/login');
        }
    }

    public function customer_profile_update(Request $request){       
        $request->validate(
        [
            'name'=>'required',
            'phone'=>'required|numeric|digits:11',
            'email'=>'required|email',
            'password'=>'required',
        ]
        );

        $user = UserModel :: where ('phone',Session::get('phone'))->get();       
        $user[0]->name = $request->input('name');
        $user[0]->phone = $request->input('phone');
        $user[0]->email = $request->input('email');
        $user[0]->password = $request->input('password');
        $user[0]->save();

        Session :: put('name',$user[0]->name);
        Session::put('phone',$user[0]->phone);
        Session :: put('email',$user[0]->email);
        Session :: put('password',$user[0]->password);

        return redirect('/customer_profile_update');
    }

    public function customer_book_now(){
        if (Session::has('phone') && Session::get('type') == "Customer") {
            $artists = UserModel :: where ('type','Henna Artist')->get();
            return view('customer_book_now', compact('artists'));
        } else {
            return redirect('/login');
        }    
    }

    public function customer_book_now_post(Request $request){
        $appointments = AppointmentModel::where('henna_artist_phone', $request->input('artist_phone'))
            ->get();

        $request->validate([
            'date' => [
                'required',
                function ($attribute, $value, $fail) use ($appointments) {
                    foreach ($appointments as $appointment) {
                        if ($appointment->date == $value) {
                            $fail('The selected date is already booked');
                        }
                    }
                },
            ],
            'packages' => 'required',
        ]);

        if($request->input('packages') == "Mehedi Night"){
            $price = "5000";
        }
        else if($request->input('packages') == "Bridal Package"){
            $price = "3000";
        }
        else if($request->input('packages') == "Semi-Bridal Package"){
            $price = "2000";
        }
        else if($request->input('packages') == "Non-Bridal Package"){
            $price = "1000";
        }

        $appointment = new  AppointmentModel();
        $appointment->customer_phone = "0".Session::get('phone');
        $appointment->henna_artist_phone = $request->input('artist_phone');
        $appointment->date = $request->input('date');
        $appointment->package = $request->input('packages');
        $appointment->price = $price;
        $appointment->status = "pending";
        $appointment->save();

        //send sms start
        $to = $request->input('artist_phone');
        $token = "9362190009168130440922097a7112d433081b807595ea7ed8f3";
        $message = "You have received a booking request for "
        .$request->input('date').
        ", please check your dashboard\n@Henna Art Studio";

        $url = "http://api.greenweb.com.bd/api.php?json";


        $data= array(
        'to'=>"$to",
        'message'=>"$message",
        'token'=>"$token"
        ); 
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        //send sms close

        return redirect('/customer_book_now')->with([
            'message' => 'Your booking request has been sent!',
            'artist' => $request->input('artist_phone'),]);
    }

    //logout
    public function logout(){
        //Auth::logout();
        Session::flush();
        return redirect('/login');
    }

}
