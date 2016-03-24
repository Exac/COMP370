<?php
echo __DIR__ . "<br>" . $_SERVER["SERVER_ADDR"] . "<br>";
$aaa = new mysqli("caxe.thomasmclennan.ca", "COMP370", "SoftwareEngineering370!", "COMP370");


echo extension_loaded('mysqli') ? "LOADED" : "NOT LOADED";
echo "<br>";

if (!function_exists('mysqli_init') && !extension_loaded('mysqli'))
{
	echo 'We don\'t have mysqli!!!';
} else
{
	echo 'Phew we have it!';
}

require_once("Database.class.php");
require_once("DatabaseController.class.php");
require_once("Utils.class.php");
require_once("Member.class.php");
require_once("Person.class.php");

function getLength($object)
{
	return strlen((string)$object);
}

$md = DatabaseController::selectMember(1);
echo $md["member_postal_code"] . "<br>";
$num = $md["member_number"];
echo $num . "<br>";
echo getLength($num) . "<br>";;
if (is_int($num))
{
	echo "INT<br>";
} else
{
	echo "NOT INT<br>";
}
if (is_numeric($num))
{
	echo "NUMERIC<br>";
} else
{
	echo "NOT NUMERIC<br>";
}

$p = new Person();
$p->setNumber($num);
echo "Person Created.<br>";
$a = 123456;
if (isset($a))
{
	echo "123456";
}
$b = 789012;
if (empty($b))
{
	echo "789012";
}

$m = new Member("000000001");
echo "<br>" . $m->getNumber() . "<br>";

if (is_numeric((new Database())->escape("000000001")))
{
	echo "numeric<br>";
} else
{
	echo "non-numeric<br>";
}

#Test toString and fromString in Member and Provider
$mt = new Member();
echo $mt . "<br>";
echo $mt->getNumber() . "<br>";
$mt100 = new Member(100);
echo $mt100 . "<br>";

$mt->fromJSON($mt100);
echo $mt . "<br>";
echo $mt100 . "<br>";

$pt = new Person();
echo $pt->pad(100);

