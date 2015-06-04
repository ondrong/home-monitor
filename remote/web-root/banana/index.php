<?php



# prisijungiam prie DB

require("inc/mysql_conn.php");



# norimo laikotarpio pasirinkimas

$chart_days = $_GET["type"];



# anksciau naudotas budas --> taip sakant, legacy

# gaunam paskutines reiksmes surusiuotas didejimo tvarka pagal id

# norim 192 eiluciu, nes 4*24*2=192, o tai yra 2 paros duomenu kas 15 min.

# $query = "SELECT  * FROM (SELECT * FROM banana ORDER BY id DESC LIMIT 192)x ORDER BY id";





# pradedant 1 savaites grafiku duomenis reikia suvidurkinti

switch ($chart_days) {

// 1 diena

  case '1d':

	$query = "SELECT 1*FLOOR(id/1) as id, data, avg(temp01) as temp01, 

  avg(temp02) as temp02 FROM (SELECT * FROM banana where data > NOW() - INTERVAL 1 DAY order by id)x 

  group by 1*FLOOR(id/1)";

	break;

// 1 savaite

  case '1s': 

	$query = "SELECT 4*FLOOR(id/4) as id, data, avg(temp01) as temp01, 

  avg(temp02) as temp02 FROM (SELECT * FROM banana where data > NOW() - INTERVAL 1 WEEK order by id)x 

  group by 4*FLOOR(id/4)";

	break;

// 2 savaites

  case '2s': 

	$query = "SELECT 8*FLOOR(id/8) as id, data, avg(temp01) as temp01, 

  avg(temp02) as temp02 FROM (SELECT * FROM banana where data > NOW() - INTERVAL 2 WEEK order by id)x 

  group by 8*FLOOR(id/8)";

	break;

// 1 menuo

  case '1m': 

	$query = "SELECT 16*FLOOR(id/16) as id, data, avg(temp01) as temp01, 

  avg(temp02) as temp02 FROM (SELECT * FROM banana where data > NOW() - INTERVAL 1 MONTH order by id)x 

  group by 16*FLOOR(id/16)";

	break;

// visais kitais atvejais dvi dienos

  default:

	$query = "SELECT 1*FLOOR(id/1) as id, data, avg(temp01) as temp01, 

  avg(temp02) as temp02 FROM (SELECT * FROM banana where data > NOW() - INTERVAL 2 DAY order by id)x 

  group by 1*FLOOR(id/1)";

	$chart_days = "2d";

}



# kreipiames i DB su norima uzklausa

$result = mysql_query($query) or die(mysql_error());



# sukuriam masyva su lietuviskas menesiu pavadinimais X asiai

# taip pat multi masyva su pirmo daviklio duomenim ir tikslia data tooltip'ui



$real_min=100;

$real_max=-100;



while($row = mysql_fetch_array($result)){

setlocale(LC_TIME, 'lt_LT'); # lietuviski menesiu pavadinimai

$temper['label'][]=strftime("%b-%d %H:%M", strtotime($row['data']));

$temper['temp01'][$row['data']][]=$row['temp01'];

$temper['temp02'][$row['data']][]=$row['temp02'];



# surandam min ir maks reiksmes Y asies reziams nustatyti



if ($row['temp01'] < $row['temp02']) {

  $min = $row['temp01'];

}

else {

  $min = $row['temp02'];

}



if ($row['temp01'] > $row['temp02']) {

  $max = $row['temp01'];

}

else {

  $max = $row['temp02'];

}





if ($min < $real_min) {

 $real_min = $min;

}

if ($max > $real_max) {

 $real_max = $max;

}



}



# galutiniai Y asies intervalo reziai (pvz. 15,1 ir 24,3 ===> 15 ir 25)



$y_min = floor($real_min);

$y_max = ceil($real_max);





?>



<!DOCTYPE html>

<html>

<head>

<script src="js/jquery-2.1.1.min.js"></script>

