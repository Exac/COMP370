<?php
/**
 * Created by PhpStorm.
 * User: Navi
 * Date: 24/03/2016
 * Time: 3:59 PM
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

class PersonsTest extends PHPUnit_Framework_TestCase
{
    protected $members;
    protected $providers;

    protected function setUp()
    {
        $_SERVER['REMOTE_ADDR'] = '::1';#'COMP370.db.10405771.hostedresource.com';

        $this->members = new Members();
        $this->providers = new Providers();
    }

    public function testMemberGet()
    {
        $members = $this->members->getAll();
        $this->assertTrue(isset($members));
    }

    public function testProviderGet()
    {
        $members = $this->providers->getAll();

        $this->assertTrue(isset($members));
    }

    public function testMemberUpdate()
    {
        $member = new Member();
        $member->setNumber(000000310);
        $member->setName("Rao");
        $member->setStreet("raoTestStreet");
        $member->setCity("raoCity");
        $member->setProvince("BC");
        $member->setPostalCode("123 456");
        $member->setEmail("rao@member.ca");
        $member->setStatus("A");

        $result = $this->members->update($member);
        $this->assertTrue(isset($result));
        echo $result;
    }

    /*   public function testMemberAdd()
       {
           $member = new Member();
           $member->setName("John");
           $member->setStreet("johnTestStreet");
           $member->setCity("testCity");
           $member->setProvince("BC");
           $member->setPostalCode("123 456");
           $member->setEmail("test@member.ca");
           $member->setStatus("D");

           $result = $this->members->add($member);

           $this->assertTrue(isset($result));

           $this->members->delete($result);

           echo "PersonTest " . $result;

           echo $this->members->findByNumber($result);
       }
   */
    /*    public function testProviderAdd()
        {
            $member = new Provider();
            $member->setName("testing");
            $member->setStreet("johnTestStreet");
            $member->setCity("testCity");
            $member->setProvince("BC");
            $member->setPostalCode("123 456");
            $member->setEmail("test@member.ca");
            $member->setType("D");

            $result = $this->providers->add($member);

            echo "PersonTest " . $result;

            $this->assertTrue(isset($result));
        }
    */
}





