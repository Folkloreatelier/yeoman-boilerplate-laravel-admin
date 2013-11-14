
<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2">

		<h1>Connexion</h1>

		<hr/>

		<?php if (Session::has('error')) { ?>
		    <div class="alert alert-danger"><?=trans(Session::get('reason'))?></div>
		<?php } ?>

		<?=Form::open(array('action' => 'AdminLoginController@postLogin','method'=>'post','class'=>'form-horizontal'))?>

			<div class="form-group">
				<?=Form::label('email','Email:',array('class'=>'col-md-3 control-label'))?>
				<div class="col-md-9">
					<?=Form::text('email',null,array('class'=>'form-control'))?>
				</div>
			</div>

			<div class="form-group">
				<?=Form::label('password','Mot de passe:',array('class'=>'col-md-3 control-label'))?>
				<div class="col-md-9">
					<?=Form::password('password',array('class'=>'form-control'))?>
				</div>
			</div>

			<hr/>

			<div class="form-group">
				<div class="col-md-9 col-md-offset-3">
					<button type="submit" class="btn btn-primary">Connexion</button> 
				</div>
			</div>
			
		<?=Form::close()?>

	</div>
</div>