<script src="js/chartist.min.js"></script>

<link href="css/chartist.min.css" rel="stylesheet" type="text/css" />

<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="lib-mbox/mbox.min.js"></script>

<link type="text/css" rel="stylesheet" href="lib-mbox/style.css" />

<meta charset="utf-8" />

<meta name="robots" content="noindex" />

<meta http-equiv="Cache-Control" content="no-store" />

<title>Home-Monitor Web Interface</title>

</head>

<body>

<div class="smallscreen">This page is intented to be viewed on a computer screen!<br>

In order to see see the content please maximize your browser window.</div>

<div class="menu">

  <a href="?type=1d" <?php; if ($chart_days == "1d") {print('class="active"');} ?>>1_diena</a> |

  <a href="./" <?php; if ($chart_days == "2d") {print('class="active"');} ?>>2_dienos</a> |

  <a href="?type=1s" <?php; if ($chart_days == "1s") {print('class="active"');} ?>>1_savaitė</a> | 

  <a href="?type=2s" <?php; if ($chart_days == "2s") {print('class="active"');} ?>>2_savaitės</a> |  

  <a href="?type=1m" <?php; if ($chart_days == "1m") {print('class="active"');} ?>>1_mėnuo</a>

</div>

<div class="menu2">

  <a id="main_switch" href="#">informacija</a> |

  <a id="secondary_switch" href="#">kameros</a> | 

  <a id="timelapse_switch" href="../timelapse">video</a>

</div>

  <div class="newline"></div>

<div class="primary">

  <div class="ct-chart"></div>

  <div class="cam">

<a class="mbox" data-init="fullscreen" href="" id="mylink">

<img src="" id="myimage">

</a>

</div>

  <div class="newline"></div>

  <div class="informacija">

<div class="info"><pre>bananapi@malūno81:~/ health of Banana Pi?



<?php; echo file_get_contents("../ip.txt" );?></pre></div>

<div class="info2"><pre>bananapi@malūno81:~/ network check?



<?php; echo file_get_contents("../ping.txt" );?></pre></div>

<div class="newline"></div>

</div>

</div>

<div class="secondary">

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap.jpg">

<img src="../snap.jpg" class="secondary-cams">

</a></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap2.jpg">

<img src="../snap2.jpg" class="secondary-cams">

</a></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap3.jpg">

<img src="../snap3.jpg" class="secondary-cams">

</a></div>

<div class="newline"></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap4_ws.jpg">

<img src="../snap4.jpg" class="secondary-cams">

</a></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap5.jpg">

<img src="../snap5.jpg" class="secondary-cams">

</a></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap6.jpg">

<img src="../snap6.jpg" class="secondary-cams">

</a></div>

<div class="newline"></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap7.jpg">

<img src="../snap7.jpg" class="secondary-cams">

</a></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap8.jpg">

<img src="../snap8.jpg" class="secondary-cams">

</a></div>

<div class="camera"><a class="mbox" data-init="fullscreen" href="../snap9.jpg">

<img src="../snap9.jpg" class="secondary-cams">

</a></div>

</div>

<img id="preloader" src="">

<script>

new Chartist.Line('.ct-chart', {

  labels: [

<?php

$total = count($temper['label']);

$i=0;

foreach ($temper['label'] as $label) {

    $i++;

    echo '"'.$label.'"';

    if ($i != $total) echo', ';

}

?>

],

  series: [

    [



<?php

$total = count($temper['label']);

$i=0;

foreach ($temper['temp01'] as $name => $value) {

    $i++;

    echo "{value: $value[0], meta: 'II a. $name'}";

    if ($i != $total) echo', ';

}

?>

],

[

<?php

$total = count($temper['label']);

$i=0;

foreach ($temper['temp02'] as $name => $value) {

    $i++;

    echo "{value: $value[0], meta: 'I a. $name'}";

    if ($i != $total) echo', ';

}

?>

]







  ]

}, {

    lineSmooth: Chartist.Interpolation.cardinal({

    divisor: 5,

    tension: 0.2

  }),

axisX: {

  offset: 45,

labelInterpolationFnc: function skipLabels(value, index) {

      return index % 32  === 0 ? value : null;

    }

  },

  axisY: {

    scaleMinSpace: 20,

     offset: 65,

labelInterpolationFnc: function skipLabels(value, index) {

      return index % 2  === 0 ? value+" °C" : null;

    }

  },

  low:<?php; echo $y_min; ?>,

  high:<?php; echo $y_max; ?>,

  fullWidth: false,

  chartPadding: {

    right: 10

  },

  width: 800,

  height: 320,

});



