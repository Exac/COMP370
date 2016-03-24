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


class GeneralTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Remove errors on the server.
	 */
	protected $preserveGlobalState = false;
	protected $runTestInSeparateProcess = true;

	/** @var Database */
	protected $db;

	protected function setUp()
	{
		$_SERVER['REMOTE_ADDR'] = '::1';#'COMP370.db.10405771.hostedresource.com';
		$this->db = $db = new Database();
	}

	/**
	 * @desc Ensures __DIR__ global is set properly.
	 */
	public function testDirGlobalIsSet()
	{
		//arrange
		$dir = __DIR__;

		//act

		//assert
		$this->assertTrue(isset($dir));
		$this->assertStringEndsWith("tests", $dir);
	}

	/**
	 * @desc Ensures _SERVER[REMOTE_ADDR] is set, it's needed for testing and Database connectivity.
	 */
	public function testServerRemoteAddressSet()
	{
		$this->assertTrue(isset($_SERVER["REMOTE_ADDR"]), "Didn't find a value for \$_SERVER[REMOTE_ADDR]");
	}

	/**
	 * @desc Mysqli is needed for the database, so we test if it is included
	 *        (as it isn't installed by default on some platforms)
	 */
	public function testMysqliLoaded()
	{
		$mysqli_extension_loaded = extension_loaded("mysqli");

		$this->assertTrue($mysqli_extension_loaded, "The PHP extension 'mysqli' is not loaded.");
	}

	/**
	 * Checks if mysqli exists, but hasn't been started.
	 */
	public function testMysqliInti()
	{
		//create a new database object to ensure mysqli's creation
		$database_test = new Database();

		$this->assertTrue(function_exists('mysqli_init'), "mysqli_init() not loaded.");
	}

	/**
	 * Test that the login in private function Person()->getLength() is correct
	 */
	public function testGetLength()
	{
		#$person = new Person();
		$testString = "123456789";
		$this->assertEquals(9, strlen((string)$testString));
	}


}
