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
include_once(__DIR__ . '/../AccountsPayableReport.class.php');
include_once(__DIR__ . '/../AccountsPayableReportGenerator.class.php');
include_once(__DIR__ . '/../Claim.class.php');
include_once(__DIR__ . '/../Claims.class.php');
include_once(__DIR__ . '/../ClaimSubmitter.class.php');
include_once(__DIR__ . '/../DateRangeReport.class.php');
include_once(__DIR__ . '/../Database.class.php');
include_once(__DIR__ . '/../DatabaseController.class.php');
include_once(__DIR__ . '/../ETFReport.class.php');
include_once(__DIR__ . '/../ETFReportGenerator.class.php');
include_once(__DIR__ . '/../IndexInterface.class.php');
include_once(__DIR__ . '/../ManagerInterface.class.php');
include_once(__DIR__ . '/../Member.class.php');
include_once(__DIR__ . '/../MemberMaintainer.class.php');
include_once(__DIR__ . '/../MemberReport.class.php');
include_once(__DIR__ . '/../MemberReportGenerator.class.php');
include_once(__DIR__ . '/../Members.class.php');
include_once(__DIR__ . '/../OperatorInterface.class.php');
include_once(__DIR__ . '/../Person.class.php');
include_once(__DIR__ . '/../PersonMaintainer.class.php');
include_once(__DIR__ . '/../Person.class.php');
include_once(__DIR__ . '/../Persons.class.php');
include_once(__DIR__ . '/../ProviderDirectory.class.php');
include_once(__DIR__ . '/../ProviderMaintainer.class.php');
include_once(__DIR__ . '/../Persons.class.php');
include_once(__DIR__ . '/../Provider.class.php');
include_once(__DIR__ . '/../ProviderDirectory.class.php');
include_once(__DIR__ . '/../ProviderInterface.class.php');
include_once(__DIR__ . '/../ProviderMaintainer.class.php');
include_once(__DIR__ . '/../ProviderReport.class.php');
include_once(__DIR__ . '/../ProviderReportGenerator.class.php');
include_once(__DIR__ . '/../Providers.class.php');
include_once(__DIR__ . '/../Report.class.php');
include_once(__DIR__ . '/../SchedulerInterface.class.php');
include_once(__DIR__ . '/../Service.class.php');
include_once(__DIR__ . '/../ServiceMaintainer.class.php');
include_once(__DIR__ . '/../ServiceReportGenerator.class.php');
include_once(__DIR__ . '/../Services.class.php');
include_once(__DIR__ . '/../UserInterface.class.php');


class MemberTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Remove errors on the server.
	 */
	protected $preserveGlobalState = false;
	protected $runTestInSeparateProcess = true;

	/** @var Database */
	protected $db;
	/**@var Member */
	protected $member;

	private $tear_down_tcmtae;//run this query on tear down

	protected function setUp()
	{
		$_SERVER['REMOTE_ADDR'] = '::1';#'COMP370.db.10405771.hostedresource.com';
		$this->member = new Member();
		$this->db = $db = new Database();
	}

	protected function tearDown()
	{

	}

	/**
	 * @desc Ensures members can be created.
	 */
	public function testCanBeCreated()
	{
		//arrange
		$num = 1;
		//$_SERVER['REMOTE_ADDR'] = "::1";
		$a = new Member($num);

		//act
		$b = $a->__toString();

		//assert
		$this->assertStringStartsWith("{", $b, "Member->__toString() should return valid JSON.");
	}

	/**
	 * @desc Create a member that already exists
	 */
	public function testCreateMemberThatAlreadyExists()
	{
		//arrange
		$num = 1;
		//$_SERVER['REMOTE_ADDR'] = "::1";
		$a = new Member($num);
		$original_name = $a->getName();
		$test_name = $a->getName() . "TEST";
		$this->tear_down_tcmtae = "delete from member where member_name = '${test_name}'";
		$a->setName($test_name);

		//act
		//add member to database
		DatabaseController::addMember($test_name, $a->getStreet(), $a->getCity(), $a->getProvince(), $a->getPostalCode(), $a->getEmail(), $a->getStatus());
		//create a new member object with same number as original, they should not be the same.
		$b = new Member($num);

		//remove test data from mysql
		echo $this->tear_down_tcmtae . "\n";
		$this->db->query($this->tear_down_tcmtae);

		//assert
		$this->assertEquals($original_name, $b->getName());
	}

	/**
	 * @desc Ensures members can be found in the database.
	 */
	public function testMySQLConnectionCredentials()
	{
		//arrange
		$_SERVER['REMOTE_ADDR'] = '::1';

		//assert
		$this->assertJson($this->member->toJSON(), "Member->__toString() should return valid JSON.");
		echo "passed";
	}

	/**
	 * @desc Ensures postal codes are in correct Canadian format.
	 */
	public function testPostalCodeCanadianFormat()
	{
		$members = $this->db->select("SELECT member_postal_code FROM member");
		foreach ($members as &$pc)
		{
			$this->assertStringMatchesFormat("%c%c%c%w%c%c%c", $pc["member_postal_code"]);
		}

	}
}
