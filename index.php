<?
require_once 'User.php';
$user = User::get();
$user->preSave();

if ($user->isGuest())
{
    if (isset($_POST['reg_submit']) && $_POST['reg_submit'])
    {
        $user->save();
        $user->logIn($_POST['user']['login'], $_POST['user']['password']);
        $contentName = 'startPage';
    }
    if (isset($_POST['login_submit']) && $_POST['login_submit'])
    {
        if ($user->logIn($_POST['user']['login'], $_POST['user']['password']))
            $contentName = 'userPage';
        else
            $contentName = 'startPage';
    }
}
else
{
    if (isset($_POST['saveupdate_submit']) && $_POST['saveupdate_submit'])
    {
        $contentName = 'userPage';
    }
    if (isset($_POST['update_submit']) && $_POST['update_submit'])
    {
        $contentName = 'updatePage';
    }
    if (isset($_POST['logout_submit']) && $_POST['logout_submit'])
    {
        $user->logOut();
        $contentName = 'startPage';
    }
}

if (!isset($_POST['ajax']))
    include 'layout.php';
?>