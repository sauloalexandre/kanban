<?php
#	Autoload classes
function __autoload($class){ require_once("model/".$class.".class.php"); }

#	Objetos
$T= new Tarefa();
	
if(isset($_REQUEST["id"]) )
    $param["id"]= $_REQUEST["id"];
$param["order"]= "onde, prioridade";
$lista= $T->getTarefas($param);
echo $json= json_encode($lista);
?>