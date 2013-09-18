<?php if(isset($item)) { ?>

	<h1>Modifier un utilisateur</h1>
	<?=Form::model($item, array('route' => array('admin.users.update',$item->id), 'method' => 'put', 'class'=>'custom')) ?>

<?php } else { ?>

	<h1>Créer un utilisateur</h1>
	<?=Form::open(array('route' => 'admin.users.store', 'class'=>'custom'))?>

<?php } ?>

<div class="row">
	<div class="small-3 columns">
		<?=Form::label('email','Email:',array('class'=>'right inline'))?>
	</div>
	<div class="small-6 pull-3 columns">
		<?=Form::text('email')?>
	</div>
</div>

<div class="row">
	<div class="small-3 columns">
		<?=Form::label('password','Mot de passe:',array('class'=>'right inline'))?>
	</div>
	<div class="small-4 pull-5 columns">
		<?=Form::password('password')?>
	</div>
</div>

<div class="row">
	<div class="small-3 columns">
		<?=Form::label('password_confirmation','Confirmer le mot de passe:',array('class'=>'right inline'))?>
	</div>
	<div class="small-4 pull-5 columns">
		<?=Form::password('password_confirmation')?>
	</div>
</div>

<hr />

<div class="row" align="right">
	<div class="small-12 columns">
		<a href="<?=URL::route('admin.users.index')?>" class="button secondary">Annuler</a>
		<button type="submit">Enregistrer</button>
	</div>
</div>

<?=Form::close()?>