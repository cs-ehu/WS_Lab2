
$(document).ready(function(){

	$("#enviarBoton").click(function(){
		//$(this).hide();
		var email = $("#email").val();
		var enunciado = $("#enunciado").val();
		var correcta = $("#correcta").val();
		var incorrecta1 =$("#incorrecta1").val();
		var incorrecta2 =$("#incorrecta2").val();
		var incorrecta3 =$("#incorrecta3").val();
		var complejidad = parseInt($("#complejidad").val());
		var tema =$("#tema").val();
		/*alert("estamos en on click " + email + " enunciado " + enunciado 
			+ " correcta " + correcta + " incorrecta1 " + incorrecta1 + " incorrecta2 " + incorrecta2 
			+ " incorrecta3 " + incorrecta3 + " complejidad " + complejidad + " tema " + tema);*/
		if(email == "" || enunciado == "" || correcta == "" || incorrecta1 == "" || incorrecta2 == "" || incorrecta3 == ""
			|| complejidad == "" || tema == ""){
			alert("Por favor, introduce todos los campos obligatorios");
		}else{
			var patt1 =/[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus/;
		    var result = email.match(patt1);
		    if(!result) alert("El email ha de ser terminado en tres cifras y @ikasle.ehu.eus");		
		    else{
		    	if(0>complejidad || complejidad>5)
		    		alert("La complejidad ha de ser entre 0 y 5, ambos inclusive");
		    	else{
		    		if(enunciado.length <10)
		    			alert("El enunciado de la pregunta ha de tener 10 caracteres al menos");
		    		else{
		    			$("#fpreguntas").submit();
		    		}

		    	}
		    }

		}

	});

	$("#enviarRegistro").click(function(){
		var email = $("#email").val();
		var nombre = $("#nombre").val();
		var password = $("#password").val();
		var password2 =$("#password2").val();
		if(email == "" || nombre == "" || password == "" || password2 == ""){
			alert("Por favor, introduce todos los campos obligatorios");
		}else{
			var patt1 =/[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus/;
			var patt2 = /[a-zA-Z0-9]*\s{1}[a-zA-Z0-9]*/;
		    var result = email.match(patt1);
		    var nombreApellido = nombre.match(patt2);
		    if(!result) alert("El email ha de ser terminado en tres cifras y @ikasle.ehu.eus");		
		    else if(!nombreApellido)alert("Debes darme el nombre y al menos un apellido, por favor");
		    else if(password.length<8  ) alert("El password ha de tener 8 caracteres como mínimo");
		    else if(password != password2) alert("El password ha de ser el mismo");
		    else $("#fregistro").submit();
		   } 				
	});
});
