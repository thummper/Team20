<!DOCTYPE HTML>
<html>

<head>
    
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/chartcss.css" />
    <script src="charts/Chart.bundle.js"></script>
    <script src="charts/hardcodedCharts.js"></script>
    
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Operator</h2>
            <p>Full Name</p>
        </div>
        <div class="sidebar-mid">
            <ul class="nav">
                <li>
                    <h3>Issues</h3>
                </li>
                <li><a href="main.php" class="top-sub">All</a></li>
                <li><a href="#">Open</a></li>
                <li><a href="#">Closed</a></li>
                <li>
                    <h3>Queries</h3>
                </li>
                <li><a href="#" class="top-sub">All</a></li>
                <li><a href="#">Open</a></li>
                <li>
                    <h3>More</h3>
                </li>
                <li><a href="#" class="top-sub active">Stats</a></li>
                <li><a href="#" class="top-sub">Personal Stats</a></li>
                <li><a href="index.php">Log out</a></li>

            </ul>
        </div>
        <div class="sidebar-bot">
            <a class="call" href="call.php">New Call</a>
        </div>
    </div>
    <div class="main">
        <div class="title">
            <h1>Statistics</h1>

        </div>
        <div class="content">
            <div class="totalTickets">
                A total of <b>5834</b> tickets have been made this year.
            </div>
            <div class="mainChart">
                <canvas width="700" height="300" id="chart1"></canvas>
            </div>
            <div class="displayCharts">
                
                <canvas width="620" height="300" id="hwswChart" ></canvas>
                <canvas width="600" height="300" id="ptypeChart"></canvas>

            </div>
        </div>


    </div>
</body>

</html>
