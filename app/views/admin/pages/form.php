<?php if(isset($item)) { ?>

<h1>Modifier une page</h1>

<hr/>

<?=Form::model($item, array('route' => array('admin.pages.update',$item->id), 'method' => 'put', 'class'=>'form-horizontal')) ?>

<?php } else { ?>

<h1>Créer une page</h1>

<hr/>

<?=Form::open(array('route' => 'admin.pages.store', 'class'=>'form-horizontal'))?>

<?php } ?>


	<?php if(isset($errors) && $errors->has()) { ?>
	<div class="alert alert-danger">
		Votre formulaire contient des erreurs.
	</div>
	<?php } ?>

	<?php
		$hasError = $errors && $errors->has('title_fr');
	?>
	<div class="form-group <?=$hasError ? 'has-error':''?>">
		<?=Form::label('title_fr','Titre:',array('class'=>'col-md-2 control-label'))?>
		<div class="col-md-6">
			<?=Form::text('title_fr',null,array('class'=>'form-control'))?>
			<?=$hasError ? $errors->first('title_fr', '<small class="help-block">:message</small>'):''?>
		</div>
	</div>

	<?php
		$hasError = $errors && $errors->has('body_fr');
	?>
	<div class="form-group <?=$hasError ? 'has-error':''?>">
		<?=Form::label('body_fr','Contenu:',array('class'=>'col-md-2 control-label'))?>
		<div class="col-md-10">
			<?=Form::textarea('body_fr',null,array('class' => 'editor'))?>
			<?=$hasError ? $errors->first('body_fr', '<small class="help-block">:message</small>'):''?>
		</div>
	</div>

	<hr />

	<div class="form-group">
		<div class="col-md-6 col-md-offset-2">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?=URL::route('admin.pages.index')?>" class="btn btn-default">Annuler</a>
		</div>
	</div>

<?=Form::close()?>