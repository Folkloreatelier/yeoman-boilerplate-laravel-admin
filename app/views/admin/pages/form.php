<?php if(isset($item)) { ?>

	<h1>Modifier une page</h1>
	<?=Form::model($item, array('route' => array('admin.pages.update',$item->slug_fr), 'method' => 'put', 'class'=>'custom')) ?>

<?php } else { ?>

	<h1>Créer une page</h1>
	<?=Form::open(array('route' => 'admin.pages.store', 'class'=>'custom'))?>

<?php } ?>

<div class="row">
	<div class="small-12 columns">
		<?=Form::label('title_fr','Titre:')?>
		<?=Form::text('title_fr')?>
	</div>
</div>

<div class="row">
	<div class="small-12 columns">
		<?=Form::label('body_fr','Contenu:')?>
		<?=Form::textarea('body_fr')?>
	</div>
</div>

<hr />

<div class="row" align="right">
	<div class="small-12 columns">
		<a href="<?=URL::route('admin.pages.index')?>" class="button secondary">Annuler</a>
		<button type="submit">Enregistrer</button>
	</div>
</div>

<?=Form::close()?>