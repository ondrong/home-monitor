<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta charset='utf-8'>
<title>Temperatūros</title>
<script src="jquery-2.1.1.min.js" type="text/javascript"></script>
<style type="text/css">

body {
margin: 0;
overflow:hidden;
background: rgb(181,189,200); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  rgba(181,189,200,1) 2%, rgba(130,140,149,1) 36%, rgba(40,52,59,1) 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(2%,rgba(181,189,200,1)), color-stop(36%,rgba(130,140,149,1)), color-stop(100%,rgba(40,52,59,1))); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  rgba(181,189,200,1) 2%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  rgba(181,189,200,1) 2%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  rgba(181,189,200,1) 2%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* IE10+ */
background: radial-gradient(ellipse at center,  rgba(181,189,200,1) 2%,rgba(130,140,149,1) 36%,rgba(40,52,59,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b5bdc8', endColorstr='#28343b',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}

#wrapper {

}

#main {
 text-align: center;
 overflow:hidden;
 margin-top: 50px;
}

#top {
  font-family: Verdana, Tahoma, Arial;
}

.border {
  -moz-border-radius: 20px;
  -webkit-border-radius: 20px;
  border-radius: 20px;
}

.shadow {
  -moz-box-shadow: 4px 4px 14px #000;
  -webkit-box-shadow: 4px 4px 14px #000;
  box-shadow: 4px 4px 14px #000;
}

#chart {
  height: 640px;
  width: 1240px;
  margin: 10px;
  display: inline-block;
  background: white;
}

.chart-image {  
  background: url('loading.gif') no-repeat;
  height: 640px;
  width: 1240px;
}

.hidden {
 display: none;
}

#menubar {
 float: left;
 width: 300px;
 background: #0C2B3E;
 margin: 20px;
 padding: 5px;
 font-size: 16px;
 color: white;
}

#menubar-right {
 float: right;
 width: 210px;
 background: #0C2B3E;
 margin: 20px;
 padding: 5px;
 font-size: 16px;
 color: white;
}

a {
 color: white;
 text-decoration: none;
}

a:hover {
 color: #E5C870;
}

a.active {
 color: #B8A774;
 font-weight: bold;
}

.nofloat {
 clear: both;
}

</style>
</head>
<body scroll="no">
<div id="wrapper">
<div id="top">
<div id="menubar" class="border shadow"><a href="javascript:return false();" id="link-day">DIENA</a> |
<a href="javascript:return false();" id="link-week">SAVAITĖ</a> |
<a href="javascript:return false();" id="link-month">MĖNUO</a> |
<a href="javascript:return false();" id="link-year">METAI</a>
</div>
<div id="menubar-right" class="border shadow"><a href="banana/">DAUGIAU INFORMACIJOS</a>
</div>
</div>
</div>
<div class="nofloat"></div>
<div id="main">
<div id="chart" class="border shadow">
<img src="grafikas-diena.png" id="chart-day" class="chart-image border"></div>
<img src="grafikas-savaite.png" id="chart-week" class="chart-image border hidden"></div>
<img src="grafikas-menuo.png" id="chart-month" class="chart-image border hidden"></div>
<img src="grafikas-metai.png" id="chart-year" class="chart-image border hidden"></div>
</div>
</div>
</div>
<script type="text/javascript">

var chart = document.getElementById("chart-day");

 $("#link-day").click(function() {
   $("#menubar a").removeClass("active");
   $(this).addClass("active");
   $("#chart-day").fadeToggle('slow', function(){
    chart.src='loading.gif';
    chart.src='grafikas-diena.png';
   })
   $("#chart-day").delay(500).fadeToggle("slow", "linear");
});

 $("#link-week").click(function() {
   $("#menubar a").removeClass("active");
   $(this).addClass("active");
   $("#chart-day").fadeToggle('slow', function(){
    chart.src='loading.gif';
    chart.src='grafikas-savaite.png';
   })
   $("#chart-day").delay(500).fadeToggle("slow", "linear");
});

 $("#link-month").click(function() {
   $("#menubar a").removeClass("active");
   $(this).addClass("active");
   $("#chart-day").fadeToggle('slow', function(){
    chart.src='loading.gif';
    chart.src='grafikas-menuo.png';
   })
   $("#chart-day").delay(500).fadeToggle("slow", "linear");
});

 $("#link-year").click(function() {
   $("#menubar a").removeClass("active");
   $(this).addClass("active");
   $("#chart-day").fadeToggle('slow', function(){
    chart.src='loading.gif';
    chart.src='grafikas-metai.png';
   })
   $("#chart-day").delay(500).fadeToggle("slow", "linear");
});

</script>
</body></html>
