<?php if(isset($item)) { ?>

<h1>Modifier un utilisateur</h1>

<hr/>

<?=Form::model($item, array('route' => array('admin.users.update',$item->id), 'method' => 'put', 'class'=>'form-horizontal')) ?>

<?php } else { ?>

<h1>Créer un utilisateur</h1>

<hr/>

<?=Form::open(array('route' => 'admin.users.store', 'class'=>'form-horizontal'))?>

<?php } ?>

	<?php if(isset($errors) && $errors->has()) { ?>
	<div class="alert alert-danger">
		Votre formulaire contient des erreurs.
	</div>
	<?php } ?>

	<?php
		$hasError = $errors && $errors->has('email');
	?>
	<div class="form-group <?=$hasError ? 'has-error':''?>">
		<?=Form::label('email','Email:',array('class'=>'col-md-3 control-label'))?>
		<div class="col-md-6">
			<?=Form::text('email',null,array('class'=>'form-control'))?>
			<?=$hasError ? $errors->first('email', '<small class="help-block">:message</small>'):''?>
		</div>
	</div>

	<?php
		$hasError = $errors && $errors->has('password');
	?>
	<div class="form-group <?=$hasError ? 'has-error':''?>">
		<?=Form::label('password','Mot de passe:',array('class'=>'col-md-3 control-label'))?>
		<div class="col-md-6">
			<?=Form::password('password',array('class'=>'form-control'))?>
			<?=$hasError ? $errors->first('password', '<small class="help-block">:message</small>'):''?>
		</div>
	</div>

	<?php
		$hasError = $errors && $errors->has('password_confirmation');
	?>
	<div class="form-group <?=$hasError ? 'has-error':''?>">
		<?=Form::label('password_confirmation','Confirmer le mot de passe:',array('class'=>'col-md-3 control-label'))?>
		<div class="col-md-6">
			<?=Form::password('password_confirmation',array('class'=>'form-control'))?>
			<?=$hasError ? $errors->first('password_confirmation', '<small class="help-block">:message</small>'):''?>
		</div>
	</div>

	<hr />

	<div class="form-group">
		<div class="col-md-6 col-md-offset-3">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?=URL::route('admin.users.index')?>" class="btn btn-default">Annuler</a>
		</div>
	</div>

<?=Form::close()?>