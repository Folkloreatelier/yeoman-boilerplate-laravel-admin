<?php
	
	$fieldName = 'blocks['.(isset($item) ? $index:'<%= index %>').']';

?>

<input type="hidden" name="<?=$fieldName?>[type]" value="text" />
<input type="hidden" name="<?=$fieldName?>[id]" value="<?=isset($item) ? $item->id:0?>" />

<div class="thumbnail">
	<ul class="nav nav-tabs">
		<li class="disabled">
			<a href="#">
				<span class="label label-default">Bloc #<span class="index"><?=isset($item) ? ($index+1):'<%= index+1 %>'?></span></span>
			</a>
		</li>
		<?php foreach(Config::get('app.available_locale') as $lang) { ?>
		<li class="<?=$lang == $language ? 'active':''?>">
			<a href="#block<?=isset($item) ? $index:'<%= index %>'?>-<?=$lang?>" data-toggle="tab"><?=strtoupper($lang)?></a>
		</li>
		<?php } ?>
		<li class="remove">
			<a href="#"><span class="glyphicon glyphicon-remove"></span></a>
		</li>
	</ul>

	<div class="tab-content">
		<?php foreach(Config::get('app.available_locale') as $lang) { ?>

			<div class="tab-pane <?=$lang == $language ? 'active':''?>" id="block<?=isset($item) ? $index:'<%= index %>'?>-<?=$lang?>">

				<div class="form-group">
					<?=Form::label($fieldName.'[title_'.$lang.']','Titre:',array('class'=>'control-label'))?>
					<input type="text" name="<?=$fieldName?>[data][title_<?=$lang?>]" value="<?=isset($item->data->{'title_'.$lang}) ? $item->data->{'title_'.$lang}:''?>" class="form-control" />
				</div>

				<div class="form-group">
					<?=Form::label($fieldName.'[body_'.$lang.']','Contenu:',array('class'=>'control-label'))?>
					<textarea name="<?=$fieldName?>[data][body_<?=$lang?>]" class="editor form-control" rows="5" data-editor-height="200" data-editor-toolbar="Simple"><?=isset($item->data->{'body_'.$lang}) ? $item->data->{'body_'.$lang}:''?></textarea>
				</div>

			</div>

		<?php } ?>
	</div>
</div>