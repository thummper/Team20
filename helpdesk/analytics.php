<!DOCTYPE HTML>
<!-- 
Analytics.php 

Contains many AJAX requests to various php to get data to draw graphs from. 

Made by: Aron, Jake

-->

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
                    Fastest Ticket Solve Time<br><div id="fastest">0</div>
                </span>
                <span>
                    Average Ticket Solve Time<br><div id="globalAv">0</div>
                </span>
                <span>
            Slowest Ticket Solve Time<br><div id="slowest">0</div>
                </span>
            </div>
            <div class="chartContainer">
                <div class="ticketshour chart">
                    <canvas id="tickets/hour"></canvas>
                </div>
                <div class="chartRow">
                    <div class="ticketDisplay chart">
                        <canvas id="dChart"></canvas>
                    </div>
                    <div class="problemsbyhwsw chart">
                        <canvas id="hwsw"></canvas>
                    </div>
                </div>

                <div class="avDaily chart">
                    <canvas id="avDaily"></canvas>
                </div>
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
                                    title: {
                                        display: true,
                                        text: "Total Open/Closed Tickets"
                                    },
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
                    
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
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
                            var linechart = new Chart(tickethourctx, {
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
                                    title: {
                                        display: true,
                                        text: "Tickets Made Per Hour"
                                    },
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
                    xhttp.open("GET", "getHourlyAnalytics.php", true);
                    xhttp.send();

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            //Get data
                            var dataArray = JSON.parse(this.responseText);
                            console.log(dataArray);
                            var labels = [];
                            var data = [];
                            for (var i = 0; i < dataArray.length; i++) {
                                //Array of arrays.. 
                                for (var j = 0; j < dataArray[i].length; j++) {
                                    if (j == 0) {
                                        //Label
                                        labels.push(dataArray[i][j]);
                                    } else {
                                        //Data
                                        data.push(dataArray[i][j]);
                                    }
                                }
                            }
                            var hwsw = document.getElementById("hwsw").getContext('2d');
                            var barchart = new Chart(hwsw, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        backgroundColor: "#94c9fc",
                                        borderColor: "#51a1ef",
                                        label: "Active Tickets",
                                        data: data
                                    }]

                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Problematic Hardware/Software"
                                    },
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
                    xhttp.open("GET", "tickethwsw.php", true);
                    xhttp.send();

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = JSON.parse(this.responseText);
                            for (var i = 0; i < data.length; i++) {
                                switch (i) {
                                    case 0:
                                        if (data[i] > 59) {
                                            document.getElementById("fastest").innerHTML = (data[i] / 60).toFixed(2) + " Hours";
                                        } else {
                                            document.getElementById("fastest").innerHTML = data[i] + " Mins";
                                        }

                                        break;
                                    case 1:
                                        if (data[i] > 59) {
                                            document.getElementById("globalAv").innerHTML = (data[i] / 60).toFixed(2) + " Hours";
                                        } else {
                                            document.getElementById("globalAv").innerHTML = data[i] + " Mins";
                                        }
                                        break;
                                    case 2:
                                        if (data[i] > 59) {
                                            document.getElementById("slowest").innerHTML = (data[i] / 60).toFixed(2) + " Hours";
                                        } else {
                                            document.getElementById("slowest").innerHTML = data[i] + " Mins";
                                        }
                                        break;
                                }
                            }
                        };
                    }
                    xhttp.open("GET", "getSolveTimes.php?var=all");
                    xhttp.send();
                    
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
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
                            var avDaily = document.getElementById("avDaily").getContext('2d');
                            var linechart = new Chart(avDaily, {
                                type: 'line',
                                data: {
                                    labels: labels,

                                    datasets: [{
                                        backgroundColor: "#94c9fc",
                                        borderColor: "#51a1ef",
                                        label: "Average Ticket Solve Time",
                                        data: data
                                    }]

                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Average Solve Time Per Day"
                                    },
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        yAxes: [{

                                            ticks: {
                                                min: 0,
                                                stepSize: 60
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
                    xhttp.open("GET", "getDaySolveTimes.php", true);
                    xhttp.send();
                };
            </script>
        </div>
    </div>
    </body>
</html>