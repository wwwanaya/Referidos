<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php"><b>Agente</b></a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="newref.php"><i class="fa fa-plus"></i> Nuevo referido</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="inc/lgo.php"><i class="glyphicon glyphicon-log-out"></i> Cerrar sesión: <b><?php echo $_SESSION['name'] ?></b></a></li>
		</ul>
	</div>
</nav>