<?php
cors();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    require_once "includes/dbh.inc.php";
	$x = $_POST['x'];
    $y = $_POST['y'];
    $color = $_POST['color'];

    $query = $pdo->prepare("SELECT * FROM `pixels` WHERE `x` = :xix AND `y` = :yiy");
    $query->bindValue(":xix",$x);
    $query->bindValue(":yiy",$y);
    $override = false;
    $query->execute();
    while ($row = $query->fetch()) {
        if($query->rowCount() != 0) {
            $override = true;
        }
    } 
    
    if($override == false){
        try{
            require_once "includes/dbh.inc.php";
            $query = "INSERT INTO pixels (x,y,color) VALUES (?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$x,$y,$color]);
    
            $pdo = null;
            $stmt = null;
    
            exit();
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
    if($override == true){
        require_once "includes/dbh.inc.php";
        $query = "UPDATE `pixels` SET `color` = (?) WHERE `pixels`.`x` = (?) AND `pixels`.`y` = (?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$color,$x,$y]);
    
        $pdo = null;
        $stmt = null;
    
        exit();
    }
}

function cors() {
    
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
}