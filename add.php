<?php session_start();
#	Autoload classes
function __autoload($class){ require_once("model/".$class.".class.php"); }

#	Objetos
$T= new Tarefa();

#	Parâmetros
$param= array();
$param["prioridade"]= $_REQUEST["prioridade"];
$param["onde"]= $_REQUEST["onde"];
$param["titulo"]= $_REQUEST["titulo"];
$param["detalhes"]= $_REQUEST["detalhes"];


$Obj= new Tarefa();
$Obj->set("prioridade", $param["prioridade"]);
$Obj->set("onde", $param["onde"]);
$Obj->set("titulo", $param["titulo"]);
$Obj->set("detalhes", $param["detalhes"]);

$T->add($Obj);

$param["id"]= $_SESSION["last_insert_id"];
echo $json= json_encode($param);
?>