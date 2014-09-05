
/* global utilities */

(function () {

    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var salesChart;
    var salesChartOptions;

    $(document).ready(function () {
        initializeSalesReport();
        loadSalesReportData();
    });

    function initializeSalesReport() {
        var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        salesChart = new Chart(salesChartCanvas);

        salesChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };
    }


    /**
     * Returns January up to the month before the current month
     * @returns {undefined}
     */
    function getApplicableMonths() {

        var currentDate = new Date();
        var monthIndex = currentDate.getMonth();

        if (monthIndex <= 2) {   //  minimum is march
            return null;
        } else {
            return months.splice(0, monthIndex);
        }

    }

    function loadSalesReportData() {

        var url = "/stores/" + storeId + "/salesSummaryReport";
        $.get(url, function (salesReport) {
            utilities.setBoxLoading($('#report-box'), false);
            setSalesChartData(salesReport.monthlySales);
            console.log(salesReport);

            $('#current-year-sales-label').html("P " + salesReport.currentYearSales);
            $('#current-month-sales-label').html("P " + salesReport.currentMonthSales);
            $('#past-month-sales-label').html("P " + salesReport.pastMonthSales);

        });

        utilities.setBoxLoading($('#report-box'), true);

    }

    function setSalesChartData(reportData) {

        var salesChartData = {
            labels: getApplicableMonths(),
            datasets: [
                {
                    label: "Digital Goods",
                    fillColor: "rgba(60,141,188,0.9)",
                    strokeColor: "rgba(60,141,188,0.8)",
                    pointColor: "#3b8bba",
                    pointStrokeColor: "rgba(60,141,188,1)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(60,141,188,1)",
                    data: reportData
                }
            ]
        };

        salesChart.Line(salesChartData, salesChartOptions);

    }

})();