/*function membersHtml()
{
	$o = "<select name='member_select' id='member_select'>";
	$members = DatabaseController::selectMemberNames();
	foreach ($members as &$member)
	{
		$o .= "<option value='${member['member_number']}'>${member['member_name']}</option>";
	}
	$o .= "</select>";

	return $o;
}

function membersJS()
{
	$j = "var member_data = [";

	$members = DatabaseController::selectMembers();
	foreach ($members as &$m)
	{
		$j .= "{'member_number':${m['member_number']}, " . "'member_name':'${m['member_name']}', " . "'member_street_address':'${m['member_street_address']}', " . "'member_city':'${m['member_city']}', " . "'member_province':'${m['member_province']}', " . "'member_postal_code':'${m['member_postal_code']}', " . "'member_email_address':'${m['member_email_address']}', " . "'member_status':'${m['member_status']}', ";
		$j .= "}, ";
	}

	$j .= "];";

	return $j;
}

function providersHtml()
{
	$o = "<select name='provider_select' id='provider_select'>";
	$providers = DatabaseController::selectProviderNames();
	foreach ($providers as &$provider)
	{
		$o .= "<option value='${provider['provider_number']}'>${provider['provider_name']}</option>";
	}
	$o .= "</select>";

	return $o;
}

function providersJS()
{
	$j = "var provider_data = [";

	$providers = DatabaseController::selectProviders();
	foreach ($providers as &$p)
	{
		$j .= "{'provider_number':${p['provider_number']}, " . "'provider_name':'${p['provider_name']}', " . "'provider_street_address':'${p['provider_street_address']}', " . "'provider_city':'${p['provider_city']}', " . "'provider_province':'${p['provider_province']}', " . "'provider_postal_code':'${p['provider_postal_code']}', " . "'provider_email_address':'${p['provider_email_address']}', " . "'provider_type':'${p['provider_type']}', ";
		$j .= "}, ";
	}

	$j .= "];";

	return $j;
}

?>

<!doctype html>

<html lang='en'>

<head>
	<meta charset='utf-8'>
	<title>Chocoholics Anonymous</title>
	<meta name='author' content='Farzin, Navi and Thomas'>
	<link rel='stylesheet' href='cdn/css/interface.css'>
	<link rel='stylesheet' href='cdn/css/operator.css'>
</head>
<body id='operatorinterface' class='interface '>

<form method="get" action="">
	<fieldset id="member">
		<legend>Member</legend>
		<?php echo membersHtml(); ?>
		<hr>
		<?php echo (new Input("text", "member_number", "Member ID")); ?>
		<?php echo (new Input("text", "member_name", array("Name", "required"))); ?>
		<?php echo (new Input("text", "member_street_address", "Address")); ?>
		<?php echo (new Input("text", "member_city", "City")); ?>
		<?php echo (new Input("text", "member_province", "Province")); ?>
		<?php echo (new Input("text", "member_postal_code", "Postal Code")); ?>
		<?php echo (new Input("text", "member_email_address", "Email")); ?>
		<?php echo (new Input("text", "member_status", "Status")); ?>
		<hr>
		<button type="submit" id="new" name="member_new" style="filter:hue-rotate(250deg)">New
			Member
		</button>
		<button type="submit" id="delete" name="member_delete" style="filter:hue-rotate(150deg)">
			Delete Member
		</button>
		<button type="submit" id="update" name="member_update">Update Member</button>
	</fieldset>
	<fieldset id="provider">
		<legend>Provider</legend>
		<?php echo providersHtml(); ?>
		<hr>
		<?php echo (new Input("text", "provider_number", "Provider ID")); ?>
		<?php echo (new Input("text", "provider_name", array("Name", "required"))); ?>
		<?php echo (new Input("text", "provider_street_address", "Address")); ?>
		<?php echo (new Input("text", "provider_city", "City")); ?>
		<?php echo (new Input("text", "provider_province", "Province")); ?>
		<?php echo (new Input("text", "provider_postal_code", "Postal Code")); ?>
		<?php echo (new Input("text", "provider_email_address", "Email")); ?>
		<?php echo (new Input("text", "provider_type", "Status")); ?>
		<hr>
		<button type="submit" id="new" name="provider_new" style="filter:hue-rotate(250deg)">New
			Provider
		</button>
		<button type="submit" id="delete" name="provider_delete" style="filter:hue-rotate(150deg)">
			Delete Provider
		</button>
		<button type="submit" id="update" name="provider_update">Update Provider</button>
	</fieldset>
	<fieldset id="operator">
		<legend>Operator</legend>
		<p>The operator interface is not yet implemented. Question: Did we mix-up Provider and
			Operator (Service and Provider)?</p>
		?>
	</fieldset>
</form>
<script defer>
	<?php echo membersJS()."\n"; ?>
	var member_select = document.getElementById("member_select");
	console.log(member_data);
	member_select.onchange = function () {
		document.getElementById("member_number").value = member_data[member_select.value - 1]["member_number"];
		document.getElementById("member_name").value = member_data[member_select.value - 1]["member_name"];
		document.getElementById("member_street_address").value = member_data[member_select.value - 1]["member_street_address"];
		document.getElementById("member_city").value = member_data[member_select.value - 1]["member_city"];
		document.getElementById("member_province").value = member_data[member_select.value - 1]["member_province"];
		document.getElementById("member_postal_code").value = member_data[member_select.value - 1]["member_postal_code"];
		document.getElementById("member_email_address").value = member_data[member_select.value - 1]["member_email_address"];
		document.getElementById("member_status").value = member_data[member_select.value - 1]["member_status"];
	};
	document.onload = function () {
		member_select.onchange();
	}
</script>
<script defer>
	<?php echo providersJS()."\n"; ?>
	var provider_select = document.getElementById("provider_select");
	console.log(provider_data);
	provider_select.onchange = function () {
		document.getElementById("provider_number").value = provider_data[provider_select.value - 1]["provider_number"];
		document.getElementById("provider_name").value = provider_data[provider_select.value - 1]["provider_name"];
		document.getElementById("provider_street_address").value = provider_data[provider_select.value - 1]["provider_street_address"];
		document.getElementById("provider_city").value = provider_data[provider_select.value - 1]["provider_city"];
		document.getElementById("provider_province").value = provider_data[provider_select.value - 1]["provider_province"];
		document.getElementById("provider_postal_code").value = provider_data[provider_select.value - 1]["provider_postal_code"];
		document.getElementById("provider_email_address").value = provider_data[provider_select.value - 1]["provider_email_address"];
		document.getElementById("provider_type").value = provider_data[provider_select.value - 1]["provider_type"];
	};
	document.onload = function () {
		provider_select.onchange();
	}
</script>
<script src='/cdn/js/scripts.js' defer></script>
</body>
</html>*/