<!DOCTYPE HTML>

<html>

<head>
    <?php 
            session_start();
            if(empty($_SESSION["staffID"])){
                header("Location: index.php");
            }
        ?>
    <title>Help Desk</title>
    <link rel="shortcut icon" href="media/helpdesk.ico" width='16px' height='16px' />
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>
                <?php echo $_SESSION["jobTitle"]; ?>
            </h2>
            <p>
                <?php echo $_SESSION["staffName"]; ?>
            </p>
        </div>
        <div class="sidebar-mid">
            <ul class="nav">
                <li>
                    <h3>Tickets</h3>
                </li>
                <li><a id="all" href="main.php" class="top-sub">All</a></li>
                <?php
                    if($_SESSION["jobID"] == 1){
                        echo '<li><a id="my" href="main.php?tableType=My">My Tickets</a></li>';
                    }
                    ?>
                    <li><a id="open" href="main.php?tableType=Open">Open</a></li>
                    <li><a id="closed" href="main.php?tableType=Closed">Closed</a></li>
                    <li>
                        <h3>Queries</h3>
                    </li>
                    <li><a href="queries.php" class="top-sub">All</a></li>
                    <li><a href="queries.php?tableType=Open">Open</a></li>
                    <li>
                        <h3>More</h3>
                    </li>
                    <li><a href="analytics.php" class="top-sub active">Analytics</a></li>
                    <?php
                    if($_SESSION["jobID"] == 3){
                        echo '<li><a href="database.php">Databases</a></li>';
                    }
                    ?>
                        <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-bot">
        <a class="call" href="call.php">New Call</a>
    </div>
    <script src="charts.js"></script>
    <div class="main">
        <div class="title">
            <h1>Analytics</h1>
        </div>




        <div class="globalStats">
                    <div class="solveTimes">
                <span>
            Fastest Ticket Solve Time<br>2 Mins
            </span>
                <span>
            Average Ticket Solve Time<br>36 Mins
              </span>
                <span>
            Slowest Ticket Solve Time<br>27 Hours
                    </span>

            </div>
            <div class="ticketshour">
                <h1>Tickets made per hour. </h1>
                <canvas id="tickets/hour"></canvas>
            </div>
    



            <div class="ticketDisplay">
                <canvas id="dChart"></canvas>
            </div>

            <script>
                window.onload = function() {

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var dData = JSON.parse(this.responseText);
                            var dataLabels = [];
                            var dataVals = [];
                            for (var i = 0; i < dData.length; i++) {
                                console.log(dData[i]);
                                for (var j = 0; j < dData[i].length; j++) {
                                    console.log(dData[i][j]);
                                    if (j == 0) {
                                        //Data Labal
                                        dataLabels.push(dData[i][j]);
                                    } else {
                                        dataVals.push(dData[i][j]);
                                    }
                                }
                            }
                            ctx = document.getElementById("dChart").getContext('2d');
                            var dChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: dataLabels,

                                    datasets: [{
                                        backgroundColor: ['#51a1ef', '#94c9fc'],
                                        data: dataVals
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    cutoutPercentage: 42
                                }
                            });



                        }
                    };
                    xhttp.open("GET", "getAnalytics.php?var=openclosed", true);
                    xhttp.send();




                    var xhttp1 = new XMLHttpRequest();
                    xhttp1.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            //Get data
                            var dataArray = JSON.parse(this.responseText);
                            console.log(dataArray);
                            var labels = [];
                            var data = [];
                            //Data should be an array of arrays.
                            for (var i = 0; i < dataArray.length; i++) {
                                for (var j = 0; j < dataArray[i].length; j++) {
                                    if (j == 0) {
                                        //This is label
                                        labels.push(dataArray[i][j]);
                                    } else {
                                        data.push(dataArray[i][j]);
                                    }
                                }
                            }


                            //Make chart
                            var tickethourctx = document.getElementById("tickets/hour").getContext('2d');
                            var myBarChart = new Chart(tickethourctx, {
                                type: 'line',
                                data: {
                                    labels: labels,

                                    datasets: [{
                                        backgroundColor: "#94c9fc",
                                        borderColor: "#51a1ef",
                                        label: "Number of Tickets Made",
                                        data: data
                                    }]

                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        yAxes: [{

                                            ticks: {
                                                min: 0,
                                                stepSize: 1
                                            }
                                        }],
                                        xAxes: [{
                                            gridLines: {
                                                color: "rgba(0, 0, 0, 0)",
                                            },
                                            ticks: {
                                                min: 0
                                            }
                                        }]
                                    }
                                }
                            });

                        }
                    };
                    xhttp1.open("GET", "getHourlyAnalytics.php", true);
                    xhttp1.send();







                };

            </script>
        </div>
    </div>



</body>

</html>
