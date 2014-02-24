<h1>Pages</h1>

<hr />

<table width="100%" class="table table-striped items">
    <thead>
        <tr>
            <th width="50">ID</th>
            <th>Titre</th>
            <th width="150">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item) { ?>
        <tr>
            <td><?=$item->id?></td>
            <td>
                <a href="<?=URL::route('admin.pages.edit',$item->id)?>">
                    <?=$item->parent ? $item->parent->title_fr.' &gt; ':''?><?=$item->title_fr?>
                </a>
            </td>
            <td align="right">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?=Form::open(array(
                            'route' => array('admin.pages.destroy',$item->id),
                            'method' => 'DELETE',
                            'class'=>'form-horizontal delete'
                        ))?>
                        <a href="#" class="btn btn-xs btn-danger">Supprimer</a>
                        <?=Form::close()?>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <a href="<?=URL::route('admin.pages.edit',$item->id)?>" class="btn btn-xs btn-default">Modifier</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>

        <?php if(!sizeof($items)) { ?>
        <tr>
            <td colspan="4" align="center">Aucune page pour le moment</td>
        </tr>
        <?php } ?>
    </tbody>
</table>