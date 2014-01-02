<!doctype html>
<!--[if IE ]> <html class="ie" lang="<?=$language?>"> <![endif]-->
<!--[if !(IE) ]><!--> <html lang="<?=$language?>"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="content-language" content="<?=$language?>-ca">

	<title><?=$title?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="/favicon.ico" type="image/x-ico">
	<link rel="icon" href="/favicon.gif" type="image/gif">

	<!-- CSS -->
	<?=Asset::container('head')->styles()?>

	<!-- Head Javascript -->
	<script type="text/javascript">
		var LANGUAGE = "<?=$language?>";
		var WINDOW_LOADED = false;
		var CKEDITOR_BASEPATH = '/js/components/ckeditor/';
	</script>
	<?=Asset::container('head')->scripts()?>

</head>
<body class="<?=str_replace('.','_',$route)?>" onload="WINDOW_LOADED = true;">

	<header id="header">
		<nav class="navbar navbar-default" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<?php if(Auth::check()) { ?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admin-navbar-collapse-1">
					<span class="sr-only">Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<?php } ?>
				<a class="navbar-brand" href="<?=URL::route('admin')?>">Administration</a>
			</div>


			<?php if(Auth::check()) { ?>
			<div class="collapse navbar-collapse" id="admin-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="<?=URL::route('admin.pages.index')?>" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>

						<ul class="dropdown-menu">
							<li><a href="<?=URL::route('admin.pages.edit',array('accueil'))?>">Accueil</a></li>
							<li><a href="<?=URL::route('admin.pages.edit',array('a-propos'))?>">À propos</a></li>
							<li class="divider"></li>
							<li><a href="<?=URL::route('admin.pages.index')?>">Voir toutes les pages →</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="<?=URL::route('admin.users.index')?>" class="dropdown-toggle" data-toggle="dropdown">Utilisateurs <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?=URL::route('admin.users.create')?>">Ajouter un utilisateur</a></li>
							<li class="divider"></li>
							<li><a href="<?=URL::route('admin.users.index')?>">Voir tous les utilisateurs →</a></li>
						</ul>
					</li>
					<li><a href="<?=URL::action('AdminLoginController@getLogout')?>">Déconnexion</a></li>
				</ul>
			</div>
			<?php } ?>
		</nav>
	</header>
	
	<section id="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<?=!isset($content) ? '':$content?>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer javascript -->
	<?=Asset::container('footer')->scripts()?>

</body>
</html>