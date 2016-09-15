
(function () {

    $(document).ready(function () {
        initializeTopSellingProducts();
        initializeMonthlySales();

    });

    function initializeTopSellingProducts() {
        var donutData = [
            {label: "Forever Lovely Rose Perfume", data: 30, color: "#3c8dbc"},
            {label: "Forever Lovely Gluthathione with Oil Extract", data: 20, color: "#BA553C"},
            {label: "Oatmeal Soap", data: 50, color: "#62BA3C"},
            {label: "Forever Lovely 5 in 1 Coffee", data: 20, color: "#943CBA"},
            {label: "Forever Lovely Tea Tree Soap", data: 10, color: "#FA4B48"}
        ];

        $.plot("#donut-chart", donutData, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }

                }
            },
            legend: {
                show: false
            }
        });

        for (var i in donutData) {
            var html = '<label style="color:' + donutData[i].color + '">' + donutData[i].label + '</label><br>';
            $('#donut-legend').append(html);
        }

    }

    function initializeMonthlySales() {
        var sin = [];
        for (var i = 0; i < 14; i += 0.5) {
            sin.push([i, Math.sin(i)]);
        }
        var line_data1 = {
            data: sin,
            color: "#3c8dbc"
        };
        $.plot("#line-chart", [line_data1], {
            grid: {
                hoverable: true,
                borderColor: "#f3f3f3",
                borderWidth: 1,
                tickColor: "#f3f3f3"
            },
            series: {
                shadowSize: 0,
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            lines: {
                fill: false,
                color: ["#3c8dbc", "#f56954"]
            },
            yaxis: {
                show: true,
            },
            xaxis: {
                show: true
            }
        });
        //Initialize tooltip on hover
        $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
            position: "absolute",
            display: "none",
            opacity: 0.8
        }).appendTo("body");
        $("#line-chart").bind("plothover", function (event, pos, item) {

            if (item) {
                var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                        .css({top: item.pageY + 5, left: item.pageX + 5})
                        .fadeIn(200);
            } else {
                $("#line-chart-tooltip").hide();
            }

        });
    }

    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #000; font-weight: 600;">'
                + label
                + "<br>"
                + Math.round(series.percent) + "%</div>";
    }

})();