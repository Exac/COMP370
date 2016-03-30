<?php
require_once(dirname(dirname(__FILE__)) . '/ChocAnSystem.class.php');
if (!isset($_POST['ajax']))
{
	new ChocAnSystem("provider");
} else
{
	$member = new Member($_POST["preview_member_number"]);
	$provider = new Provider($_POST["preview_provider_number"]);
	$serviceCode = DatabaseController::escape($_POST["preview_service_code"]);
	if (strlen($serviceCode) === 8)
	{
		$serviceCode = str_replace("'", "", $serviceCode);
	}
	$serviceComments = "";
	$serviceComments = $_POST["preview_service_comments"];
	$serviceName = DatabaseController::getServiceName($serviceCode);
	$serviceFee = DatabaseController::getServiceFee($serviceCode) / 100;
	$serviceFee = number_format((float)$serviceFee, 2, '.', '');
	if (!isset($serviceName))
	{
		die();
	}
	$mydate = getdate(date("U"));
	$mydate = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	?>
	<!DOCTYPE html>
	<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>INVOICE</title>
	<meta name="description" content="INVOICE | Chocoholics Anonymous">
	<style>
		@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro|Maven+Pro);

		#claim {
			position: relative;
			font-family: "Maven Pro", sans-serif;
			background: white;
		}

		#claim .company {
			font-size: 1.25em;
		}

		#claim .slogan,
		#claim .foot {
			opacity: 0.666;
		}

		#claim .invoice {
			position: absolute;
			top: 0;
			right: 0;
			font-size: 2em;
			text-transform: uppercase;
		}

		#claim .address {
			padding-left: 0;
			list-style-type: none;
		}

		#claim table {
			width: 100%;
		}

		#claim table:last-of-type td, th {
			border: 1px solid rgba(100, 100, 100, 0.5);
		}

		#claim table td:last-of-type {
			text-align: right;
		}

		#claim table td {
			vertical-align: top;
		}

		#claim table .tall td {
			min-height: 4em;
			line-height: 8em;
		}

	</style>
</head>
<body>
<div style="display:none;"><?php var_dump($serviceName); ?></div>
<div id="claim">
	<strong class="company">Chochoholics Anonymous</strong><br>
	<em class="slogan">First Things First - Chocholate Addictions Services</em><br>
	<strong class="invoice">Invoice</strong>
	<ul class="address">
		<li><?php echo $provider->getStreet(); ?></li>
		<li><?php echo $provider->getCity(); ?>, <?php echo $provider->getProvince(); ?></li>
		<li><?php echo $provider->getPostalCode(); ?></li>
		<li><?php echo $provider->getEmail(); ?></li>
	</ul>
	<table>
		<tr>
			<td>
				<strong>TO:</strong><span><?php echo $member->getName(); ?></span><br>
				<ul class="address">
					<li><?php echo $member->getStreet(); ?></li>
					<li><?php echo $member->getCity(); ?>
						, <?php echo $member->getProvince(); ?></li>
					<li><?php echo $member->getPostalCode(); ?></li>
					<li><?php echo strtolower($member->getEmail()); ?></li>
				</ul>
			</td>
			<td>
				<strong>FOR:</strong><br>
				<span><?php echo $provider->getName(); ?>'s provider services.</span>
			</td>
			<td>
				<span><strong>Invoice #:</strong><?php echo time(); ?></span><br>
				<span><strong>Date:</strong> <?php echo $mydate; ?></span>
			</td>
		</tr>
	</table>
	<table>
		<tr>
			<th>Description</th>
			<th>Code</th>
			<th>Amount</th>
		</tr>
		<tr class="tall">
			<td><?php echo $serviceName; ?> <em><?php echo $serviceComments; ?></em></td>
			<td><?php echo $serviceCode; ?></td>
			<td>$<?php echo $serviceFee; ?></td>
		</tr>
		<tr>
			<td style="border:none;">&nbsp;</td>
			<td style="border:none;">&nbsp;</td>
			<td>$<?php echo $serviceFee; ?></td>
		</tr>
	</table>
	<em class="foot">Make all checks payable to Chochoholics Anonymous.</em><br>
	<em class="foot">Thankyou for your buisness!</em>
</div>

</body>
</html>
<?php
}

