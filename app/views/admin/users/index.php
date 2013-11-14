<h1>Utilisateurs</h1>

<div align="right">
    <a href="<?=URL::route('admin.users.create')?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter un utilisateur</a>
</div>

<hr />

<table width="100%" class="table table-striped">
    <thead>
        <tr>
            <th width="50">ID</th>
            <th>Email</th>
            <th width="175">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item) { ?>
        <tr>
            <td><?=$item->id?></td>
            <td><?=$item->email?></td>
            <td align="right">
                <a href="<?=URL::route('admin.users.destroy',$item->id)?>" class="btn btn-xs btn-danger">Supprimer</a>
                <a href="<?=URL::route('admin.users.edit',$item->id)?>" class="btn btn-xs btn-default">Modifier</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>