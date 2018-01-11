<!DOCTYPE HTML>
<html>

<head>
    
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/chartcss.css" />
    <script src="charts/Chart.bundle.js"></script>
    <script src="charts/hardcodedCharts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
</head>

<body>
    <div id="sidebar" class="sidebar">
            
        </div>
        <script>
            if(localStorage.usertype == "specialist"){
                $("#sidebar").load("media/input.php #specialist")
            }else{
                $("#sidebar").load("media/input.php #operator")
            }
        </script>
    <div class="main">
        <div class="title">
            <h1>Analytics</h1>

        </div>
        <div class="content">
            
           
            <div class="mainChart">
                <canvas id="chart1"></canvas>


            </div>
            <div class="displayCharts">
                
                <canvas  id="hwswChart" ></canvas>
                <canvas  id="ptypeChart"></canvas>


            </div>
             <div class="ticketResponceTime">
            <div class="minTime">The fastest ticket solve time is: <b> 2 Minutes</b></div>
            <div class="averageTime">The average ticket solve time is: <b>34 Minutes</b></div>
            <div class="maxTime">The slowest ticket solve time is: <b>27 Hours</b></div>
            
            </div>

        </div>


    </div>
</body>

</html>
