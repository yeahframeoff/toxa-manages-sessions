<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 22.07.14
 * Time: 18:02
 *
 * @property $login string
 * @property $password string
 * @property $firstName string
 * @property $lastName string
 * @property $yearOfBirth integer
 */

class User
{

    private $_attrs = [
        'login' => '',
        'password' => '',
        'firstName' => '',
        'lastName' => '',
        'yearOfBirth' => '',
    ];

    private static $_user = null;
    public function __get($name)
    {
        return isset($this->_attrs[$name]) ? $this->_attrs[$name] : '';
    }

    public function __set($name, $value)
    {
        $this->_attrs[$name] = $value;
    }


    private function __construct(){}

    public static function get()
    {
        if (self::$_user === null)
        {
            session_start();
            self::$_user = new User();

            if (isset ($_SESSION['user']))
                self::$_user->_attrs = $_SESSION['user'];
            elseif (isset($_POST['user']))
                self::$_user->_attrs = $_POST['user'];
        }
        return self::$_user;
    }

    public function logIn($login, $password)
    {
        $this->login = $login;

        if (!$this->findAndAssign())
            die('User not found');
        else
            if ($this->password == $password)
            {
                $_SESSION['logged'] = true;
                return true;
            }
            else
                return false;
    }

    public function logOut()
    {
        $_SESSION = [];
        session_destroy();
    }

    public function save()
    {
        if ($this->find())
            $this->update();
        else
            $this->createNew();
    }

    private $_conn = null;

    private function getDbConnection($dyeMessage = null)
    {
        if ($this->$_conn === null)
        {
            $this->$_conn = new mysqli('localhost', 'root', '', 'session_lesson');
            if ($this->$_conn->connect_error)
                die ($dyeMessage === null ?
                    'Connect Error (' . $this->$_conn->connect_errno . ') ' . $this->$_conn->connect_error :
                    $dyeMessage);
        }
        return $this->_conn;
    }

    public function __destruct()
    {
        if ($this->_conn !== null)
            $this->_conn->close();
    }

    private function find($assign = false)
    {
        $login = $this->login;
        $conn = $this->getDbConnection();
        $query = "SELECT * FROM `users` WHERE `login` LIKE '$login' LIMIT 1";
        $conn->query($query);
        if ($conn->error)
            die("Couldn't load data from to database");
        $result = $conn->use_result();
        if ($result->num_rows === 0)
            return false;
        else
        {
            $data = $result->fetch_assoc();
            $attrs = [];
            foreach($data as $key => $value)
                $attrs[self::uscoreToCamel($key)] = $value;

            if ($assign == true)
                $this->_attrs = $attrs;
            return true;
        }
    }

    private function findAndAssign()
    {
        return $this->find(true);
    }

    private function createNew()
    {
        $conn = $this->getDbConnection();
        $query = "INSERT INTO `users` (`login`, `password`, `first_name`, `last_name`, `year_of_birth`)
                  VALUES ('$this->login', '$this->password', '$this->firstName', '$this->lastName', '$this->yearOfBirth');";
        $conn->query($query);
        if ($conn->error)
            die("Couldn't create new user in database");
    }

    private function update()
    {
        $conn = $this->getDbConnection();
        $query = "UPDATE `users`
                     SET
                         `password` = '$this->password',
                         `first_name` = '$this->firstName',
                         `last_name` = '$this->lastName',
                         `year_of_birth` = '$this->yearOfBirth'
                     WHERE `login` = '$this->login'";
        $conn->query($query);
        if ($conn->error)
            die("Couldn't create new user in database");
    }


    public function preSave()
    {
        //session_start();
        $_SESSION['user'] = $this->_attrs;
        //session_commit();
    }

    public function isGuest()
    {
        return !(isset($_SESSION['logged']) && $_SESSION['logged']);
    }

    private static function camelToUscore($camelString)
    {
        $res = '';
        $chars = str_split($camelString);
        foreach ($chars as $sym)
        {
            if (ctype_upper($sym))
                $res .= '_' . strtolower($sym);
            else
                $res .= $sym;
        }
        return $res;
    }

    private static function uscoreToCamel($uscoreString)
    {
        $res = '';
        $chars = str_split($uscoreString);
        foreach ($chars as $sym)
        {
            if ($sym == '_')
                $res .= strtoupper(next($chars));
            else
                $res .= $sym;
        }
        return $res;
    }

}