<?php
//Classe Tarefa
class Tarefa
{
	
	/*	Atributos */	
    protected $id;
    protected $prioridade;
    protected $onde;
    protected $titulo;
    protected $detalhes;
			

	/*	Construtor */
	function __construct() {	}

	/*	Set */
	function set($atr, $val)
	{
	    $this->$atr=	$val;
	}

	
	/*	Get */
	function get($atr)
	{
	    return $this->$atr;
	}		



	/***********************************************************************/
	//
	//								GET
	//
	/***********************************************************************/
	/*	
		FUNÇÃO: 		getPessoas
								Faz a listagem dos registros
		PARÂMETROS: param
		RETORNO: 		array de objetos
	*/
	function getTarefas($param)
	{
	    $mySQL= New MySQL();
	    $sql=    "SELECT
				    id
				    , prioridade
				    , onde
				    , titulo
				    , detalhes
                 FROM
				    tarefas
				WHERE
				    id > 0";
		
		$sql.= (isset($param["id"]) ) ? " AND id=".$param["id"] : "";#	id
		$sql.= (isset($param["order"]) ) ? " ORDER BY ".$param["order"] : " ORDER BY id";#	Order
		
		$rs= $mySQL->runQuery($sql);
		$lista= mysqli_fetch_all($rs,MYSQLI_ASSOC);
		return $lista;

	}



	/***********************************************************************/
	//
	//								DO
	//
	/***********************************************************************/
	/*	
		FUNÇÃO:			add
		PARÂMETROS:	objeto Pessoa
		RETORNO:		void
		DESCRIÇÃO:	Cadastra
	*/
	function add($Obj)
	{
		
		$mySQL= New MySQL();	
		$sql=   "INSERT INTO tarefas (
				    prioridade
					, onde
					, titulo
					, detalhes
				 ) VALUES (
				    '".$Obj->get("prioridade")."'
					, '".$Obj->get("onde")."'
					, '".$Obj->get("titulo")."'
					, '".$Obj->get("detalhes")."'
				 )";
		$mySQL->runQuery($sql);

	
	}
	
	
	/*	
		FUNÇÃO:			update
		PARÂMETROS:	Objeto
		RETORNO:		void
		DESCRIÇÃO:	Altera
	*/
	function update($Obj)
	{
		
		$mySQL= New MySQL();	
		$sql=   "UPDATE tarefas
				SET prioridade = '".$Obj->get("prioridade")."'
				    , onde = '".$Obj->get("onde")."'
					, titulo = '".$Obj->get("titulo")."'
					, detalhes = '".$Obj->get("detalhes")."'
				WHERE
				    id = ".$Obj->get("id").";";
		$mySQL->runQuery($sql);
	
	}
	
	
	/*	
		FUNÇÃO:			exc
		PARÂMETROS:	param
		RETORNO:		void
		DESCRIÇÃO:	Deleta Pessoa
	*/
	function exc($param)
	{
		
		$mySQL= New MySQL();	
		$sql=	"DELETE FROM tarefas
				WHERE id = '".$param["id"]."';";
		$mySQL->runQuery($sql);
	
	}
	

}	//fim da classe
?>