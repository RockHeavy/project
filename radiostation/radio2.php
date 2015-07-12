<?php
###############################################################################
## $Id: current-station-info.php,v 1.0 2011/04/05 14:10:00 paulisch Exp $
##  ------------------------------------------------------------------------ ##
##      current-station-info.php - Example Usage of the laut.fm API          ##
##                  Copyright (c) 2011 laut.fm - Dennis Paulisch             ##
##                       <http://www.laut.fm/>                               ##
##  ------------------------------------------------------------------------ ##
###############################################################################
?>
<!DOCTYPE html>
<html>
  <head>
    <title>laut.fm API PHP example</title>
    <meta content='text/html;charset=utf-8' http-equiv='content-type'>
  </head>
  <body>

<?php

// Um welche Station handelt sich's:
$station = "rockheavy";

// Die Stations-Infos aus der API abfragen:
$json_station = file_get_contents("http://api.laut.fm/station/".$station);
// zu Debuggen einkommentieren:
// var_dump($http_response_header);
// var_dump($json_station);

// Die Anwort von JSON in einen assoziativen Object umwandeln:
$obj_station = json_decode($json_station);

// Aktuellen Song aus der API abfragen:
$json_song = file_get_contents("http://api.laut.fm/station/".$station."/current_song");
// zu Debuggen einkommentieren:
// var_dump($http_response_header);
// var_dump($json_song);

// Die Anwort von JSON in einen assoziativen Object umwandeln:
$obj_song = json_decode($json_song);

// var_dump($json_song);

// Bild anzeigen, wenn's eins gibt:
if ( $obj_song->artist->image ) {
  echo '<a href="' . $obj_song->artist->laut_url . '"><img src="' . $obj_song->artist->image . '"></a>';
  echo "<br>";
}

// Stationsinfos anzeigen:
echo 'Stationsname: <a href="http://laut.fm/' . $obj_station->name . '">' . $obj_station->name . "</a><br>";
echo "Description: " . $obj_station->description . "<br>";

// Aktuellen Song anzeigen:
echo "Current Song: " . $obj_song->artist->name . " - " . $obj_song->title . "<br>";

// Aktuelle Playlist anzeigen:
if ($obj_station->current_playlist) {
    echo "Current Playlist: " . $obj_station->current_playlist->name ."<br>";
} else {
    echo "Current Playlist: Basisplayliste";
}

?>

  </body>
</html>

