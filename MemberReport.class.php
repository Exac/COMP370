<?php
/**
 * MemberReport
 * 
 * @date 10-3-2016
 * @desc Extends DateRangeReport.
 */
class MemberReport extends DateRangeReport
{
	private $detailCount = 0;
	private $table = "<table class='report'>";
	
	function __construct()
	{
		$this->table .= "<tr><th>Member Number</th><th>Name</th><th>Address</th><th>Email</th><th>Status</th></tr>";
		$members = DatabaseController::getAllMembers();
		foreach ($members as $m)
		{
			$this->table .= "\n\t<tr><td>${m['member_number']}</td>";
			$this->table .= "\n\t<td>${m['member_name']}</td>";
			$this->table .= "\n\t<td>${m['member_street_address']}, ${m['member_city']}, ${m['member_province']}, ${m['member_postal_code']}</td>";
			$this->table .= "\n\t<td>${m['member_email_address']}</td>";
			$this->table .= "\n\t<td>${m['member_status']}</td></tr>";
		}
	}
	
	public function addDetail ()
	{
		
	}
	
	public function getDetailCount ()
	{
		
	}

	public function __toString()
	{
		return $this->table . "</table>";
	}
}