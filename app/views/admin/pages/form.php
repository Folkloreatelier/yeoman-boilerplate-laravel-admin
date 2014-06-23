<?php if(isset($item)) { ?>

<h1>Modifier une page</h1>

<?=Form::model($item, array('route' => array('admin.pages.update',$item->id), 'method' => 'put')) ?>

<?php } else { ?>

<h1>Créer une page</h1>

<?=Form::open(array('route' => 'admin.pages.store'))?>

<?php } ?>


	<?php if(isset($errors) && $errors->has()) { ?>
	<div class="alert alert-danger">
		Votre formulaire contient des erreurs.
	</div>
	<?php } ?>


	<fieldset>

		<legend>Contenu principal</legend>

		<div class="nav-tabs-locale">

			<ul class="nav nav-tabs">
				<?php foreach(Config::get('app.locale_available') as $lang) { ?>
				<li class="<?=$lang == Config::get('app.locale') ? 'active':''?>">
					<a href="#<?=$lang?>" data-toggle="tab"><?=strtoupper($lang)?></a>
				</li>
				<?php } ?>
			</ul>

			<div class="tab-content">
				<?php foreach(Config::get('app.locale_available') as $lang) { ?>

					<div class="tab-pane <?=$lang == $locale ? 'active':''?>" id="<?=$lang?>">
						<?php
							$hasError = $errors && $errors->has('title_'.$lang);
						?>
						<div class="form-group <?=$hasError ? 'has-error':''?>">
							<?=Form::label('title_'.$lang,'Titre:',array('class'=>'control-label'))?>
							<?=Form::text('title_'.$lang,null,array('class'=>'form-control'))?>
							<?=$hasError ? $errors->first('title_'.$lang, '<small class="help-block">:message</small>'):''?>
						</div>

						<?php
							$hasError = $errors && $errors->has('body_'.$lang);
						?>
						<div class="form-group <?=$hasError ? 'has-error':''?>">
							<?=Form::label('body_'.$lang,'Contenu:',array('class'=>'control-label'))?>
							<?=Form::textarea('body_'.$lang,null,array('class' => 'editor', 'data-editor-height' => 400))?>
							<?=$hasError ? $errors->first('body_'.$lang, '<small class="help-block">:message</small>'):''?>
						</div>
					</div>

				<?php } ?>
			</div>

		</div>

	</fieldset>

	<fieldset class="blocks">

		<legend>Blocs de contenu</legend>

		<div class="row">
			<div class="col-sm-12" align="right">

				<div class="btn-group add" align="left">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						Ajouter un bloc <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<?php foreach(PageBlock::$types as $key => $label) { ?>
						<li><a href="#" data-block-type="<?=$key?>"><?=trans($label)?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="list row">
		<?php

			$hasBlocks = false;

			$blocks = array();

			if(Input::old('blocks') && sizeof(Input::old('blocks'))) {
				$i = 0;
				foreach(Input::old('blocks') as $block) {
					$blockModel = new PageBlock();
					$blockModel->fill($block);
					$blockModel->order = $i;
					$blocks[] = $blockModel;
					$i++;
				}
			} else if(isset($item) && $item->blocks && sizeof($item->blocks)) {
				$blocks = $item->blocks;
				$hasBlocks = true;
			}

			foreach($blocks as $block) {
				echo '<div class="block block-'.$block->type.' col-sm-12 col-md-12" data-block-type="'.$block->type.'">';
				echo View::make('admin.partials.pageblocks.'.$block->type,array(
					'item' => $block,
					'index' => $block->order
				));
				echo '</div>';
			}

		?>
		</div>
		<div class="noblock" <?=$hasBlocks ? 'style="display:none;"':''?>>Aucun bloc pour le moment.</div>

		<?php foreach(PageBlock::$types as $key => $label) { ?>
		<script type="text/x-template" class="template" data-block-type="<?=$key?>"><?php

			echo View::make('admin.partials.pageblocks.'.$key);

		?></script>
		<?php } ?>


	</fieldset>

	<fieldset>

		<legend>Photos</legend>

		<div class="row">
			<div class="col-md-12">
				<div class="uploader" data-uploader-inputname="photos[]"><?php

					if(isset($item) && $item->photos) {
						foreach($item->photos as $photo) {
							echo '<input type="hidden" name="photos[]" value="'.rawurlencode($photo->toJSON()).'" />';
						}
					}

				?></div>
			</div>

		</div>

	</fieldset>



	<fieldset>

		<legend>Paramètres de la page</legend>

		<?php
			$hasError = $errors && $errors->has('parent_id');
		?>
		<div class="row">
			<div class="form-group <?=$hasError ? 'has-error':''?> col-md-6">
				<?=Form::label('parent_id','Page parente:',array('class'=>'control-label'))?>
				<?=Form::select('parent_id',$parentPagesOptions,null,array('class'=>'form-control'))?>
				<?=$hasError ? $errors->first('parent_id', '<small class="help-block">:message</small>'):''?>
			</div>
		</div>

	</fieldset>

	<hr />

	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?=URL::route('admin.pages.index')?>" class="btn btn-default">Annuler</a>
		</div>
	</div>

<?=Form::close()?>
