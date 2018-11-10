<section class="main" id="s1">
	<div>
		<form id='fregistro' name='fregistro' action="Registrar.php"  method="POST" class="formPregunta" enctype="multipart/form-data">
		<fieldset>
   		 <legend>Registro de nuevo usuario:</legend>
   		  <br/>
		  <label for="email">Email:*</label>
		  <input type="text" name="email" id="email" placeholder="Mickey0003@ikasle.ehu.es" value="" class="inputAncho" value="" class="inputAncho"  />
		  <br/><br/>
		  <label for="nombre">Nombre y Apellidos:*</label>
		   <input type="text" name="nombre" id="nombre" value="" class="inputAncho" />
		  <br/><br/>
		  <label for="password">Password:*</label>
		   <input type="password" name="password"  id="password" value="" class="inputAncho"   />
		  <br/><br/>
		  <label for="password2">Introduca de nuevo el password:*</label>
		   <input type="password" name="password2"  id="password2" value="" class="inputAncho"    />
		   <input type="hidden" name="contadorUsuarios"  value="1"     />
		  <br/><br/>
		  <br/>
		   <label for="imgAdd">Foto</label>
		   <input type="file" name="imgAdd"   id="imgAdd" size="60" />
		   <div id="muestraImg"></div>
		  <input type="button" value="Enviar Solicitud" id="enviarRegistro" />
		</fieldset>
		</form>
	</div>
    </section>