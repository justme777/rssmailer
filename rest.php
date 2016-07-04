<?php 

header("Access-Control-Allow-Origin: http://rssmailerweb:8181");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Expose-Headers: Access-Control-Allow-Origin,Access-Control-Allow-Credentials");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("functions.php");
$manager = new DataManager();

$name=getValue("name");

$method = new ReflectionMethod('DataManager', $name);
$params = $method->getParameters();
$args =array();
foreach ($params as $p) {
    $val = getValue($p->name);
    if($val) {
        $args[] = $val;
    }else{

        echo "Wrong number of parameters1";
        break;
    }
}
    if(count($params)==count($args))
        call_user_func_array(array($manager, $name),$args);

function getValue($key){
    $value="";
    if(isset($_GET[$key])){
        $value=$_GET[$key];
    }elseif(isset($_POST[$key])){
        $value=$_POST[$key];
    }else{ return; }
    return $value;
}

?>