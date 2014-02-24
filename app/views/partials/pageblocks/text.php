<div class="block">
	<h4 class="title"><?=isset($item->data->{'title_'.$language}) ? $item->data->{'title_'.$language}:''?></h4>
	<div class="body">
		<?=isset($item->data->{'body_'.$language}) ? $item->data->{'body_'.$language}:''?>
	</div>
</div>