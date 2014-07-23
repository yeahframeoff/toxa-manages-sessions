<?php
/**
 * Created by PhpStorm.
 * User: Антон
 * Date: 22.07.14
 * Time: 18:14
 * @var $contentName string
 */

?>
<html>
<head>
    <title>Managing sessions</title>
    <script src="jquery-1.11.1.min.js"></script>
    <style>

        body {
            margin:0;
            font-family:'Segoe UI', sans-serif;
            text-align:center;
            color: #999;
        }

        #content {
            width: 1024px;
            height: 600px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -512px;
            margin-top: -300px;
        }

        a, a:visited {
            text-decoration:none;
        }

        label {
            margin: 16px 0 0 0;
            display: block;
        }

        h1 {
            text-align: center;
        }

        label, input, h1
        {
            font-size: 24px;
        }
    </style>
</head>
<body>
<div id="content">
    <? if ($contentName == 'startPage'): ?>
    <h1>Log In</h1>
    <? include 'login_form.php';?>
    <h1>or Register</h1>
    <? include 'reg_form.php'; ?>

    <? elseif ($contentName == 'updatePage'): ?>
    <h1>Update</h1>
    <? include 'reg_form.php'; ?>

    <? else: //$contentName == 'viewPage'): ?>
    <h1>User <i><?= $user->login?></i></h1>
    <? include 'user_data.php'; ?>
    <?endif;?>
</div>
</body>
</html>