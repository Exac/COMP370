<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Operator | Chocoholics Anonymous</title>
</head>

<body id="operator" class="interface">

</body>
<form id="memberControls" action="/ProviderMaintainer.class.php" method="post">
    <fieldset>
        <legend>View Members</legend>
        <button type="button" id="viewMembers">view_members</button>
    </fieldset>

    <fieldset>
        <legend>Add Member</legend>
        Name:           <br><input type="text"  name="name"><br>
        Street address: <br><input type="text"  name="street_address"><br>
        City:           <br><input type="text"  name="city"><br>
        Province:       <br><input type="text"  name="province"><br>
        Postal code:    <br><input type="text"  name="postalCode"><br>
        E-mail:         <br><input type="email" name="email"><br>
        Status:         <br><input type="radio" name="status" value="ACTIVE"> Active
                        <br><input type="radio" name="status" value="SUSPENDED"> Suspended
                        <br><br>

        <button type="submit" id="addMember">add_member</button>
    </fieldset>
</form>

<form id="providerControls" action="/ProviderMaintainer.class.php" method="post">
    <fieldset>
        <legend>View Providers</legend>
        <button type="button" id="viewMembers">view_members</button>
    </fieldset>

    <fieldset>
        <legend>Add Provider</legend>
        Name:           <br><input type="text"  name="name"><br>
        Street address: <br><input type="text"  name="street_address"><br>
        City:           <br><input type="text"  name="city"><br>
        Province:       <br><input type="text"  name="province"><br>
        Postal code:    <br><input type="text"  name="postalCode"><br>
        E-mail:         <br><input type="email" name="email"><br>
        Type:           <br><input type="radio" name="type" value="DIETITIAN"> Dietitian
                        <br><input type="radio" name="type" value="INTERNIST"> Internist
                        <br><input type="radio" name="type" value="EXERCISE_EXPERT"> Exercise expert
                        <br><br>

        <button type="submit" id="addProvider">add_member</button>
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
