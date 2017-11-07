window.onload = function () {

    var ctx = document.getElementById("chart1").getContext("2d");
    var myChart = new Chart(ctx, {
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
