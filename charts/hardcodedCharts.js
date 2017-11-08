window.onload = function () {

    var ctx = document.getElementById("chart1").getContext("2d");
    var chart1 = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["9am", "10am", "11am", "12pm", "1pm", "2pm", "3pm", "4pm", "5pm"],
            datasets: [{
                label: 'Tickets Made',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                data: [15, 10, 7, 2, 4, 8, 9, 7, 3],
                borderWidth: 1
        }]
        },
        options: {
            responsive: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
            }]
            }
        }
    });





    var ctx2 = document.getElementById("hwswChart");
    var chart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["Free Wordprocessor 5000", "Cheap Mouse 72", "INKWARE Printer X", "RealVIEW Monitor"],
            datasets: [{
                label: "Problems by Hard/Software",
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                data: [15, 10, 7, 3],
                borderWidth: 1


        }]
        },
        options: {
            responsive: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }

        }

    });

    var ctx3 = document.getElementById("ptypeChart").getContext("2d");
    var chart3 = new Chart(ctx3, {
        type: "bar",
        data: {
            labels: ["Printer", "Hardware Malfunction", "Software Crash", "Data Loss"],
            datasets: [{
                label: "Problem by type",
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                data: [20, 8, 6, 5],
                borderWidth: 1


        }]
        },
        options: {
            responsive: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }

        }
        

    });

}
