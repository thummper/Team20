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
                    <li><a href="#" class="top-sub">Analytics</a></li>
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
            <canvas id="dChart"></canvas>
            <script>
                window.onload = function() {


                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var dData = JSON.parse(this.responseText);
                            var dataLabels = [];
                            var dataVals = [];
                            for(var i = 0; i < dData.length; i++){
                                console.log(dData[i]);
                                for(var j = 0; j< dData[i].length; j++){
                                    console.log(dData[i][j]);
                                    if(j == 0){
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
                                    
                                    datasets:[{
                                        backgroundColor: ['#51a1ef', '#ef51a1', '#a1ef51'],
                                        data: dataVals
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    }
                                }
                            });



                        }
                    };
                    xhttp.open("GET", "getAnalytics.php?var=all", true);
                    xhttp.send();
                };

            </script>
        </div>
    </div>



</body>

</html>
