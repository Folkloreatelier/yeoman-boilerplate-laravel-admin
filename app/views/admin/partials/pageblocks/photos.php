<?php
	
	$fieldName = 'blocks['.(isset($item) ? $index:'<%= index %>').']';

?>

<input type="hidden" name="<?=$fieldName?>[type]" value="photos" />
<input type="hidden" name="<?=$fieldName?>[id]" value="<?=isset($item) ? $item->id:0?>" />

<div class="thumbnail">
	<ul class="nav nav-tabs">
		<li class="disabled">
			<a href="#">
				<span class="label label-default">Bloc #<span class="index"><?=isset($item) ? ($index+1):'<%= index+1 %>'?></span></span>
			</a>
		</li>
		<li class="active">
			<a href="#block<?=isset($item) ? $index:'<%= index %>'?>-fr" data-toggle="tab">Français</a>
		</li>
		<li>
			<a href="#block<?=isset($item) ? $index:'<%= index %>'?>-en" data-toggle="tab">Anglais</a>
		</li>
		<li class="remove">
			<a href="#"><span class="glyphicon glyphicon-remove"></span></a>
		</li>
	</ul>

	<div class="tab-content">
		<?php foreach(Config::get('app.available_locale') as $lang) { ?>

			<div class="tab-pane <?=$lang == 'fr' ? 'active':''?>" id="block<?=isset($item) ? ($index+1):'<%= index %>'?>-<?=$lang?>">

				<div class="form-group">
					<?=Form::label($fieldName.'[data][title_'.$lang.']','Titre:',array('class'=>'control-label'))?>
					<input type="text" name="<?=$fieldName?>[data][title_<?=$lang?>]" value="<?=isset($item->data->{'title_'.$lang}) ? $item->data->{'title_'.$lang}:''?>" class="form-control" />
				</div>

			</div>

		<?php } ?>
	</div>
	<hr/>
	<div class="form-group">
		<?=Form::label($fieldName.'[data][photo]','Photo:',array('class'=>'control-label'))?>
		<div class="block-uploader" data-uploader-inputname="<?=$fieldName?>[photos][]">
			<?php
				if(isset($item) && $item->photos) {
					foreach($item->photos as $photo) {
						echo '<input type="hidden" name="'.$fieldName.'[photos][]" value="'.rawurlencode($photo->toJSON()).'" />';
					}
				}
			?>
		</div>
	</div>
</div>