<header class='main' id='h1'>
		<div id="logIn">
			<?php if(isset($_GET['usuario']) && isset($_GET['foto'])){?>
		
<?php echo "<img src='img/".$_GET['foto']."' alt='' width='60' heigth='auto' style='margin-right:10px;'/>" ;   ?>
<span class="right">Bienvenido, <?php echo $_GET['usuario']." | ";?></span>
<span class="right" ><a href="layout.php" onclick="location.href=this.href+'?key=logout';return false;">Logout</a></span>
	<?php }else{?>
<span class="right" id="registro"><a href="Registrar.php">Registrarse</a></span>
<span class="right"><a href="Login.php">Login</a></span>
<?php }?>
      		
      		
       </div>
		<h2 class="titulo">Quiz: el juego de las preguntas</h2>
		<ul style="width: 100%;height: 20px;">
		<li style="float: left;margin-right: 12px;"><a href='layout.php'>Inicio | </a></li>
		<?php if(isset($_GET['email'])){?>
		<li style="float: left;margin-right: 12px;"><a href='pregunta.php'>Insertar Pregunta | </a></li>		
		<li style="float: left;margin-right: 12px;"><a href='VerPreguntasConFoto.php'>Ver Preguntas | </a></li>
		<li style="float: left;margin-right: 12px;"><a href='VerPreguntasXML.php'>Ver Preguntas XML | </a></li>
	<?php }?>
		<li style="float: left;margin-right: 12px;"><a href='creditos.php'>Creditos</a></li>
		</ul>
	
    </header>
	