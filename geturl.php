<?php
$errno="";
$errstr="";
$data="params=".urlencode($_POST["params"])."&encSecKey=".urlencode($_POST["encSecKey"]);
$data1="params=rgDziP%2F2JJfLy92cJtod14rAxpS6MVrh0H1Wf8fxDUIwkikVgfI3ejm9udkjn8CoDwIEtbbJTSwkciB6Pgc%2BY760Y473TQXt%2B0nxNWZbgV4%3D&encSecKey=979ebcde23a2a3bf0d55febf3a9482b07de67d80e476bdf316cc74ffe29f48986e48486b02896f7ebd9f1c66ab43871385960d9a5e494b43ce0e9262c59185beeae87863b364ecfd203815c9b22fd07a370612038f3a3b0a55d848a239a311b35ed049e2e6b7a49eddec0c1b08f63a33a224a1ac63e6d2cfec225850a1773998";
$fp=fsockopen("music.163.com",80,$errno,$errstr,5);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
}
else{
  $out = "POST /weapi/song/enhance/player/url?csrf_token= HTTP/1.1\r\n";
  $out .= "Host: music.163.com\r\n";
  $out .= "Content-Type:application/x-www-form-urlencoded\r\n";
  $out .= "Content-Length: ".strlen($data1)."\r\n";
  $out .= "Connection: close\r\n\r\n";
  $out .= $data;
  $out .= "\r\n\r\n";
fwrite($fp, $out);
$inheader = 1;
while(!feof($fp)){//测试文件指针是否到了文件结束的位置
 $line = fgets($fp,1024);
 //去掉请求包的头信息
 if ($inheader && ($line == "\n" || $line == "\r\n")) {
       $inheader = 0;
  }
  if ($inheader == 0) {
    echo $line;
  }
}
fclose($fp);
}

 ?>
