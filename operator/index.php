<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Operator | Chocoholics Anonymous</title>
</head>

<body id="operator" class="interface">

</body>
    <form id="memberControls" action="" method="post">
        <fieldset>
            <legend>View Members</legend>
            <button type="button" id="viewMembers">view_members</button>
        </fieldset>

        <fieldset>
            <legend>Add Member</legend>
            Name: <br><input type="text" name="member_name"><br>
            Street address: <br><input type="text" name="member_street_address"><br>
            E-mail: <br><input type="text" name="email"><br>
            <button type="submit" id="addMembers">add_members</button>
        </fieldset>
    </form>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/4/16
 * Time: 15:00
 */

require_once(dirname(dirname(__FILE__)) . '/ChocAnSystem.class.php');

new ChocAnSystem("operator");
