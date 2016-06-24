<?php 
include("functions.php");
$manager = new DataManager();

if(isset($_GET["name"])){
    $name = $_GET["name"];
    $manager->$name();
}

if(isset($_POST["name"])){
    $name = $_POST["name"];
    $method = new ReflectionMethod('DataManager', $name);
    $params = $method->getParameters();
    $args =array();
    foreach ($params as $p) {
        if(isset($_POST[$p->name])) {
            $args[] = $_POST[$p->name];
        }else{
            echo "Wrong number of parameters";
            break;
        }
    }
    if(count($params)==count($args))
        call_user_func_array(array($manager, $name),$args);
}

?>