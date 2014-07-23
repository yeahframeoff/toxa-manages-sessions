<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 23.07.14
 * Time: 18:08
 */
?>
<form id="login_form" method="post" action="<?= 'http://'.$_SERVER['HTTP_HOST'].'/index.php'?>">
    <label>
        Login:
        <input type="text" name="user[login]">
    </label>
    <label>
        Password:
        <input type="password" name="user[password]">
    </label>

    <input type="submit" name="login_submit" value="Log In">
</form>