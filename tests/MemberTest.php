<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/23/16
 * Time: 17:36
 */

/**
 * Imports
 */
require_once(__DIR__ . '/../phpunit-5.2.12.phar');
//include_once(__DIR__ . '\..\AccountsPayableReport.class.php');
//include_once(__DIR__ . '\..\AccountsPayableReportGenerator.class.php');
//include_once(__DIR__ . '\..\Claim.class.php');
//include_once(__DIR__ . '\..\Claims.class.php');
//include_once(__DIR__ . '\..\ClaimSubmitter.class.php');
//include_once(__DIR__ . '\..\DateRangeReport.class.php');
include_once(__DIR__ . '\..\Database.class.php');
include_once(__DIR__ . '\..\DatabaseController.class.php');
//include_once(__DIR__ . '\..\ETFReport.class.php');
//include_once(__DIR__ . '\..\ETFReportGenerator.class.php');
//include_once(__DIR__ . '\..\IndexInterface.class.php');
//include_once(__DIR__ . '\..\ManagerInterface.class.php');
include_once(__DIR__ . '\..\Member.class.php');
//include_once(__DIR__ . '\..\MemberMaintainer.class.php');
//include_once(__DIR__ . '\..\MemberReport.class.php');
//include_once(__DIR__ . '\..\MemberReportGenerator.class.php');
//include_once(__DIR__ . '\..\Members.class.php');
//include_once(__DIR__ . '\..\OperatorInterface.class.php');
//include_once(__DIR__ . '\..\Person.class.php');
//include_once(__DIR__ . '\..\PersonMaintainer.class.php');
//include_once(__DIR__ . '\..\Person.class.php');
//include_once(__DIR__ . '\..\Persons.class.php');
//include_once(__DIR__ . '\..\ProviderDirectory.class.php');
//include_once(__DIR__ . '\..\ProviderMaintainer.class.php');
//include_once(__DIR__ . '\..\Persons.class.php');
//include_once(__DIR__ . '\..\Provider.class.php');
//include_once(__DIR__ . '\..\ProviderDirectory.class.php');
//include_once(__DIR__ . '\..\ProviderInterface.class.php');
//include_once(__DIR__ . '\..\ProviderMaintainer.class.php');
//include_once(__DIR__ . '\..\ProviderReport.class.php');
//include_once(__DIR__ . '\..\ProviderReportGenerator.class.php');
//include_once(__DIR__ . '\..\Providers.class.php');
//include_once(__DIR__ . '\..\Report.class.php');
//include_once(__DIR__ . '\..\SchedulerInterface.class.php');
//include_once(__DIR__ . '\..\Service.class.php');
//include_once(__DIR__ . '\..\ServiceMaintainer.class.php');
//include_once(__DIR__ . '\..\ServiceReportGenerator.class.php');
//include_once(__DIR__ . '\..\Services.class.php');
//include_once(__DIR__ . '\..\UserInterface.class.php');


class MemberTest extends PHPUnit_Framework_TestCase
{
	/** @var Database */
	protected $db;
	/**@var Member */
	protected $member;

	protected function setUp()
	{
		$_SERVER['REMOTE_ADDR'] = '::1';#'COMP370.db.10405771.hostedresource.com';
		$this->member = new Member();
		$this->db = $db = new Database();
	}

	public function testMySQLConnectionCredentials()
	{
		//arrange
		$_SERVER['REMOTE_ADDR'] = '::1';

		//assert
		assertJson($this->member->toJSON());
		echo "passed";
	}

	public function testCanBeCreated()
	{
		//arrange
		$num = 1;
		//$_SERVER['REMOTE_ADDR'] = "::1";
		$a = new Member($num);

		//act
		$b = $a->__toString();

		//assert
		$this->assertStringStartsWith("{", $b);
		echo "passed";
	}
}
