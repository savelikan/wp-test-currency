<form action="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies&act=edit&id=<?=$Currency->id?>" method="post">
    <table border="1" cellpadding="5" class="">
        <tr>
            <td><?=__('Name','premmerce-new')?></td>
            <td><input type="text" name="name" value="<?=$Currency->name?>"></td>
        </tr>
        <tr>
            <td><?=__('Symbol','premmerce-new')?></td>
            <td><input type="text" name="symbol" value="<?=$Currency->symbol?>"></td>
        </tr>
        <tr>
            <td><?=__('Rate','premmerce-new')?></td>
            <td><input type="text" name="rate" value="<?=$Currency->rate?>"></td>
        </tr>
    </table>
    <input type="submit" name="update" value="Update">
    [<a href="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies"><?=__('Go back','premmerce-new')?></a>]
</form>