(function () {

    var barChartOptions;
    var barChartCanvas;
    var barChart;

    var colors = ["#2EAED9", "#AE2ED9", "#D9592E", "59D92E"];

    $(document).ready(function () {
        initializeChart();
        loadChartData();
    });

    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function loadChartData() {

        var labels = ["GGnet", "Lace and Prints", "Printing Madness"];
        var fillColors = [];
        var colorIndex = 0;
        for (var i in labels) {
//            fillColors[i] = getRandomColor();

            fillColors[i] = colors[colorIndex];

            colorIndex++;
            if (colorIndex >= colors.length) {
                colorIndex = 0;
            }
        }

        var chartData = {
            labels: labels,
            datasets: [
                {
                    label: "Digital Goods",
                    fillColor: fillColors,
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: [28, 48, 40]
                }
            ]
        };
        barChart.Bar(chartData, barChartOptions);

    }

    function initializeChart() {
        barChartCanvas = $("#barChart").get(0).getContext("2d");
        barChart = new Chart(barChartCanvas);

        barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
    }

})();