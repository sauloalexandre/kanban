<!doctype html>
<html lang="en">
	<head>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
        <style>
			body {font-family:Arial;}
			h2 {margin:5px;}
			input[type=text] {margin:10px}
			input[type=button] {margin:10px}
			.container {width: 20%; float:left;clear: right;margin:10px; border-radius: 5px;}
			.sortable { list-style-type: none; margin:0; padding:2px; min-height:30px; border-radius: 5px;}
			.sortable li { margin: 3px 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 80px;}
			.sortable li span { position: absolute; margin-left: -1.3em; }
			.card{background-color:white;border-radius:3px;}
			.fixo {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
			}
			input[type="number"] { width:200px; }
			input[type="text"] { width:200px; }
        </style>
	  	<script>
		 	$(function() {
			  
			  	//	update
				$( ".sortable" ).sortable({
			  	    connectWith: ".connectedSortable",
			  	    receive: function( event, ui ) {//	drag
					    $(this).css({"background-color":"CornflowerBlue"});
					    //	pega o id do pai
					    var pai= $(this).closest('div.container').attr("id");
					    console.log(pai);
					    //	prepara os dados para salvar
					    var order = $(this).sortable('toArray');
					    $.ajax({
						    url: "update.php",
						    data: { onde: pai, posicoes: order, act: "sort" },
						    type: 'POST'
						}).success(function(data) {
							//alert('salvo com sucesso');
						}).error(function() {
						    alert('falha ao salvar');
						});
					} ,
					update: function( event, ui ) {//	drag and order
					    $(this).css({"background-color":"CornflowerBlue"});
					    //	pega o id do pai
					    var pai= $(this).closest('div.container').attr("id");
					    console.log(pai);
					    //	prepara os dados para salvar
					    var order = $(this).sortable('toArray');
					    $.ajax({
						    url: "update.php",
						    data: { onde: pai, posicoes: order, act: "sort" },
						    type: 'POST'
					    }).success(function(data) {
						    //alert('salvo com sucesso');
					    }).error(function() {
						    alert('falha ao salvar');
					    });
					}
				}).disableSelection();
				
				//	add
				$('.add-button').click(function() {
					var txtNewItem = $('#new_text').val();
					//$(this).closest('div.container').find('ul').append('<li class="card">'+txtNewItem+'</li>');
					var prioridade= ($(this).closest('div.container').find('ul').length);
					$.ajax({
				   		url: "add.php",
				   		data: { onde: "todo", prioridade: prioridade, titulo: txtNewItem, detalhes: "" },
				   		type: 'POST'
					}).success(function(data) {
				   		//alert('add com sucesso');
						console.log(data);
						var obj = JSON.parse(data);
						var el= $("#"+obj.onde).find('ul');
						var bt_update= create("bt_update", obj.id);
						var bt_exc= create("bt_exc", obj.id);
						var li= create("li", obj.id);
						var text= create("text", obj.titulo);
						var text_separador= create("text", " - ");
						var text_separador2= create("text", " # ");
						
						li.append(bt_update);
						li.append(text_separador);
						li.append(bt_exc);
						li.append(text_separador2);
						li.append(text);
						el.append(li);
						
					}).error(function() {
				   		alert('falha ao salvar');
					});
				});
 
		  	});
		  
		  
			//	cria o elemento Dom
			function create(tipo, data) {
				
				switch(tipo) {
					
					case "bt_update":
						var el = document.createElement('img');
						el.setAttribute('src', 'img/alt.png');
						el.onclick = function() {
														
							$.ajax({
								url: "list.php",
								data: { id: data },
								type: 'POST'
							}).success(function(data) {
								
								var obj = JSON.parse(data);
								$("#id").val(obj[0].id);
								$("#onde").val(obj[0].onde);
								$("#titulo").val(obj[0].titulo);
								$("#prioridade").val(obj[0].prioridade);
								$("#detalhes").val(obj[0].detalhes);
								
							}).error(function() {
								alert('falha no carregamento...');
							});
							
							$("#div_form").show();
						};
						break;
					
					case "bt_exc":
						var el = document.createElement('img');
						el.setAttribute('src', 'img/delete.png');
						el.onclick = function() {
														
							$.ajax({
								url: "exc.php",
								data: { id: data },
								type: 'POST'
							}).success(function(data) {
								var obj = JSON.parse(data);
								console.log(obj);
								console.log("tarefa "+obj.id+" excluída com sucesso!");
								$(el).parent().remove();
							}).error(function() {
								alert('falha no carregamento...');
							});
							
						};
						break;
					
					case "li":
						var el= document.createElement("li");
						el.setAttribute('class', 'card');
						el.setAttribute('id', data);
						break;
					
					case "text":
						var el= document.createTextNode(data);
						break;
				
				}
			    return el;
			}
			
			
		  	//	carrega as tarefas via jSon
			$.getJSON("list.php", function(data) {
				
				for (i = 0; i < data.length; i++) {
					
					var el= $("#"+data[i].onde).find('ul');
					var bt_update= create("bt_update", data[i].id);
					var bt_exc= create("bt_exc", data[i].id);
					var li= create("li", data[i].id);
					var text= create("text", data[i].titulo);
					var text_separador= create("text", " - ");
					var text_separador2= create("text", " # ");
					
					li.append(bt_update);
					li.append(text_separador);
					li.append(bt_exc);
					li.append(text_separador2);
					li.append(text);
					el.append(li);
					
				}
			});
     	</script>      
	</head>
	<body>
    
    	
        <!--	P4	-->
        <div>
        	<h2>Desenvolva  uma  API  Rest  para  um  sistema  gerenciador  de  tarefas(inclusão/alteração/exclusão).</h2>
            <p>As tarefas consistem em título e descrição, ordenadas por prioridade. 
                <br>
                <strong>Desenvolver utilizando:</strong>
                <br>•  Linguagem PHP (ou framework CakePHP); 
                <br>•  Banco de dados MySQL; 
                <br>
                <strong>Diferenciais:</strong>
                <br>•  Criação de interface para visualização da lista de tarefas; 
                <br>•  Interface com drag and drop; 
                <br>•  Interface responsiva (desktop e mobile); 
            </p>
        </div>
        <code>
        	<!--	toDo	-->
            <div class="container" style="background-color:pink;" id="todo">
                <h2>TODO</h2>
                <ul class="sortable connectedSortable"></ul>
                <div class="link-div">
                    <input type="text" id="new_text" value=""/>
                    <input type="button" name="btnAddNew" value="Add" class="add-button"/>
                </div>
            </div>
            
            <!--	inProgress	-->
            <div class="container" style="background-color:orange;" id="inProgress">
                <h2>In Progress</h2>
                <ul class="sortable connectedSortable"></ul>
            </div>
            
            <!--	Test	-->
            <div class="container" style="background-color:yellow;" id="test">
                <h2>Test</h2>
                <ul class="sortable connectedSortable" ></ul>
            </div>
            
            <!--	Done	-->
            <div class="container" style="background-color:green;" id="done">
                <h2>Done</h2>
                <ul class="sortable connectedSortable" ></ul>
            </div>
            
            <!--	Form	-->
            <div class="fixo" style="background-color:DarkKhaki; display:none;" id="div_form">
                <form name="form" action="update.php" enctype="multipart/form-data">
                    <input type="hidden" name="act" id="act" value="update">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="onde" id="onde" value="">
                    <p>
                        Título:<br>
                        <input type="text" name="titulo" id="titulo" value="">
                    </p>
                    <p>
                        Prioridade:<br>
                        <input type="number" name="prioridade" id="prioridade" min="0" step="1" value="">
                    </p>
                    <p>
                        Detalhes:<br>
                        <textarea name="detalhes" id="detalhes" cols="40" rows="4"></textarea>
                    </p>
                     <p>
                        <input type="submit" value="Salvar">
                        <input type="reset" value="Close" onClick='$("#div_form").hide();'>
                    </p>
                </form>
            </div>
        </code>
    
	</body>
</html>