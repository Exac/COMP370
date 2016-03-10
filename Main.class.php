<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/10/16
 * Time: 1:03
 */

include_once('Utils.class.php');

class Main {
	private $type; //manager|operator|provider

	function __construct($_type) {
		$this->setName($_type);
		echo "{$this->type} instantiated.".Utils::getNavigationMenu();

	}

	function getName() {
		return $this->type;
	}

	function setName($_type) {
		if($_type !== "manager" || $_type !== "operator" || $_type !== "provider") {
			$this->type = "manager";
		}else{
			$this->type = $_type;
		}

	}
}