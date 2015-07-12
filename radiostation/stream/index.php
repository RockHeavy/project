<?php
set_time_limit(0);
//digitally-imported.fm electro-house mp3 stream. Please bare with me.
define('SRC_URL', 'http://stream.laut.fm/rockheavy');
$strContext=stream_context_create(
    array(
      'http'=>array(
        'method'=>'GET',
        'header'=>"Accept-language: en\r\n"
      )
    )
  );
$fpOrigin=fopen(SRC_URL, 'rb', false, $strContext); //open a binary compatible stream
header('content-type: application/octet-stream');   //setup the current user session
while(!feof($fpOrigin)){
  $buffer=fread($fpOrigin, 4096); //we read chunks of 4096 bytes
  echo $buffer; //And we send them back to the current user
  flush();  //we try to flush the output buffer, in case there is a deflated or gzipped transfert betweenm the web server and the client
}
fclose($fpOrigin);
?>