var $chart = $('.ct-chart');



var $toolTip = $chart

  .append('<div class="tooltip"></div>')

  .find('.tooltip')

  .hide();



$chart.on('mouseenter', '.ct-point', function() {

  var $point = $(this),

    value = $point.attr('ct:value'),

    label = $point.attr('ct:meta');

  $toolTip.html(label + '<br> temperatura buvo ' + value + " C").show();

});



$chart.on('mouseleave', '.ct-point', function() {

  $toolTip.hide();

});



$chart.on('mousemove', function(event) {

  $toolTip.css({

    left: (event.offsetX || event.originalEvent.layerX) - $toolTip.width() / 2 - 10,

    top: (event.offsetY || event.originalEvent.layerY) - $toolTip.height() + 100

  });

});



// kameros paveiksliukai

var cam_thumb = document.getElementById("myimage");

var cam_full = document.getElementById("mylink");

var cam_preload = document.getElementById("preloader");



// kameru vaizdo failu masyvas, atitinkamai thumbnailas ir fullscreenas 

var cameras = [

 ['snap.jpg', 'snap.jpg'],

 ['snap2.jpg', 'snap2.jpg'],

 ['snap3.jpg', 'snap3.jpg'],

 ['snap4.jpg', 'snap4_ws.jpg'],

 ['snap5.jpg', 'snap5.jpg'],

 ['snap6.jpg', 'snap6.jpg'],

 ['snap7.jpg', 'snap7.jpg'],
 
 ['snap8.jpg', 'snap8.jpg'],

 ['snap9.jpg', 'snap9.jpg']

];



// preloadinam kameru paveiksliukus ir uzsikesuojam juos iki puslapio refresho

for (index = 0; index < cameras.length; ++index) {

   cam_preload.src= '../' + cameras[index][1];

}



// po reloado visuomet rodome pirma kamera

var pic_index = 0;



cam_thumb.src = '../'+cameras[0][0];

cam_full.href = '../'+cameras[0][1];



// aktyvuojame peles ratuko pasukimo ant paveiksiuko ivykio stebejima 



if (myimage.addEventListener) {

  myimage.addEventListener("mousewheel", MouseWheelHandler, false);

  myimage.addEventListener("DOMMouseScroll", MouseWheelHandler, false);

}

else myimage.attachEvent("onmousewheel", MouseWheelHandler);



// apibreziam, ka darysim, kai pastebesim pasukta peles ratuka ant paveiksliuko



function MouseWheelHandler(e) {

 var e = window.event || e;

 var delta = e.wheelDelta || -e.detail;

 var delta = delta * (-1); // nustatom teisinga ivyki - ratukas zemyn ar virsun

 var change = 0; // ratukas dar nepaliestas

 if (delta > 0) { change += 1; } else { change += -1; } // multiple prasukimus traktuojame kaip viena

 if (change > 0) { 

  if (pic_index == cameras.length-1) { pic_index = 0; } else { pic_index += 1; } // rodome sekanti arba pirma

 }

 else {

  if (pic_index == 0) { pic_index = cameras.length-1; } else { pic_index += -1; } // rodome ankstesni arba paskutini

 }

 // pakeiciam kameros paveiksliuko attributus

 cam_thumb.src = '../'+cameras[pic_index][0];

 cam_full.href = '../'+cameras[pic_index][1];

}





