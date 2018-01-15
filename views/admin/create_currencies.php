<form action="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies&act=create" method="post">
    <table border="1" cellpadding="5" class="">
        <tr>
            <td><?=__('Name','premmerce-new')?></td>
            <td><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <td><?=__('Symbol','premmerce-new')?></td>
            <td><input type="text" name="symbol" value=""></td>
        </tr>
        <tr>
            <td><?=__('Rate','premmerce-new')?></td>
            <td><input type="text" name="rate" value=""></td>
        </tr>
    </table>
    <input type="submit" name="save" value="Save">
    [<a href="<?=get_site_url()?>/wp-admin/admin.php?page=edit-currencies"><?=__('Go back','premmerce-new')?></a>]
</form>