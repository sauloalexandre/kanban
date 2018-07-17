<?php session_start();
#	Autoload classes
function __autoload($class){ require_once("model/".$class.".class.php"); }



#	Objetos
$T= new Tarefa();


#	Parâmetros
$param= array();
$param["act"]= (isset($_REQUEST["act"]) ) ? $_REQUEST["act"] : "";




switch($param["act"]) {
	
	case "sort":
	    $param["onde"]= $_REQUEST["onde"];
	    $posicoes= $_REQUEST["posicoes"];
	    $qtd= count($posicoes);
	    for($i=0; $i<$qtd; $i++) {
		    $param["id"]= $posicoes[$i];
		    $param["prioridade"]= $i;
		    $param["id"]= $posicoes[$i];
			
		    $lista= $T->getTarefas($param);
			
			
		    $Obj= new Tarefa();
		    $Obj->set("id", $param["id"]);
		    $Obj->set("prioridade", $param["prioridade"]);
		    $Obj->set("onde", $param["onde"]);
		    $Obj->set("titulo", $lista[0]["titulo"]);
		    $Obj->set("detalhes", $lista[0]["detalhes"]);
			
		    $T->update($Obj);
		}
		break;
	
	case "update":
	    $param["id"]= $_REQUEST["id"];
	    $param["onde"]= $_REQUEST["onde"];
	    $param["prioridade"]= $_REQUEST["prioridade"];
	    $param["titulo"]= $_REQUEST["titulo"];
	    $param["detalhes"]= $_REQUEST["detalhes"];
	
	   	$Obj= new Tarefa();
	    $Obj->set("id", $param["id"]);
	    $Obj->set("prioridade", $param["prioridade"]);
	    $Obj->set("onde", $param["onde"]);
	    $Obj->set("titulo", $param["titulo"]);
	    $Obj->set("detalhes", $param["detalhes"]);
		
	    $T->update($Obj);
		
	    header("Location: ".$_SERVER["HTTP_REFERER"]);
	    break;
	
}
?>