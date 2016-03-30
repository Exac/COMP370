<table id="provider_bill_preview">
	<tr>
		<td></td>
	</tr>
</table>

<?php

$p = "Alberta";
function setProvince($province)
{
	if (strlen((string)$province) > 2)
	{
		if ($province[0] === "A")
		{
			$province = "AB";
		}
		echo "wew";
	}
	echo "lad";
}

setProvince($p);



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

echo "<hr>";
$zero = 0;
echo is_numeric(0) ? "numeric" : "non-numeric";
echo empty(0) ? "empty" : "non-empty";
if (isset($zero))
{
	echo "set";
} else
{
	echo "not set";
}


$member_keys = array();
$member_data = (new Database())->select("SELECT member_number FROM member");
foreach ($member_data as &$md)
{
	array_push($member_keys, $md["member_number"]);
}
$unique_keys = array_unique($member_keys);
