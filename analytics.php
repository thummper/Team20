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
                <li><a href="main-open.php">Open</a></li>
                <li><a href="main-closed.php">Closed</a></li>
                <li>
                    <h3>Queries</h3>
                </li>
                <li><a href="query.php" class="top-sub">All</a></li>
                <li><a href="#">Open</a></li>
                <li>
                    <h3>More</h3>
                </li>
                <li><a href="#" class="top-sub active">Analytics</a></li>
                <li><a href="login.php">Log out</a></li>

            </ul>
        </div>
        <div class="sidebar-bot">
            <a class="call" href="call.php">New Call</a>
        </div>
    </div>
    <div class="main">
        <div class="title">
            <h1>Analytics</h1>

        </div>
        <div class="content">
            <div class="totalTickets">
                <p>A total of <b>5834</b> tickets have been made this year.</p>
            </div>
            <div class="mainChart">
                <canvas id="chart1"></canvas>
            </div>
            <div class="displayCharts">
                
                <canvas  id="hwswChart" ></canvas>
                <canvas  id="ptypeChart"></canvas>

            </div>
        </div>


    </div>
</body>

</html>
