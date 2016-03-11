<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/10/16
 * Time: 1:03
 */

include_once('Utils.class.php');

//Load all classes that will be needed (after project is done, we can spread these out).
spl_autoload_register(function ($class_name) {
	include $class_name . '.class.php';
});

/*
include_once('AccountsPayableReport.class.php');
include_once('AccountsPayableReportGenerator.class.php');
include_once('Claim.class.php');
include_once('Claims.class.php');
include_once('ClaimSubmitter.class.php');
include_once('DateRangeReport.class.php');
include_once('ETFReport.class.php');
include_once('ETFReportGenerator.class.php');
include_once('ManagerInterface.class.php');
include_once('Member.class.php');
include_once('MemberMaintainer.class.php');
include_once('MemberReport.class.php');
include_once('MemberReportGenerator.class.php');
include_once('Members.class.php');
include_once('OperatorInterface.class.php');
include_once('Person.class.php');
include_once('PersonMaintainer.class.php');
include_once('Person.class.php');
include_once('Persons.class.php');
include_once('ProviderDirectory.class.php');
include_once('ProviderMaintainer.class.php');
include_once('Persons.class.php');
include_once('Provider.class.php');
include_once('ProviderDirectory.class.php');
include_once('ProviderMaintainer.class.php');
include_once('ProviderReport.class.php');
include_once('ProviderReportGenerator.class.php');
include_once('Providers.class.php');
include_once('Report.class.php');
include_once('SchedulerInterface.class.php');
include_once('Service.class.php');
include_once('ServiceMaintainer.class.php');
include_once('ServiceReportGenerator.class.php');
include_once('Services.class.php');
include_once('UserInterface.class.php');
*/

/**
 * Class ChocAnSystem
 * @date 11-04-2016
 * @desc Entry-point for the Object-oriented PHP code. Called from the indexes.
 */
class ChocAnSystem
{
	private $type; //manager|operator|provider|scheduler
	private $myInterface; //ManagerInterface|OperatorInterface|ProviderInterface|SchedulerInterface

	/**
	 * @param $_type    Takes either manager|operator|provider|scheduler as strings.
	 */
	function __construct($_type)
	{
		$this->setName($_type);

		//instantiate the correct Interface and call it's main method.
		if ($this->type === "manager") {
			$this->myInterface = new ManagerInterface();
		} else if ($this->type === "operator") {
			$this->myInterface = new OperatorInterface();
		} else if ($this->type === "provider") {
			$this->myInterface = new ProviderInterface();
		} else {
			$this->myInterface = new SchedulerInterface();
		}
		$this->myInterface->main();
	}

	function getName()
	{
		return $this->type;
	}

	function setName($_type)
	{
		if ($_type != "manager" && $_type != "operator" && $_type != "provider" && $_type != "scheduler") {
			$this->type = "manager";
		} else {
			$this->type = $_type;
		}

	}
}