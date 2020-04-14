<?php include('global_init.php'); ?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="HTML,CSS,JavaScript,PHP">
  <meta name="author" content="">
  <link rel="shortcut icon" type="image/png" href="static/img/logo_sm.png"/>
  <?php startblock('head') ?><?php endblock() ?>

  <!-- Bootstrap core CSS -->
  <link href="static/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  

  <!-- Custom styles for this template -->
  <link href="static/css/agency.min.css" rel="stylesheet">
  <!-- Custom styles-->
  <link href="static/css/custom.css" rel="stylesheet">
</head>

<body id="page-top">
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
			<a class="navbar-brand js-scroll-trigger" href="index.php">
				<img src="static/img/logo_sm_w_no_whitespace.png" style="height: 5vh;">
			</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
				aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-title="O NEI">O NEI<span class="u-down-arrow"></span></a>
						<ul class="dropdown-menu resize">
							<li><a href="index.php#about">
									História
								</a></li>
							<li><a href="index.php#team">
									Equipa
								</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" aria-title="Posts" href="posts.php">
									Artigos
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" aria-title="Calendário" href="calendar.php">Calendário</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" aria-title="Apontamentos" href="ealuno.php">Apontamentos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" aria-title="Merchandising" href="merchandising.php">Merchandising</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" aria-title="Parceiros" href="parceiros.php">Parceiros</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" aria-title="Mesa RGM" data-toggle="dropdown">Mesa RGM<span
								class="u-down-arrow"></span></a>
						<ul class="dropdown-menu resize">
							<li><a href="PAO.php">
									Plano de Atividades e Orçamentos
								</a></li>
							<li><a href="RAC.php">
									Relatório de Atividades e Contas
								</a></li>
							<li><a href="atas.php">
									Atas
								</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" aria-title="Faina" data-toggle="dropdown">Faina<span
								class="u-down-arrow"></span></a>
						<ul class="dropdown-menu resize">
							<li><a href="faina.php">Publicações</a></li>
                            <?php if(isset($_SESSION['uaccess']) && $_SESSION['uaccess']>=400) : ?>
                                <li>
                                    <a href="adm_faina.php">
                                        Gerir publicações
                                    </a>
                                </li>
                            <?php endif; ?>
							<li><a href="https://nei.web.ua.pt/upload/faina/CodigoFaina.pdf" target="_blank">Código de Faina</a></li>
						</ul>
					</li>
					
					
					<?php if(isset($_SESSION['valid']) && isset($_SESSION['uname'])) : ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" aria-title="username" data-toggle="dropdown"><?php echo utf8_encode($_SESSION['uname']); ?><span
								class="u-down-arrow"></span></a>
						<ul class="dropdown-menu resize">
							<?php if(isset($_SESSION['uaccess']) && $_SESSION['uaccess']>=500) : ?>
							<li>
								<a href="adm_posts.php">
									Administração
								</a>
							</li>
							<li>
							</li>
							<li>
								<a href="change_password.php">
									Reset passwords
								</a>
							</li>
							<?php endif; ?>
							<li>
								<a href="usercpass.php">
									Mudar Password
								</a>
							</li>
							<li>
								<a href="logout.php">
									LogOut
								</a>
							</li>
						</ul>
					</li>
					<?php else : ?>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" aria-title="Login" href="login.php">Login</a>
					</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>
	
	<?php startblock('body') ?><?php endblock() ?>
	
	<!-- Bootstrap core JavaScript -->
	<script src="static/js/jquery.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
	<script src="static/js/popper.min.js"></script>

	<!-- Base Template JS-->
	<script src="static/js/agency.js"></script>

	<!-- Custom JS -->
	<?php startblock('custom_js') ?><?php endblock() ?>
</body>
</html>
