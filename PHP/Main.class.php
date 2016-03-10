<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/10/16
 * Time: 1:03
 */

class Main {
	private $type; //manager|operator|provider

	function __construct($_type) {
		$this->setName($_type);
		echo "{$this->type} instantiated.";
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