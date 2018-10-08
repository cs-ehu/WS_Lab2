
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
		
		var patt1 =/[a-zA-Z0-9]*[0-9]{3}@ikasle.ehu.eus/;
	    var result = email.match(patt1);
	    if(!result) alert("El email ha de ser terminado en tres cifras y @ikasle.ehu.eus");		
	    else{
	    	if(0>complejidad || complejidad>5)
	    		alert("La complejidad ha de ser entre 0 y 5, ambos inclusive");
	    	else{
	    		if(enunciado.length <10)alert("El enunciado de la pregunta ha de tener 10 caracteres al menos");

	    	}
	    }

		

	});
});
