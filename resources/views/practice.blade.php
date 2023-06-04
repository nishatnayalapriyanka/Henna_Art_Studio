<!DOCTYPE html>
<html>
<head>
    <title>Graph</title>
    <style>
        .chart-container {
            position: relative;
            width: 60%;
            height: 350px;
            box-shadow: 0px 5px 15px yellowgreen;
        }

        .bar-line-container {
            position: absolute;           
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            width: 90%;
            height: 65%;
            left: 6.5%;
            top: 21%;
        }
        .bar-line {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            width: 100%;
            flex-grow: 1;
            border-top: 1.2px solid green;
            
        }

        .bar-y-axis-text {
            color: green;
            font-size: 17px;
            transform: translateY(-140%) translateX(-150%);
        }

        .bar-container {
            position: absolute;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            width: 90%;
            height: 65%;
            left: 6.5%;
            top: 21%;
        }

        .bar {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            flex-grow: 1;
            background-image: linear-gradient(to right, yellowgreen, yellow);
            margin-left: 5px;
            margin-right: 5px;
        }

        .bar-x-axis-text {
            color: green;
            font-size: 17px;
            text-align: center;
            transform: translateY(200%);
        }

        .bar-text{
            position: absolute;         
            color: black;
            font-size: 22px;
            text-align: center;
            font-weight: bold;
            width: 35px;
            height:35px;
            border: 1.2px solid black;
            background-color: yellowgreen; 
            border-radius: 50% 50% 50% 0;
            visibility : hidden;
        }

        .bar:hover .bar-text{
            visibility : visible;           
        }

        .bar-title{
            display: flex;
            justify-content: space-around;
            align-items: center;
            color: green;
            font-size: 26px;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="chart-container">
        <div class="bar-title">
            <p>Orders</p>
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
                if (!array_key_exists($i, $orders)) {
                    $orders[$i] = 0; 
                }
            }
            ksort($orders);
            @endphp
            @foreach($orders as $month_count => $order)
                @php
                    $bar_height = ($order/40) * 100;

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
                    <p class="bar-text" style="bottom:calc({{ $bar_height }}% - 30px)">
                        {{ $order }}
                    </p>
                    <p class="bar-x-axis-text">{{ $month }}</p>
                    
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>

