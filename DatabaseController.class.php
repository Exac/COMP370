<?php
/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 3/17/16
 * Time: 22:35
 */

/**
 * Class DatabaseController
 *
 * There is no __construct() method for this static class.
 * Every method must begin with a call to self::$initialize().
 */
class DatabaseController
{
	private static $initialized = false;
	private static $db;

	private static function initialize()
	{
		if (self::$initialized)
		{
			return; //exit if already initialized.
		}
		self::$db = new Database();
		echo "<h1>creating new database connection</h1>";

		self::$initialized = true;
	}

	/**
	 * DatabaseController::selectMemberArrayByNumber()
	 *
	 * @return mixed String name if successful.
	 */
	public static function selectFirstMemberName()
	{
		self::initialize();

		return self::$db->select("SELECT member_name FROM member WHERE member_number = 1")[0]["member_name"];
	}

	/**
	 * DatabaseController::selectMemberArrayByNumber(1)["member_name"]
	 *
	 * @param $member_number int ID of member.
	 * @return mixed String name if successful.
	 */
	public static function selectMemberArrayByNumber($member_number)
	{
		self::initialize();

		return self::$db->select("select * from member where member_number = ${member_number}")[0];
	}

	/**
	 * $x = DatabaseController::selectMemberArrayByProvince("BC");
	 * foreach ($bcMembers as &$mem)
	 *     echo "${mem["member_name"]}";
	 *
	 * Uses the second part of ISO_3166-2:CA abbreviations (ie: BC, AB)
	 *
	 * @param $member_province string Name of province/state.
	 * @return mixed
	 */
	public static function selectMemberArrayByProvince($member_province)
	{
		self::initialize();

		return self::$db->select("select * from member where member_province = '${member_province}'");
	}

}
