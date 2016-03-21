<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/10/16
 * Time: 1:43
 */

/**
 * Class Utils
 *
 * Use this class for functions that don't fit inside classes (yet).
 * This is bad practice and we are aware.
 */
class Utils {
	public static function getNavigationMenu() {
		return '<ul>'.
				'<li><a href="/manager">manager</a></li>'.
				'<li><a href="/operator">operator</a></li>'.
				'<li><a href="/provider">provider</a></li>'.
		'<li><a href="/scheduler">scheduler</a></li>' .
				'</ul>';
	}

	public function testDB()
	{
		$d = new Database();
		$a = $d->select("SELECT * FROM `member` ORDER BY `member_number`");
		foreach ($a as $row) {
			echo $row["member_number"];
			echo $row["member_name"];
			echo $row["member_email_address"];
		}
	}
}

class Button
{
	public $name = null;
	public $label = null;

	public function __construct($_name, $_label)
	{
		$this->name = $_name;
		$this->label = $_label;
	}

	public function __toString()
	{
		$o = '<button type="button" id="' . $this->cleanName($this->name) . '">' . $this->name . '</button>';
		$o .= '<label for="' . $this->cleanName($this->name) . '">' . $this->label . '</label>';

		return $o;
	}

	/**
	 * Creates a html-id-safe name for variable. "nice Button" becomes "nice_Button"
	 *
	 * @param $_name string value to be cleaned.
	 * @return string name
	 */
	private function cleanName($_name)
	{
		return str_replace(" ", "_", $_name);
	}

}

class Input
{
	public $name = null;
	public $label = null;
	public $type = null;
	public $radio_group = "default";
	public $attributes = "";

	/**
	 * @param $_type string (button|checkbox|radio|text|password)
	 * @param $_name string
	 * @param $_label string|array ["label string"]["attr='value'"]
	 */
	public function __construct($_type, $_name, $_label)
	{
		$this->type = $_type;
		$this->name = $_name;
		if (is_string($_label))
		{
			$this->label = $_label;
		} else if (is_array($_label))
		{
			reset($_label);
			$this->label = current($_label);
			if (count($_label > 1))
			{
				$this->attributes .= " " . next($_label) . " ";
			}
		}


		//If an optional 4th parameter is passed, use it to determine a radio button's group.
		if (func_num_args() === 4) {
			$this->radio_group = func_get_args()[3];
		}
	}

	public function __toString()
	{
		if ($this->type === "button" || $this->type === "submit")
		{
			$o = '<button type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="' . $this->getId($this->name) . '"' . $this->attributes . '>' . $this->name . '</button>';
		} else if ($this->type === "input")
		{
			$o = '<button type="input" id="' . $this->getId($this->name) . '" name="' . $this->getId($this->name) . '"' . $this->attributes . '>' . $this->name . '</button>';
		} else if ($this->type === "submit")
		{
			$o = '<button type="submit" id="' . $this->getId($this->name) . '" name="' . $this->getId($this->name) . '"' . $this->attributes . '>' . $this->name . '</button>';
		} else if ($this->radio_group === "radio")
		{
			$o = '<input type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="' . $this->radio_group . '"/' . $this->attributes . '>';
		} else
		{
			$o = '<input type="' . $this->type . '" id="' . $this->getId($this->name) . '" name="' . $this->getId($this->name) . '"' . $this->attributes . '/>';
		}

		$o .= '<label for="' . $this->getId($this->name) . '">' . $this->label . '</label>';

		return "\n" . $o;
	}

	public function br()
	{
		return $this->__toString() . "<br>";
	}

	/**
	 * Creates a html-id-safe name for variable. "nice Button" becomes "nice_Button"
	 *
	 * @param $_name
	 * @return string ID
	 */
	public function getId($_name)
	{
		return strtolower(str_replace(" ", "_", $_name));
	}

}


