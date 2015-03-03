<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php"><b>Supervisor</b></a>
		</div>
		<ul class="nav navbar-nav">
			<li><a href="newref.php"><i class="fa fa-plus"></i> Nuevo referido</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					<i class="fa fa-users"></i> Administracion de usuarios<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="adus.php"><i class="fa fa-pencil-square-o"></i> Administrar usuarios</a></li>
					<li><a href="newag.php"><i class="fa fa-user"></i> Nuevo usuario</a></li>
				</ul>
			</li>
			<li><a href="inc/dr.php"><i class="fa fa-bar-chart"></i> Reporte</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="inc/lgo.php"><i class="glyphicon glyphicon-log-out"></i> Cerrar sesión: <b><?php echo $_SESSION['name'] ?></b></a></li>
		</ul>
	</div>
</nav>