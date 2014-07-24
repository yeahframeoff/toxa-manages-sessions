<?

function isTrue($var) {return isset($var) && $var == true;}

require_once 'User.php';
$user = User::get();

if ($user->isGuest())
{
    $contentName = 'startPage';
    $user->preSave();

    if (isTrue($_POST['login_submit']))
    {
        if ($user->logIn($_POST['user']['login'], $_POST['user']['password']))
            $contentName = 'userPage';
        else
            $contentName = 'startPageWrongPassword';
    }

    if (isTrue($_POST['ajax']))
        $user->set($_POST['user']);

    if (isTrue($_POST['reg_submit']))
    {
        $user->set($_POST['user']);
        $user->save();
        $user->logIn($_POST['user']['login'], $_POST['user']['password']);

        $contentName = 'userPage';
    }
}
else
{
    if (isTrue($_POST['saveupdate_submit']))
    {
        $user->set($_POST['user']);
        $user->save();
        $contentName = 'userPage';
    }
    if (isTrue($_POST['update_submit']))
    {
        $contentName = 'updatePage';
    }
    if (isTrue($_POST['logout_submit']))
    {
        $user->logOut();
        $contentName = 'startPage';
    }
    if (isTrue($_POST['ajax']))
    {
        $user->set($_POST['user']);
    }
}

if (!isTrue($_POST['ajax']))
    include 'layout.php';
?>