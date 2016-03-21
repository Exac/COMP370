<?php
/**
 * OperatorInterface
 * 
 * @date 10-3-2016
 * @desc 
 */

if (isset($_POST["view_members"]))
{
	echo "view_members selected";
}

if (isset($_POST["add_person"]))
{
	echo "add_person pressed";

	$person = $_POST["person"];

	/*
	$name     = $_POST["name"];
	$street   = $_POST["street_address"];
	$city     = $_POST["city"];
	$province = $_POST["province"];
	$postal   = $_POST["postal_code"];
	$email    = $_POST["email"];

	$status = $_POST["status"];

	$type = $_POST["type"]; */

	if ($person == "member")
	{
		echo "member selected";
		$member = new MemberMaintainer();
		$member->addMember($_POST["name"], $_POST["street_address"], $_POST["city"],
			$_POST["province"], $_POST["postal_code"], $_POST["email"], $_POST["status"]);
	}

	else if ($person == "provider")
	{
		echo "provider selected";
		$provider = new ProviderMaintainer();
		$provider->addProvider($_POST["name"], $_POST["street_address"], $_POST["city"],
			$_POST["province"], $_POST["postal_code"], $_POST["email"], $_POST["type"]);
	}
}
class OperatorInterface
{
	private $ui;

	function __construct()
	{
		//process input on members
		$this->ui = new UserInterface();

	}
	
	public function main ()
	{
		$this->ui->bodyId = "operatorinterface";
		array_push($this->ui->stylesheets, "cdn/css/operator.css");
		$this->ui->body .= Utils::getNavigationMenu();
		$this->ui->add("<form method='get' action=''>");

		//MEMBER's fieldset
		$this->ui->add('<fieldset id="member">');
		$this->ui->add('<legend>Member</legend>');
		$this->ui->body .= "\n<!--" . ($GLOBALS['startTime'] - round(microtime(true) * 1000)) . "ms load time-->";
		$this->ui->body .= $this->membersHtml() . "<hr>";
		$this->ui->body .= "\n<!--" . ($GLOBALS['startTime'] - round(microtime(true) * 1000)) . "ms load time-->";
		$this->ui->body .= (new Input("text", "member_name", array("Name", "required")));
		$this->ui->body .= (new Input("text", "member_street_address", "Address"));
		$this->ui->body .= (new Input("text", "member_city", "City"));
		$this->ui->body .= (new Input("text", "member_email_address", "Email"));
		$this->ui->add("<br>");
		$this->ui->body .= (new Input("text", "member_province", array("Province", " class='small'")));
		$this->ui->body .= (new Input("text", "member_postal_code", array("Postal Code", " class='small'")));
		$this->ui->body .= (new Input("text", "member_status", array("Status", " class='small'")));
		$this->ui->body .= (new Input("text", "member_number", array("Member ID", " class='small'")));
		$this->ui->add("<hr>");
		$this->ui->body .= (new Input("submit", "New Member", array("New Member", 'style="filter:hue-rotate(250deg)"'))) . "<br>\n";
		$this->ui->body .= (new Input("submit", "Delete Member", array("Delete Member", 'style="filter:hue-rotate(150deg)"'))) . "<br>\n";
		$this->ui->body .= (new Input("submit", "Update Member", "Update Member"));
		$this->ui->add("</fieldset>");
		//MEMBER's fieldset
		$this->ui->add('<fieldset id="provider">');
		$this->ui->add('<legend>Provider</legend>');
		$this->ui->body .= "\n<!--" . ($GLOBALS['startTime'] - round(microtime(true) * 1000)) . "ms load time-->";
		$this->ui->body .= $this->providersHtml() . "<hr>";
		$this->ui->body .= "\n<!--" . ($GLOBALS['startTime'] - round(microtime(true) * 1000)) . "ms load time-->";
		$this->ui->body .= (new Input("text", "provider_name", array("Name", "required")));
		$this->ui->body .= (new Input("text", "provider_street_address", "Address"));
		$this->ui->body .= (new Input("text", "provider_city", "City"));
		$this->ui->body .= (new Input("text", "provider_email_address", "Email"));
		$this->ui->add("<br>");
		$this->ui->body .= (new Input("text", "provider_province", array("Province", " class='small'")));
		$this->ui->body .= (new Input("text", "provider_postal_code", array("Postal Code", " class='small'")));
		$this->ui->body .= (new Input("text", "provider_type", array("Type", " class='small'")));
		$this->ui->body .= (new Input("text", "provider_number", array("Provider ID", " class='small'")));
		$this->ui->add("<hr>");
		$this->ui->body .= (new Input("submit", "New Provider", array("New Provider", 'style="filter:hue-rotate(250deg)"'))) . "<br>\n";
		$this->ui->body .= (new Input("submit", "Delete Provider", array("Delete Provider", 'style="filter:hue-rotate(150deg)"'))) . "<br>\n";
		$this->ui->body .= (new Input("submit", "Update Provider", "Update Provider"));
		$this->ui->add("</fieldset>");
		$this->ui->add('<fieldset id="operator">');
		$this->ui->add('<legend>Operator</legend>');
		$this->ui->add("<p>The operator interface is not yet implemented. Question: Did we mix-up Provider and
			Operator (Service and Provider)?</p>");
		$this->ui->add("</fieldset>");
		$this->ui->add("\n</form>");
		$this->ui->body .= $this->membersAutoFillScript();
		$this->ui->body .= $this->providersAutoFillScript();
		$this->ui->body .= $this->onload();

		echo $this->ui;
	}

	private function membersHtml()
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

	private function membersJS()
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

	private function providersHtml()
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

	private function providersJS()
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

	private function membersAutoFillScript()
	{
		$script = "\n<script defer>" . $this->membersJS();
		$script .= <<< EOT
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
EOT;

		return $script;
	}

	private function providersAutoFillScript()
	{
		$script = "\n<script defer>" . $this->providersJS();
		$script .= <<< EOT
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
EOT;

		return $script;

	}

	private function onload()
	{
		$s = "<script defer>" . "function listenForLoad(){" . "var mem_sel = document.getElementById('member_select');" . "var pro_sel = document.getElementById('provider_select');" . "/*var ope_sel = document.getElementById('operator_select');*/" . "mem_sel.onchange();    pro_sel.onchange();}" . "window.onload = listenForLoad();" . "</script>";

		return $s;
	}


}

?>