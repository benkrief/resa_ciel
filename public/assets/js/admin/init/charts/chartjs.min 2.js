var randomScalingFactor=function(){return Math.round(100*Math.random())},MONTHS=["January","February","March","April","May","June","July","August","September","October","November","December"],color=Chart.helpers.color,barChartData={labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset 1",backgroundColor:color(window.chartColors.red).alpha(.5).rgbString(),borderColor:window.chartColors.red,borderWidth:1,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]},{label:"Dataset 2",backgroundColor:color(window.chartColors.blue).alpha(.5).rgbString(),borderColor:window.chartColors.blue,borderWidth:1,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]}]},configPie={type:"pie",data:{datasets:[{data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()],backgroundColor:[window.chartColors.red,window.chartColors.orange,window.chartColors.yellow,window.chartColors.green,window.chartColors.blue],label:"Dataset 1"}],labels:["Red","Orange","Yellow","Green","Blue"]},options:{responsive:!0}},barChartData={labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset 1",backgroundColor:window.chartColors.red,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]},{label:"Dataset 2",backgroundColor:window.chartColors.blue,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]},{label:"Dataset 3",backgroundColor:window.chartColors.green,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]}]},configRadar={type:"radar",data:{labels:[["Eating","Dinner"],["Drinking","Water"],"Sleeping",["Designing","Graphics"],"Coding","Cycling","Running"],datasets:[{label:"My First dataset",backgroundColor:color(window.chartColors.red).alpha(.2).rgbString(),borderColor:window.chartColors.red,pointBackgroundColor:window.chartColors.red,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]},{label:"My Second dataset",backgroundColor:color(window.chartColors.blue).alpha(.2).rgbString(),borderColor:window.chartColors.blue,pointBackgroundColor:window.chartColors.blue,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]}]},options:{legend:{position:"top"},title:{display:!1,text:"Chart.js Radar Chart"},scale:{ticks:{beginAtZero:!0}}}},configDoughnut={type:"doughnut",data:{datasets:[{data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()],backgroundColor:[window.chartColors.red,window.chartColors.orange,window.chartColors.yellow,window.chartColors.green,window.chartColors.blue],label:"Dataset 1"}],labels:["Red","Orange","Yellow","Green","Blue"]},options:{responsive:!0,legend:{position:"top"},title:{display:!1,text:"Chart.js Doughnut Chart"},animation:{animateScale:!0,animateRotate:!0}}},configDoughnut2={type:"doughnut",data:{datasets:[{data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()],backgroundColor:[window.chartColors.red,window.chartColors.orange,window.chartColors.yellow,window.chartColors.green,window.chartColors.blue],label:"Dataset 1"}],labels:["Red","Orange","Yellow","Green","Blue"]},options:{responsive:!0,maintainAspectRatio:!1,legend:{display:!1},title:{display:!1,text:"Chart.js Doughnut Chart"},animation:{animateScale:!0,animateRotate:!0}}},configPolar={data:{datasets:[{data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()],backgroundColor:[color(chartColors.red).alpha(.5).rgbString(),color(chartColors.orange).alpha(.5).rgbString(),color(chartColors.yellow).alpha(.5).rgbString(),color(chartColors.green).alpha(.5).rgbString(),color(chartColors.blue).alpha(.5).rgbString()],label:"My dataset"}],labels:["Red","Orange","Yellow","Green","Blue"]},options:{responsive:!0,legend:{position:"right"},title:{display:!1,text:"Chart.js Polar Area Chart"},scale:{ticks:{beginAtZero:!0},reverse:!1},animation:{animateRotate:!1,animateScale:!0}}},configLine={type:"line",data:{labels:["January","February","March","April","May","June","July"],datasets:[{label:"My First dataset",backgroundColor:window.chartColors.red,borderColor:window.chartColors.red,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()],fill:!1},{label:"My Second dataset",fill:!1,backgroundColor:window.chartColors.blue,borderColor:window.chartColors.blue,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]}]},options:{responsive:!0,maintainAspectRatio:!1,title:{display:!1,text:"Chart.js Line Chart"},legend:{display:!1},layout:{padding:{left:10,right:10,top:10,bottom:0}},tooltips:{mode:"index",intersect:!1},hover:{mode:"nearest",intersect:!0},pointBackgroundColor:"#fff",pointBorderColor:window.chartColors.blue,pointBorderWidth:"2",scales:{xAxes:[{display:!1,scaleLabel:{display:!0,labelString:"Month"}}],yAxes:[{display:!1,scaleLabel:{display:!0,labelString:"Value"}}]}}},horizontalBarChartData={labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dataset 1",backgroundColor:color(window.chartColors.red).alpha(.5).rgbString(),borderColor:window.chartColors.red,borderWidth:1,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]},{label:"Dataset 2",backgroundColor:color(window.chartColors.blue).alpha(.5).rgbString(),borderColor:window.chartColors.blue,data:[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]}]};$(document).ready(function(){if(document.getElementById("canvas")){var a=document.getElementById("canvas").getContext("2d");window.myBar=new Chart(a,{type:"bar",data:barChartData,options:{responsive:!0,legend:{position:"top"},title:{display:!1,text:"Chart.js Bar Chart"}}})}if(document.getElementById("chart-area")){var o=document.getElementById("chart-area").getContext("2d");window.myPie=new Chart(o,configPie)}if(document.getElementById("doughnut-chart")){var r=document.getElementById("doughnut-chart").getContext("2d");window.myDoughnut=new Chart(r,configDoughnut)}if(document.getElementById("doughnut-chart-2")){var t=document.getElementById("doughnut-chart-2").getContext("2d");window.myDoughnut=new Chart(t,configDoughnut2)}if(document.getElementById("doughnut-chart-3")){var n=document.getElementById("doughnut-chart-3").getContext("2d");window.myDoughnut=new Chart(n,configDoughnut2)}if(document.getElementById("radar-chart")&&(window.myRadar=new Chart(document.getElementById("radar-chart"),configRadar)),document.getElementById("polar-chart")){var e=document.getElementById("polar-chart");window.myPolarArea=Chart.PolarArea(e,configPolar)}if(document.getElementById("line-chart")){var l=document.getElementById("line-chart").getContext("2d");window.myLine=new Chart(l,configLine)}if(document.getElementById("chart-horiz-bar")){var c=document.getElementById("chart-horiz-bar").getContext("2d");window.myHorizontalBar=new Chart(c,{type:"horizontalBar",data:horizontalBarChartData,options:{elements:{rectangle:{borderWidth:2}},responsive:!0,legend:{position:"right"},title:{display:!1,text:"Chart.js Horizontal Bar Chart"}}})}if(document.getElementById("stacked-bars-chart")){var d=document.getElementById("stacked-bars-chart").getContext("2d");window.myBar=new Chart(d,{type:"bar",data:barChartData,options:{title:{display:!0,text:"Chart.js Bar Chart - Stacked"},tooltips:{mode:"index",intersect:!1},responsive:!0,scales:{xAxes:[{stacked:!0}],yAxes:[{stacked:!0}]}}})}});