// nustatom paveiksliuko ir informacijos lauko proporcijas priklausomai nuo ekrano dydzio



  window.onresize = function() {

    var cam_width = window.innerWidth - 905;

    var cam_height = cam_width / 1.25;

    if (cam_width > 400) { cam_width = 400 }

    if (cam_height > 320) { cam_height = 320 }



    var info_width = window.innerWidth;

    if (info_width > 1210) { info_width = 1210 }



    $('#myimage').css({'height': cam_height, 'width': cam_width });

    $('.informacija').css({'width': info_width });

  };



// inicializuojam desini meniu

var info_on = true;

$("#main_switch").addClass('active');

$(".secondary").hide();



// CAM mygtuko logika

 $("#secondary_switch").click(function() {

 if (info_on) {

   info_on = !info_on;

   $(".primary, .secondary").toggle("slow");

   $(".menu").css({ visibility: "hidden"});

   $("#main_switch").removeClass('active');

   $(this).addClass('active');

   $(this).blur(); 

 }

});



// INFO mygtuko logika

 $("#main_switch").click(function() {

 if (!info_on) {

   info_on = !info_on;

   $(".primary, .secondary").toggle("slow");

   $(".menu").css({ visibility: "visible"});

   $("#secondary_switch").removeClass('active');

   $(this).addClass('active');

   $(this).blur(); 

 }

});


<<<<<<< HEAD
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> origin/master
// uzvedus pele ant kameros, rodom jos laiko panorama 
$("img.secondary-cams")
  .mouseover(function() {
    kamera = $(this);
    kamera_original_src = kamera.attr("src");
    kelinta_kamera=kamera.attr("rel");
    paveiksliukai = [];
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
    if (dd<10) { dd= '0' + dd } 
    if (mm<10) { mm= '0' + mm } 
    today = yyyy+mm+dd;
    $.getJSON('cam-history.php', {'date':today,'kamera':kelinta_kamera,password:'1'}, function(data) {
       $.each(data, function(key, val) {
         paveiksliukai.push(val);
       });
    });
    index = 0
	var grayout = function grayImage() {
	  live_change_enabled = false;
 	  $("img.secondary-cams").not(this).removeClass("blur-off");
	  $("img.secondary-cams").not(this).addClass("blur-on");
	  kamera.removeClass("blur-on");
	  kamera.addClass("blur-off");
    };
    var timelapse = function rotateImage() {
       kamera.attr("src",'../timelapse/archive/'+today+'/'+paveiksliukai[index]);
       if (index == paveiksliukai.length-1) { index = 0; }
       else { index++; }
    };
    timelapse_timer = setInterval (timelapse, 200);
    grayout_timer = setTimeout (grayout, 1000);
  })
 .mouseout(function() {
    live_change_enabled = true;
    clearTimeout(timelapse_timer);
    clearTimeout(grayout_timer);
    kamera.attr("src",kamera_original_src);
    $("img.secondary-cams").not(this).removeClass("blur-on");
    $("img.secondary-cams").not(this).addClass("blur-off");
 });


// atnaujinam paveiksliukus kas 2 minutes

var change = function liveImage() {
   if (live_change_enabled) {
        //$("img.secondary-cams").fadeOut(500);

        $('img.secondary-cams').attr('src',function(i,e){
 		 older=e;
		 sid = Date.now() + Math.random();
		 newer=older+"?"+sid;
		 return newer;
		});
        $('a.mbox').attr('href',function(i,e){
 		 older=e;
		 sid = Date.now() + Math.random();
		 newer=older+"?"+sid;
		 return newer;
		});

        //$("img.secondary-cams").fadeIn(500);
   } 
};

change_timer = setInterval (change, 2*60*1000);

</script>

</body>

</html>

