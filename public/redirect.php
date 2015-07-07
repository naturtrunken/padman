<?php
//ini_set("display_errors","on");
include "../config.inc.php";
include "../jsondb.inc.php";

$sldb = new JsonDB('shortlnk');

if (isset($_SERVER["REDIRECT_STATUS"]) && $_SERVER["REDIRECT_STATUS"] == "404") {
	$url = $_SERVER["REDIRECT_SCRIPT_URL"];
}
if (isset($_GET["lnk"])) $url = $_GET["lnk"];

if (preg_match('#/([a-z0-9-]+)$#', $url, $res)) {
    foreach($sldb->p as $k=>$v) {
      if ($v == $res[1]) {
        //header("Location: ".PAD_URL. $k);
	header("HTTP/1.1 200 So fluffy");
        $shortName = substr($k,strpos($k,'$')+1);
        echo '<!doctype html><html><head><meta charset="utf8">';
        echo "<title>$shortName - etherpad</title>\n";
      	echo "<style>   html,body {margin:0;padding:0;height:100%;overflow:hidden;}
           iframe { width: 100%; height: 100%; border: 0; }   </style>
           </head><body>\n";
      	echo '<iframe src="'.PAD_URL. $k.'"></iframe></body></html>';
        exit;
      }
    }
    
  }


?>
<!doctype html>
<html>
<head>
<meta charset="utf8">
<meta name='viewport' content='width=device-width, initial-scale=1'>
<style>body { max-width: 600px; margin: 10px auto; }</style>

</head>
<body>
<h3>Pad nicht gefunden</h3>

<p>Pr&uuml;fe bitte nochmals den Link, vielleicht hast du dich ja vertippt... </p>
<p>Ansonsten kann es auch sein, dass das Pad nicht mehr &ouml;ffentlich zug&auml;nglich ist, oder dass es gel&ouml;scht wurde.</p>

</body>
</html>

