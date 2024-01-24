<?php
$setted = false;

$x = $_POST['x'];
$y = $_POST['y'];
$color = $_POST['color'];
$playerInfo = array(
    "x" => $x,
    "y" => $y,
    "color" => $color,
);
$myfile = fopen("place.json", "r+") or die("Unable to open file!");
$currentData = fread($myfile, filesize("transformdata.json"));
fclose($myfile);
$myfile = fopen("place.json", "w+") or die("Unable to open file!");
$data = json_decode($currentData, true);
if($data["objects"] != null){

foreach ($data["objects"] as $key=>$item) {
    if($item["x"] == $x) {
        if($item["y"] == $y) {
            //unset($data["objects"][$key]);
            $data["objects"][$key] = $playerInfo;
            $setted = true;
        }
        //unset($data["objects"][$key]);
        $data["objects"][$key] = $playerInfo;
        $setted = true;
    }
    
}
if($setted == false) {
    array_push($data["objects"], $playerInfo);
}
}
else{
    $data["objects"] = array($playerInfo);
}


fwrite($myfile, json_encode($data));
fclose($myfile);

