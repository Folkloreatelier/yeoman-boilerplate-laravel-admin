<h1>Pages</h1>

<div align="right">
    <a href="<?=URL::route('admin.pages.create')?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter une page</a>
</div>

<hr />

<table width="100%" class="table table-striped">
    <thead>
        <tr>
            <th width="50">ID</th>
            <th>Titre</th>
            <th width="100">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item) { ?>
        <tr>
            <td><?=$item->id?></td>
            <td><?=$item->title_fr?></td>
            <td align="right">
                <a href="<?=URL::route('admin.pages.destroy',$item->id)?>" class="btn btn-xs btn-danger">Supprimer</a>
                <a href="<?=URL::route('admin.pages.edit',$item->id)?>" class="btn btn-xs btn-default">Modifier</a>
            </td>
        </tr>
        <?php } ?>

        <?php if(!sizeof($items)) { ?>
        <tr>
            <td colspan="3" align="center">Aucune page pour le moment</td>
        </tr>
        <?php } ?>
    </tbody>
</table>