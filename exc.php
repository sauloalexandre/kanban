<?php session_start();
#	Autoload classes
function __autoload($class){ require_once("model/".$class.".class.php"); }



#	Objetos
$T= new Tarefa();


#	Parâmetros
$param= array();
$param["id"]= $_REQUEST["id"];


$T->exc($param);

echo $json= json_encode($param);
?>