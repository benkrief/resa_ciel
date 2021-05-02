// Apex Charts

window.Apex = {
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 2
    },
};

// Sparklines

var randomizeArray = function (arg) {
    var array = arg.slice();
    var currentIndex = array.length,
        temporaryValue, randomIndex;

    while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
};

//1er truc
var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];
var nbActiveUser = null;

//graphique nb d'utilisateurs actifs par mois qui se sont inscrit à un événement
$.ajax({
    type: "GET",
    async: false,
    url: "admin/subCount",
    success: function (retour) {
        let tab= [];
        for(let i=1; i<=12 ; i++){
            tab.push(retour[0][i]);
        }
        nbActiveUser = tab;
    },
    error: function (ajaxContext) {

    }
});

// Dashboard Charts

var dashSpark1 = {
    chart: {
        type: 'area',
        height: 152,
        sparkline: {
            enabled: true
        },
    },
    colors: ["#3f6ad8"],
    stroke: {
        width: 5,
        curve: 'smooth',
    },

    markers: {
        size: 0
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
                formatter: function () {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
        },
    },
    series: [{
        data: sparklineData
    }],
    yaxis: {
        min: 0
    },
};
var dashSpark2 = {
    chart: {
        type: 'area',
        height: 152,
        sparkline: {
            enabled: true
        },
    },
    stroke: {
        width: 5,
        curve: 'smooth'
    },
    colors: ['#f7b924'],
    markers: {
        size: 0
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
                formatter: function (seriesName) {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
        }
    },
    series: [{
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
};
var dashSpark3 = {
    chart: {
        type: 'area',
        height: 152,
        sparkline: {
            enabled: true
        },
    },
    colors: ['#3ac47d'],
    stroke: {
        width: 5,
        curve: 'smooth'
    },

    markers: {
        size: 0
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
                formatter: function (seriesName) {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
        }
    },
    series: [{
        data: nbActiveUser
    }],
    yaxis: {
        min: 0
    },
};

var dashSparkLines1 = {
    chart: {
        type: 'line',
        height: 100,
        sparkline: {
            enabled: true
        },
    },
    colors: ["#3ac47d"],
    stroke: {
        width: 3,
        curve: 'smooth',
    },

    markers: {
        size: 0
    },
    tooltip: {
        fixed: {
            enabled: true
        },
        x: {
            show: false
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    series: [{
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
};
var dashSparkLines2 = {
    chart: {
        type: 'line',
        height: 100,
        sparkline: {
            enabled: true
        },
    },
    stroke: {
        width: 3,
        curve: 'smooth'
    },
    colors: ['#007bff'],
    markers: {
        size: 0
    },
    tooltip: {
        fixed: {
            enabled: true
        },
        x: {
            show: false
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    series: [{
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
};
var dashSparkLines3 = {
    chart: {
        type: 'line',
        height: 100,
        sparkline: {
            enabled: true
        },
    },
    colors: ['#f7b924'],
    stroke: {
        width: 3,
        curve: 'smooth'
    },

    markers: {
        size: 0
    },
    tooltip: {
        fixed: {
            enabled: true
        },
        x: {
            show: false
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    series: [{
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
};
var dashSparkLines4 = {
    chart: {
        type: 'line',
        height: 100,
        sparkline: {
            enabled: true
        },
    },
    colors: ['#d92550'],
    stroke: {
        width: 3,
        curve: 'smooth'
    },

    markers: {
        size: 0
    },
    tooltip: {
        fixed: {
            enabled: true
        },
        x: {
            show: false
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return '';
                }
            }
        },
        marker: {
            show: false
        }
    },
    series: [{
        data: randomizeArray(sparklineData)
    }],
    yaxis: {
        min: 0
    },
};

// Apex Charts Init

$( document ).ready(function() {

    setTimeout(function () {

        if (document.getElementById('chart-apex-area')) {
            chart.render();
        }
        if (document.getElementById('chart-apex-negative')) {
            chart2.render();
        }
        if (document.getElementById('chart-apex-column')) {
            chart3.render();
        }
        if (document.getElementById('chart-apex-stacked')) {
            chart4.render();
        }
        if (document.getElementById('chart-col-1')) {
            col3Chart1.render();
        }
        if (document.getElementById('chart-col-2')) {
            col3Chart2.render();
        }
        if (document.getElementById('chart-col-3')) {
            col3Chart3.render();
        }

        if (document.getElementById('sparkline-chart1')) {
            new ApexCharts(document.querySelector("#sparkline-chart1"), options1).render();
        }
        if (document.getElementById('sparkline-chart2')) {
            new ApexCharts(document.querySelector("#sparkline-chart2"), options22).render();
        }
        if (document.getElementById('sparkline-chart3')) {
            new ApexCharts(document.querySelector("#sparkline-chart3"), options33).render();
        }
        if (document.getElementById('sparkline-chart4')) {
            new ApexCharts(document.querySelector("#sparkline-chart4"), options44).render();
        }
        if (document.getElementById('sparkline-chart5')) {
            new ApexCharts(document.querySelector("#sparkline-chart5"), options5).render();
        }
        if (document.getElementById('sparkline-chart6')) {
            new ApexCharts(document.querySelector("#sparkline-chart6"), options6).render();
        }
        if (document.getElementById('sparkline-chart7')) {
            new ApexCharts(document.querySelector("#sparkline-chart7"), options7).render();
        }
        if (document.getElementById('sparkline-chart8')) {
            new ApexCharts(document.querySelector("#sparkline-chart8"), options8).render();
        }
        if (document.getElementById('sparkline-chart9')) {
            new ApexCharts(document.querySelector("#sparkline-chart9"), options9).render();
        }

        // Dashboard Charts

        if (document.getElementById('dashboard-sparkline-1')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-1"), dashSpark1).render();
        }

        if (document.getElementById('dashboard-sparkline-4')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-4"), dashSpark4).render();
        }

        if (document.getElementById('dashboard-sparkline-2')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-2"), dashSpark2).render();
        }

        if (document.getElementById('dashboard-sparkline-3')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-3"), dashSpark3).render();
        }

        if (document.getElementById('dashboard-sparklines-1')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-1"), dashSparkLines1).render();
        }

        if (document.getElementById('dashboard-sparklines-2')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-2"), dashSparkLines2).render();
        }

        if (document.getElementById('dashboard-sparklines-3')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-3"), dashSparkLines3).render();
        }

        if (document.getElementById('dashboard-sparklines-4')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-4"), dashSparkLines4).render();
        }

        if (document.getElementById('dashboard-sparklines-primary')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-primary"), sparklinesBigPrimary).render();
        }

        if (document.getElementById('dashboard-sparklines-simple-1')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-simple-1"), dashSparkLinesSimple1).render();
        }

        if (document.getElementById('dashboard-sparklines-simple-2')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-simple-2"), dashSparkLinesSimple2).render();
        }

        if (document.getElementById('dashboard-sparklines-simple-3')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-simple-3"), dashSparkLinesSimple3).render();
        }

        if (document.getElementById('dashboard-sparklines-transparent-2')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-transparent-2"), dashSparkLinesTrans2).render();
        }

        if (document.getElementById('dashboard-sparklines-transparent-3')) {
            new ApexCharts(document.querySelector("#dashboard-sparklines-transparent-3"), dashSparkLinesTrans3).render();
        }

        if (document.getElementById('dashboard-sparkline-carousel-1')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-carousel-1"), dashSparkLinesSimple1).render();
        }

        if (document.getElementById('dashboard-sparkline-carousel-2')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-carousel-2"), dashSparkLinesSimple2).render();
        }

        if (document.getElementById('dashboard-sparkline-carousel-3')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-carousel-3"), dashSparkLinesSimple3).render();
        }

        if (document.getElementById('dashboard-sparkline-11')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-11"), options7).render();
        }

        if (document.getElementById('dashboard-sparkline-22')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-22"), options8).render();
        }

        if (document.getElementById('dashboard-sparkline-33')) {
            new ApexCharts(document.querySelector("#dashboard-sparkline-33"), options9).render();
        }

        if (document.getElementById('chart-apex-stacked-commerce')) {
            chartCommerce.render();
        }

        if (document.getElementById('chart-radial')) {
            chart444.render();
        }

        if (document.getElementById('chart-combined')) {
            chart777.render();
        }

        if (document.getElementById('bar-vertical-candle')) {
            chartBar.render();
        }

        if (document.getElementById('bar-vertical-candle-lg')) {
            chartBarLg.render();
        }

    }, 1000);

    $('.minimal-tab-btn-1').one('click', function () {

        setTimeout(function () {
            new ApexCharts(document.querySelector("#chart-combined-tab"), options777).render();
        }, 500);

    });

    $('.dd-chart-btn').one('click', function () {

        setTimeout(function () {
            if (document.getElementById('dashboard-sparkline-carousel-3-pop')) {
                new ApexCharts(document.querySelector("#dashboard-sparkline-carousel-3-pop"), dashSparkLinesSimple3).render();
            }
        }, 500);

    });

    $('.dd-chart-btn-2').one('click', function () {

        setTimeout(function () {
            if (document.getElementById('dashboard-sparkline-carousel-4-pop')) {
                new ApexCharts(document.querySelector("#dashboard-sparkline-carousel-4-pop"), dashSparkLinesSimple2).render();
            }
        }, 500);

    });

    $('.minimal-tab-btn-3').one('click', function () {
        setTimeout(function () {
            new ApexCharts(document.querySelector("#chart-combined-tab-3"), optionsCommerce).render();
        }, 500);
    });

    $('.second-tab-toggle').one('click', function () {
        setTimeout(function () {
            new ApexCharts(document.querySelector("#dashboard-sparklines-333"), dashSparkLines4).render();
        }, 500);
    });

    $('.second-tab-toggle-alt').one('click', function () {
        setTimeout(function () {
            new ApexCharts(document.querySelector("#dashboard-sparkline-37"), dashSpark33).render();
        }, 500);
    });

});