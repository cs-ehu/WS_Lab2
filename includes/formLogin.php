<section class="main" id="s1">
	<div>
		<form id='flogin' name='flogin' action="Login.php"  method="POST" class="formPregunta" enctype="multipart/form-data">
		<fieldset>
			<?php if(isset($_GET['errorLogIn'])){?>
   		<legend>No existe este usuario. Por favor, regístrese o intente loguearse de nuevo:</legend>
   		<?php }else{?>
   			<legend>LogIn:</legend>
   		<?php }?>
   		  <br/>
		  <label for="email">Email:*</label>
		  <input type="text" name="email" id="email" placeholder="Mickey0003@ikasle.ehu.es" value="<?php if(isset($_GET['errorLogIn'])) echo $_GET['errorEmail'];?>" class="inputAncho" value="" class="inputAncho"  />
		  <br/><br/>
		  <label for="password">Password:*</label>
		   <input type="password" name="password"  id="password" value="" class="inputAncho"   />
		  <br/><br/>
		  <br/>
		  <input type="submit" value="LogIn" id="enviarLogin" />
		</fieldset>
		</form>
	</div>
    </section>