<?php
/**
 * @var $user User
 */
?>
<script>
    $(function(){
        $('input').change(function(){
            $.post(
                '<?= 'http://'.$_SERVER['HTTP_HOST'].'/index.php'?>',
                $('#reg_form').serialize() + '&ajax=1'
            );
        });
    });
</script>
<form id="reg_form" method="post" action="<?= 'http://'.$_SERVER['HTTP_HOST'].'/index.php'?>">
    <label>
        Login:
        <input type="text" name="user[login]" value="<?= $user->login ?>">
    </label>
    <label>
        Password:
        <input type="password" name="user[password]" value="<?= $user->password?>">
    </label>

    <label>
        First Name:
        <input type="text" name="user[firstName]" value="<?= $user->firstName?>">
    </label>

    <label>
        Last Name:
        <input type="text" name="user[lastName]" value="<?= $user->lastName?>">
    </label>

    <label>
        Year Of Birth:
        <input type="text" name="user[yearOfBirth]" value="<?= $user->yearOfBirth?>">
    </label>
    <? if ($contentName == 'updatePage'): ?>
    <input type="submit" name="saveupdate_submit" value="Save">
    <? else: ?>
    <input type="submit" name="reg_submit" value="Register">
    <? endif;?>
</form>