<table border="1" cellpadding="5" class="">
    <tr>
        <th><?=__('Id','premmerce-new')?></th>
        <th><?=__('Name','premmerce-new')?></th>
        <th><?=__('Symbol','premmerce-new')?></th>
        <th><?=__('Rate','premmerce-new')?></th>
        <th><?=__('Options','premmerce-new')?></th>
    </tr>
    <?php foreach($CurrenciesList as $row): ?>
        <tr>
            <td><?=$row->id?></td>
            <td><?=$row->name?></td>
            <td><?=$row->symbol?></td>
            <td><?=$row->rate?></td>
            <td>
                [<a href="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies&act=edit&id=<?=$row->id?>"><?=__('EDIT','premmerce-new')?></a>]
                <br>
                [<a href="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies&act=delete&id=<?=$row->id?>"><?=__('DEL','premmerce-new')?></a>]
            </td>
        </tr>
    <?php endforeach; ?>
</table>
[<a href="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies&act=create"><?=__('Create new','premmerce-new')?></a>]