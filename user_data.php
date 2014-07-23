<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 23.07.14
 * Time: 18:38
 */
?>

<div class="row">
    <h2>Login: <?= $user->login ?></h2>
</div>

<div class="row">
    <h2>Password: <?= $user->password?></h2>
</div>

<div class="row">
    <h2>First Name: <?= $user->firstName?></h2>
</div>

<div class="row">
    <h2>Last Name: <?= $user->lastName?></h2>
</div>

<div class="row">
    <h2>Year Of Birth: <?= $user->yearOfBirth?></h2>
</div>

<form method="post" action="<?= 'http://'.$_SERVER['HTTP_HOST'].'/index.php'?>">
    <input type="submit" name="update_submit" value="Update">
    <input type="submit" name="logout_submit" value="Log Out">
</form>