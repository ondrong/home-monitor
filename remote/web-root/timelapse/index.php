<html>
<head>
<title>Video archyvas</title>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/4.12/video.js"></script>
<style type="text/css">

body {
margin: 0;
overflow:hidden;
background: #45484d; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, #45484d 36%, #000000 79%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(36%,#45484d), color-stop(79%,#000000)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover, #45484d 36%,#000000 79%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover, #45484d 36%,#000000 79%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover, #45484d 36%,#000000 79%); /* IE10+ */
background: radial-gradient(ellipse at center, #45484d 36%,#000000 79%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#000000',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}

.break {
 clear:both;
}

.border {
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  border-radius: 10px;
}

.shadow {
  -moz-box-shadow: 4px 4px 14px #666;
  -webkit-box-shadow: 4px 4px 14px #666;
  box-shadow: 4px 4px 14px #666;
}

.selected {
 color: #333;
 background: #888;
}

.hidden {
 display: none;
}

#left {
  margin-top: 10px;
  margin-left: 10px;
  width: 550px;
  float: left;
  background: #444;
  padding: 10px;
}


#left input.mygtukas {
 width: 70px;
 height: 25px;
 font-size: 14px;
 font-family: verdana, sans-serif, tahoma;
 border: 1px black;
 padding: 2px;
 cursor:pointer;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
}

#left input.mygtukas:hover {
 color: red;
 background: #333;
}

#right {
  margin-top: 10px;
  margin-right: 100px;
  width: 170px;
  float: right;
  background: #444;
  padding: 10px;
}

#return {
  margin-top: 10px;
  margin-right: 30px;
  width: 50px;
  float: right;
  background: #222;
  padding: 10px;
}

#return a {
  font-size: 14px;
  font-family: verdana, sans-serif, tahoma;
  color: #888;
  text-decoration: none;
}

#return a:hover {
  color: #CC9900;
}

#right select {
  width: 170px;
  height: 25px;
  font-size: 14px;
  font-family: verdana, sans-serif, tahoma;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
}

#main {
  margin-top: 50px;
  width: 100%;
  text-align: center;
}

#video {
 display: inline-block;
}

  .vjs-default-skin { color: #ffffff; }
  .vjs-default-skin .vjs-play-progress,
  .vjs-default-skin .vjs-volume-level { background-color: #3f6643 }
  .vjs-default-skin .vjs-control-bar,
  .vjs-default-skin .vjs-big-play-button { background: rgba(67,50,50,0.64) }
  .vjs-default-skin .vjs-slider { background: rgba(67,50,50,0.21333333333333335) }
  .vjs-default-skin .vjs-control-bar { font-size: 126% }


</style>
</head>
<body>
<?php

for ($i=1;$i<8;$i++) {

$files[$i] = scandir('./video/cam'.$i);

foreach($files[$i] as $file ) {
 if (fnmatch("*mp4", $file)) {
 $pics[$i][] = $file;
 }
}

${'newest_'.$i} = "http://mezon.puslapiai.lt/timelapse/video/cam".$i."/".end((array_values($pics[$i])));

}

?>
<div id="top">
<div id="left" class="border shadow">
<input rel="<?php; echo $newest_1. "?" . md5(uniqid(rand(), true)); ?>" rel2="1" type="button" value="kamera1" class="mygtukas selected">
<input rel="<?php; echo $newest_2. "?" . md5(uniqid(rand(), true)) ?>" rel2="2" type="button" value="kamera2" class="mygtukas">
<input rel="<?php; echo $newest_3. "?" . md5(uniqid(rand(), true)); ?>" rel2="3" type="button" value="kamera3" class="mygtukas">
<input rel="<?php; echo $newest_4. "?" . md5(uniqid(rand(), true)); ?>" rel2="4" type="button" value="kamera4" class="mygtukas">
<input rel="<?php; echo $newest_5. "?" . md5(uniqid(rand(), true)); ?>" rel2="5" type="button" value="kamera5" class="mygtukas">
<input rel="<?php; echo $newest_6. "?" . md5(uniqid(rand(), true)); ?>" rel2="6" type="button" value="kamera6" class="mygtukas">
<input rel="<?php; echo $newest_7. "?" . md5(uniqid(rand(), true)); ?>" rel2="7" type="button" value="kamera7" class="mygtukas">
</div>
<div id="return" class="border shadow">
<a href="../banana">INFO</a>
</div>
<div id="right" class="border shadow">
<?php

for ($i=1;$i<8;$i++) {
echo '<select name="camera'.$i.'" class="hidden" id="camera'.$i.'" autocomplete="off">';
$counter=0;
 foreach($pics[$i] as $cam) {
  $counter++;
  $size=count($pics[$i]);
  $data=substr($cam, strrpos($cam, '-')+1, -4);
  setlocale(LC_TIME, "lt_LT");
  $data2=strftime("%Y %B %e", strtotime($data));
  if ($counter<$size) { echo"<option value='http://mezon.puslapiai.lt/timelapse/video/cam".$i."/".$cam. "?" . md5(uniqid(rand(), true))."'>".$data2."</option>"; }
  else  { echo"<option value='http://mezon.puslapiai.lt/timelapse/video/cam".$i."/".$cam."?" . md5(uniqid(rand(), true))."' selected>".$data2."</option>"; } 
 }
echo '</select>';
}

?>
</div>
</div>
<div class="break"></div>
<div id="main">
<div id="video" class="shadow">
<video id="kamera" class="video-js vjs-default-skin" controls
 preload="auto" width="800" height="600" data-setup="{}">
 <source src="<?php; echo $newest_1 . "?" . md5(uniqid(rand(), true)); ?>" type='video/mp4'>
 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading.</a></p>
</video>
</div>
</div>
<script>

$("select[id='camera1']").show();
var $chosen = 1;

$("input[type=button]").click(function() {
    var $target         = $(this).attr("rel");
    var $vid_obj        = _V_("kamera");
	
	$(this).blur();
	$("input[type=button]").removeClass("selected");
 	$(this).addClass("selected");
	$chosen = $(this).attr("rel2");    
	$("select").hide();
	$("#camera"+$chosen+" option:last").prop('selected',true);
	$("select[id='camera"+$chosen+"']").show();
	
    $vid_obj.ready(function() {
      $("#kamera_html5_api").hide();
      $vid_obj.pause();
      $vid_obj.src({ src: $target, type: "video/mp4" });
      $("video:nth-child(1)").attr("src",$target);
      $("#kamera").removeClass("vjs-playing").addClass("vjs-paused");
      $vid_obj.load();
      $("#kamera_html5_api").show();
    });
});


$('select').on('change', function() {
    var $target = $(this).find(":selected").val();
    var $vid_obj        = _V_("kamera");

 $vid_obj.ready(function() {
      $("#kamera_html5_api").hide();
      $vid_obj.pause();
      $("video:nth-child(1)").attr("src",$target);
	  $vid_obj.src({ src: $target, type: "video/mp4" });
      $("#kamera").removeClass("vjs-playing").addClass("vjs-paused");
      $vid_obj.load();
      $("#kamera_html5_api").show();
    });


});

$vid_obj.addEvent("loadeddata", function () {
    $vid_obj.play();
});

</script>

</body>
</html>
