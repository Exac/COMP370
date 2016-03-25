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


class DatabaseTest extends PHPUnit_Framework_TestCase
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

	protected function setUp()
	{
		$_SERVER['REMOTE_ADDR'] = '::1';#'COMP370.db.10405771.hostedresource.com';
		$this->db = $db = new Database();
	}

	/**
	 * Stress-test the database.
	 * @desc Stress-tests that the database can handle 100's of queries a second.
	 */
	public function testMultipleDBQueries()
	{
		//arrange
		$members = array();
		for ($x = 1; $x <= 99; $x++)
		{
			$members[ $x ] = new Member($x);
		}

		//assert
		for ($y = 1; $y <= 99; $y++)
		{
			$this->assertEquals(str_pad($y, 9, '0', STR_PAD_LEFT), $members[ $y ]->getNumber() + "", str_pad($y, 9, '0', STR_PAD_LEFT) . " != " . $members[ $y ]->getNumber() + "\n");
		}
	}

	/**
	 * @desc Ensures the environmental variable for the database password is set up.
	 */
	public function testDatabasePasswordIsString()
	{
		//assert
		$this->assertTrue(is_string($this->db->password), "Got a " . gettype($this->db->password) . " instead of a string");
	}

	/**
	 * @desc Ensures password is alphanumeric
	 */
	public function testDatabasePasswordFirstCharacterAlphanumeric()
	{
		//assert
		$this->assertTrue(is_string($this->db->password[0]), "Got a " . gettype($this->db->password) . " instead of a string");
	}

	/**
	 * @desc Ensures the password is more than one character
	 */
	public function testDatabasePasswordGreaterThanZero()
	{
		//assert
		$this->assertTrue((strlen($this->db->password) > 0), "Got a " . gettype($this->db->password) . " instead of a string");
	}

	/**
	 * @desc Ensures the login is 'COMP370'.
	 */
	public function testLoginCorrect()
	{
		$this->assertEquals($this->db->user, "COMP370");
	}

	/**
	 * @desc Ensures the claim database table is working.
	 */
	public function testClaim()
	{
		$this->assertTrue(!empty($this->db->select('SELECT * FROM claim')), "Got nothing from a query to claim.");
	}

	/**
	 * @desc Ensures the member database table is working.
	 */
	public function testMember()
	{
		$this->assertTrue(!empty($this->db->select('SELECT * FROM member')), "Got nothing from a query to member.");
	}

	/**
	 * @desc Ensures the provider database table is working.
	 */
	public function testProvider()
	{
		$this->assertTrue(!empty($this->db->select('SELECT * FROM provider')), "Got nothing from a query to provider.");
	}

	/**
	 * @desc Ensures the service database table is working.
	 */
	public function testService()
	{
		$this->assertTrue(!empty($this->db->select('SELECT * FROM service')), "Got nothing from a query to service.");
	}

	/**
	 * @desc Makes sure every key in the claim table is unique. This is important because
	 *            the key is a DATETIME string, meaning if two claim objects were set at the
	 *            same time they would conflict.
	 */
	public function testUniqueClaimKeys()
	{
		$keys = array();
		$data = (new Database())->select("SELECT submission_date_and_time FROM claim");
		foreach ($data as &$d)
		{
			array_push($keys, $d["submission_date_and_time"]);
		}
		$unique_keys = array_unique($keys);

		$this->assertEquals(count($keys), count($unique_keys), "Duplicate key found.");
	}

	/**
	 * @desc Makes sure every key in the member table is unique.
	 */
	public function testUniqueMemberKeys()
	{
		$keys = array();
		$data = (new Database())->select("SELECT member_number FROM member");
		foreach ($data as &$d)
		{
			array_push($keys, $d["member_number"]);
		}
		$unique_keys = array_unique($keys);

		$this->assertEquals(count($keys), count($unique_keys), "Duplicate key found.");
	}

	/**
	 * @desc Makes sure every key in the provider table is unique.
	 */
	public function testUniqueProviderKeys()
	{
		$keys = array();
		$data = (new Database())->select("SELECT provider_number FROM provider");
		foreach ($data as &$d)
		{
			array_push($keys, $d["provider_number"]);
		}
		$unique_keys = array_unique($keys);

		$this->assertEquals(count($keys), count($unique_keys), "Duplicate key found.");
	}

	/**
	 * @desc Makes sure every key in the service table is unique.
	 */
	public function testUniqueServiceKeys()
	{
		$keys = array();
		$data = (new Database())->select("SELECT service_code FROM service");
		foreach ($data as &$d)
		{
			array_push($keys, $d["service_code"]);
		}
		$unique_keys = array_unique($keys);

		$this->assertEquals(count($keys), count($unique_keys), "Duplicate key found.");
	}
}
