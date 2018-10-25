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
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.php'>Inicio</a></span><br/><br/>
		<?php if(isset($_GET['email'])){?>
		<span><a href='pregunta.php'>Insertar Pregunta</a></span><br/><br/>
		<span><a href='VerPreguntasConFoto.php'>Ver Preguntas</a></span><br/><br/>
	<?php }?>
		<span><a href='creditos.php'>Creditos</a></span>
	</nav>