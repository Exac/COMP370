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

	public static function selectMemberNames()
	{
		self::initialize();

		return self::$db->select("SELECT member_name, member_number FROM member");
	}

	public static function selectMembers()
	{
		self::initialize();

		return self::$db->select("SELECT * FROM member ORDER BY member_number");
	}

	public static function selectProviderNames()
	{
		self::initialize();

		return self::$db->select("SELECT provider_name, provider_number FROM provider");
	}

	public static function selectProviders()
	{
		self::initialize();

		return self::$db->select("SELECT * FROM provider ORDER BY provider_number");
	}

	/**
	 * @param $member_number int member_number
	 * @return mixed Array
	 */
	public static function selectMember($member_number)
	{
		self::initialize();

		$member_number = mysql_real_escape_string($member_number);

		return self::$db->select("SELECT * FROM member where member_number = ${member_number}")[0];
	}

	public static function selectProvider($provider_number)
	{
		self::initialize();

		$provider_number = mysql_real_escape_string($provider_number);

		return self::$db->select("SELECT * FROM provider where provider_number = ${provider_number}")[0];
	}

	public static function findProvider($term)
	{
		self::initialize();

		return self::$db->select("Select * from provider where `provider_number` LIKE '%${term}%' OR `provider_name` LIKE '%${term}%' OR `provider_street_address` LIKE '%${term}%' OR `provider_city` LIKE '%${term}%' OR `provider_province` LIKE '%${term}%' OR `provider_postal_code` LIKE '%${term}%' OR `provider_email_address` LIKE '%${term}%' OR `provider_type` LIKE '%${term}%'");
	}

	public static function findMember($term)
	{
		self::initialize();

		return self::$db->select("Select * from member where `member_number` LIKE '%${term}%' OR `member_name` LIKE '%${term}%' OR `member_street_address` LIKE '%${term}%' OR `member_city` LIKE '%${term}%' OR `member_province` LIKE '%${term}%' OR `member_postal_code` LIKE '%${term}%' OR `member_email_address` LIKE '%${term}%' OR `member_status` LIKE '%${term}%'");
	}

	public static function getNextIndex($table)
	{
		self::initialize();

		return self::$db->select("select Auto_increment FROM information_schema.tables where table_name='${table}'")[0]["Auto_increment"];
	}

	public static function memberExists($member_number)
	{
		self::initialize();

		$rows = self::$db->select("SELECT member_number FROM member WHERE member_number = " . $member_number);
		foreach ($rows as &$row)
		{
			if (isset($row["member_number"]))
			{
				return true;
			}
		}

		return false;
	}
}
