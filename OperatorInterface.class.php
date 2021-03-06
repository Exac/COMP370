<?php
/**
 * Copyright (c) 2016. Farzin Dhanji, Karanvir Gill, Thomas Mclennan.
 */

/**
 * OperatorInterface
 * 
 * @date 10-3-2016
 * @desc 
 */

class OperatorInterface
{
	private $ui;
	private $mm;
	private $pm;

	function __construct()
	{
		$this->ui = new UserInterface();
		$this->mm = new MemberMaintainer();
		$this->pm = new ProviderMaintainer();
	}
	
	public function main ()
	{
		$this->ui->bodyId = "operatorinterface";
		array_push($this->ui->stylesheets, "cdn/css/operator.css");

		$this->ui->add("<h1>ChocAn Data Center Interactive Mode</h1>");
		$this->ui->description = "During the day, the software at the ChocAn Data Center is run" . " in interactive mode to allow operators to add new members to ChocAn, to delete " . "members who have resigned, and to update member records. Similarly, provider records" . " are added, deleted, and updated.";
		if ($this->mm->message)
		{
			$this->ui->message($this->mm->message);
		}
		if ($this->pm->message)
		{
			$this->ui->message($this->pm->message);
		}


		$this->ui->add("<form method='post' action=''>");

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
		/*$this->ui->add("</fieldset>");
		$this->ui->add('<fieldset id="operator">');
		$this->ui->add('<legend>Operator</legend>');
		$this->ui->add("<p>The operator interface is not yet implemented. Question: Did we mix-up Provider and
			Operator (Service and Provider)?</p>");
		$this->ui->add("</fieldset>");*/
		$this->ui->add("\n</form>");
		$this->ui->body .= $this->membersAutoFillScript();
		$this->ui->body .= $this->providersAutoFillScript();
		$this->ui->body .= $this->onload();

		$this->ui->body .= Utils::getNavigationMenu();

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
		$j = "var member_data = new Array();\n";

		$members = DatabaseController::selectMembers();
		foreach ($members as &$p)
		{
			$ltpn = ltrim($p["member_number"], '0');
			$j .= " member_data[${ltpn}] = {};";
			$j .= " member_data[${ltpn}]['member_number'] = '${p['member_number']}';";
			$j .= " member_data[${ltpn}]['member_name'] = '${p['member_name']}';";
			$j .= " member_data[${ltpn}]['member_street_address'] = '${p['member_street_address']}';";
			$j .= " member_data[${ltpn}]['member_city'] = '${p['member_city']}';";
			$j .= " member_data[${ltpn}]['member_province'] = '${p['member_province']}';";
			$j .= " member_data[${ltpn}]['member_postal_code'] = '${p['member_postal_code']}';";
			$j .= " member_data[${ltpn}]['member_email_address'] = '${p['member_email_address']}';";
			$j .= " member_data[${ltpn}]['member_status'] = '${p['member_status']}';";
		}

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
		$j = "var provider_data = new Array();\n";

		$providers = DatabaseController::selectProviders();
		foreach ($providers as &$p)
		{
			$ltpn = ltrim($p["provider_number"], '0');
			$j .= " provider_data[${ltpn}] = {};";
			$j .= " provider_data[${ltpn}]['provider_number'] = '${p['provider_number']}';";
			$j .= " provider_data[${ltpn}]['provider_name'] = '${p['provider_name']}';";
			$j .= " provider_data[${ltpn}]['provider_street_address'] = '${p['provider_street_address']}';";
			$j .= " provider_data[${ltpn}]['provider_city'] = '${p['provider_city']}';";
			$j .= " provider_data[${ltpn}]['provider_province'] = '${p['provider_province']}';";
			$j .= " provider_data[${ltpn}]['provider_postal_code'] = '${p['provider_postal_code']}';";
			$j .= " provider_data[${ltpn}]['provider_email_address'] = '${p['provider_email_address']}';";
			$j .= " provider_data[${ltpn}]['provider_type'] = '${p['provider_type']}';";
		}

		return $j;
	}

	private function membersAutoFillScript()
	{
		$script = "\n<script defer>" . $this->membersJS();
		$script .= <<< EOT
	var member_select = document.getElementById("member_select");
	console.log(member_data);
	member_select.onchange = function () {
		var unpad_num = parseInt(member_select.value, 10);
		document.getElementById("member_number").value = member_data[unpad_num]["member_number"];
		document.getElementById("member_name").value = member_data[unpad_num]["member_name"];
		document.getElementById("member_street_address").value = member_data[unpad_num]["member_street_address"];
		document.getElementById("member_city").value = member_data[unpad_num]["member_city"];
		document.getElementById("member_province").value = member_data[unpad_num]["member_province"];
		document.getElementById("member_postal_code").value = member_data[unpad_num]["member_postal_code"];
		document.getElementById("member_email_address").value = member_data[unpad_num]["member_email_address"];
		document.getElementById("member_status").value = member_data[unpad_num]["member_status"];
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
		var unpad_num = parseInt(provider_select.value, 10);
		document.getElementById("provider_number").value = provider_data[unpad_num]["provider_number"];
		document.getElementById("provider_name").value = provider_data[unpad_num]["provider_name"];
		document.getElementById("provider_street_address").value = provider_data[unpad_num]["provider_street_address"];
		document.getElementById("provider_city").value = provider_data[unpad_num]["provider_city"];
		document.getElementById("provider_province").value = provider_data[unpad_num]["provider_province"];
		document.getElementById("provider_postal_code").value = provider_data[unpad_num]["provider_postal_code"];
		document.getElementById("provider_email_address").value = provider_data[unpad_num]["provider_email_address"];
		document.getElementById("provider_type").value = provider_data[unpad_num]["provider_type"];
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