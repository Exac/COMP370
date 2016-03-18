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
            Name: <br><input type="text" name="name"><br>
            Street address: <br><input type="text" name="street_address"><br>
            City: <br><input type="text" name="city"><br>
            Province: <br><input type="text" name="province"><br>
            Postal code: <br><input type="text" name="postalCode"><br>
            E-mail: <br><input type="email" name="email"><br>
            Status: <br><input type="checkbox" name="status" value="ACTIVE"> Active<br>
                    <br><input type="checkbox" name="status" value="SUSPENDED"> Suspended<br>
            <button type="submit" id="addMembers">add_member</button>
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
