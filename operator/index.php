<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>Operator | Chocoholics Anonymous</title>
</head>

<body id="operator" class="interface">

</body>
<form id="memberControls" action="../OperatorInterface.class.php" method="POST">
    <fieldset>
        <legend>View Members</legend>
        <label>click_to_view_members</label>
        <button type="button" id="viewMembers">view_members</button>
    </fieldset>

    <fieldset>
        <legend>New Person</legend>

        <input type="radio" name="person" value="member">Member
        <input type="radio" name="person" value="provider">Provider<br><br>

        Name:           <br><input type="text"  name="name"><br>
        Street address: <br><input type="text"  name="street_address"><br>
        City:           <br><input type="text"  name="city"><br>
        Province:       <br><input type="text"  name="province"><br>
        Postal code:    <br><input type="text"  name="postalCode"><br>
        E-mail:         <br><input type="email" name="email"><br><br>
        Member Status:  <br><input type="radio" name="status" value="ACTIVE"> Active
                        <br><input type="radio" name="status" value="SUSPENDED"> Suspended
                        <br><br>

        Provider Type:  <br><input type="radio" name="type" value="DIETITIAN"> Dietitian
                        <br><input type="radio" name="type" value="INTERNIST"> Internist
                        <br><input type="radio" name="type" value="EXERCISE_EXPERT"> Exercise expert
                        <br><br>

        <button type="submit" id="addPerson">add_person</button>
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