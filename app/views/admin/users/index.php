<h1>Utilisateurs</h1>

<div align="right">
    <a href="<?=URL::route('admin.users.create')?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter un utilisateur</a>
</div>

<hr />

<table width="100%" class="table table-striped items">
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
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?=Form::open(array(
                            'route' => array('admin.users.destroy',$item->id),
                            'method' => 'DELETE',
                            'class'=>'form-horizontal delete'
                        ))?>
                        <a href="#" class="btn btn-xs btn-danger">Supprimer</a>
                        <?=Form::close()?>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <a href="<?=URL::route('admin.users.edit',$item->id)?>" class="btn btn-xs btn-default">Modifier</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>