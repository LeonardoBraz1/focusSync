'use strict';
$(document).ready(function() {
    setTimeout(function() {
        floatchart()
    }, 100);
});

function floatchart() {
    // [ support-chart ] start
    $(function() {
        var options1 = {
            chart: {
                type: 'area',
                height: 65,
                sparkline: {
                    enabled: true
                }
            },
            colors: ["#1abc9c"],
            stroke: {
                curve: 'smooth',
                width: 2,
            },
            series: [{
                data: [0, 20, 10, 45, 30, 55, 20, 30, 0]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Ticket '
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        }
        new ApexCharts(document.querySelector("#support-chart"), options1).render();
    });
    // [ support-chart ] end
    // [ power-card-chart1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'line',
                height: 75,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#e74c3c"],
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [55, 35, 75, 50, 90, 50]
            }],
            yaxis: {
                min: 10,
                max: 100,
            },
            tooltip: {
                theme: 'dark',
                fixed: {
                    enabled: false
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Power'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#power-card-chart1"), options);
        chart.render();
    });
    // [ power-card-chart1 ] end
    // [ power-card-chart3 ] start
    $(function() {
        var options = {
            chart: {
                type: 'line',
                height: 75,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#f1c40f"],
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [55, 35, 75, 50, 90, 50]
            }],
            yaxis: {
                min: 10,
                max: 100,
            },
            tooltip: {
                theme: 'dark',
                fixed: {
                    enabled: false
                },
                x: {
                    show: false,
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Temperature'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#power-card-chart3"), options);
        chart.render();
    });
    // [ power-card-chart3 ] end
    // [ seo-chart1 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 40,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#1abc9c"],
            fill: {
                type: 'solid',
                opacity: 0.3,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#1abc9c",
                strokeColor: "#1abc9c",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 9]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Visits :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-chart1"), options);
        chart.render();
    });
    // [ seo-chart1 ] end
    // [ seo-chart2 ] start
    $(function() {
        var options = {
            chart: {
                type: 'bar',
                height: 40,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#2ecc71"],
            plotOptions: {
                bar: {
                    columnWidth: '60%'
                }
            },
            series: [{
                data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63]
            }],
            xaxis: {
                crosshairs: {
                    width: 1
                },
            },
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Bounce Rate :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-chart2"), options);
        chart.render();
    });
    // [ seo-chart2 ] end
    // [ seo-chart3 ] start
    $(function() {
        var options = {
            chart: {
                type: 'area',
                height: 40,
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#e74c3c"],
            fill: {
                type: 'solid',
                opacity: 0,
            },
            markers: {
                size: 2,
                opacity: 0.9,
                colors: "#e74c3c",
                strokeColor: "#e74c3c",
                strokeWidth: 2,
                hover: {
                    size: 4,
                }
            },
            stroke: {
                curve: 'straight',
                width: 3,
            },
            series: [{
                name: 'series1',
                data: [9, 66, 41, 89, 63, 25, 44, 12, 36, 20, 54, 25, 9]
            }],
            tooltip: {
                fixed: {
                    enabled: false
                },
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(seriesName) {
                            return 'Products :'
                        }
                    }
                },
                marker: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#seo-chart3"), options);
        chart.render();
    });
    // [ seo-chart3 ] end
    // [ tot-lead ] start
$(function() {
    var options = {
        chart: {
            type: 'area',
            height: 150,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#1abc9c"],
        fill: {
            type: 'solid',
            opacity: 0.3,
        },
        stroke: {
            curve: 'straight',
            width: 3,
        },
        series: [{
            name: 'series1',
            data: [25, 66, 41, 89, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89]
        }],
        tooltip: {
            fixed: {
                enabled: false
            },
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function(seriesName) {
                        return 'Total Leads :'
                    }
                }
            },
            marker: {
                show: false
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#tot-lead"), options);
    chart.render();
});



var data = {
    labels: ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"],
    datasets: [{
        label: "Serviços",
        fillColor: "rgba(222,184,135, 0.3)",
        strokeColor: "#DEB887",
        pointColor: "#DEB887",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "#DEB887",
        data: [100, 200, 130, 350, 100, 150, 200]
      },
      {
        label: "Despesas",
        fillColor: "rgba(	255, 56, 64,0.3)",
        strokeColor: "rgba(	255, 56, 64)",
        pointColor: "rgba(	255, 56, 64)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(	255, 56, 64)",
        data: [20, 56, 79, 300, 90, 92, 99]
      },
      {
        label: "Vendas",
        fillColor: "rgba(36, 217, 179, 0.3)",
        strokeColor: "#24d9b3",
        pointColor: "#24d9b3",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "#24d9b3",
        data: [80, 90, 90, 250, 150, 60, 70]
      }
    ]
  };

  var options = {
    responsive: true,
    scaleBeginAtZero: true,
    scaleLabel: "<%= value%>",
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleGridLineWidth: 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve: true,
    bezierCurveTension: 0.4,
    pointDot: true,
    pointDotRadius: 4,
    pointDotStrokeWidth: 1,
    pointHitDetectionRadius: 20,
    datasetStroke: true,
    datasetStrokeWidth: 2,
    datasetFill: true,
    tooltipTemplate: "<%= datasetLabel %>: R$ <%= value %>",
    multiTooltipTemplate: "<%= datasetLabel %>: R$ <%= value %>",
    multiTooltipTemplate: "<%= datasetLabel %>: R$ <%= value %>"
  };

  var ctx = document.getElementById("lineChartDemo").getContext("2d");
  var lineChart = new Chart(ctx).Line(data, options);




}


