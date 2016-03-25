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

	const DATABASE_NAME = "COMP370";

	// Database names
	const PROVIDER = "provider";
	const MEMBER   = "member";
	const CLAIM    = "claim";
	const SERVICE  = "service";

	// Provider field names as stored in database.
	const PROVIDER_NUMBER   = "provider_number";
	const PROVIDER_NAME     = "provider_name";
	const PROVIDER_STREET   = "provider_street_address";
	const PROVIDER_CITY     = "provider_city";
	const PROVIDER_PROVINCE = "provider_province";
	const PROVIDER_POSTAL   = "provider_postal_code";
	const PROVIDER_EMAIL    = "provider_email_address";
	const PROVIDER_TYPE     = "provider_type";

	// Member field names as stored in database.
	const MEMBER_NUMBER   = "member_number";
	const MEMBER_NAME     = "member_name";
	const MEMBER_STREET   = "member_street_address";
	const MEMBER_CITY     = "member_city";
	const MEMBER_PROVINCE = "member_province";
	const MEMBER_POSTAL   = "member_postal_code";
	const MEMBER_EMAIL    = "member_email_address";
	const MEMBER_STATUS   = "member_status";

	// Service field names as stored in database.
	const SERVICE_CODE = "service_code";
	const SERVICE_NAME = "service_name";
	const SERVICE_FEE  = "service_fee";

	// Claim field names as stored in database.
	const SUBMISSION_DATE_TIME = "submission_date_and_time";
	const SERVICE_DATE         = "service_date";
	const COMMENTS             = "comments";

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

		$member_number = self::$db->escape($member_number);

		return self::$db->select("SELECT * FROM member where member_number = ${member_number}")[0];
	}

	public static function selectProvider($provider_number)
	{
		self::initialize();

		$provider_number = self::$db->escape($provider_number);

		$rows = self::$db->select("SELECT * FROM provider where provider_number = ${provider_number}")[0];

		return $rows;
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

	public static function providerExists($provider_number)
	{
		self::initialize();

		$rows = self::$db->select("SELECT provider_number FROM provider WHERE provider_number = " . $provider_number);
		foreach ($rows as &$row)
		{
			if (isset($row["provider_number"]))
			{
				return true;
			}
		}

		return false;
	}

	public static function addProvider($name, $street, $city, $province, $postal, $email, $type)
	{
		self::initialize();

		$query = "INSERT INTO ". self::PROVIDER ." (".
			self::PROVIDER_NAME . ", " .
			self::PROVIDER_STREET   .", ". self::PROVIDER_CITY   .", ".
			self::PROVIDER_PROVINCE .", ". self::PROVIDER_POSTAL .", ".
			self::PROVIDER_EMAIL    .", ". self::PROVIDER_TYPE   .") ".

			"VALUES ('" . $name . "', '" .
			$street   ."', '". $city   ."', '".
			$province ."', '". $postal ."', '".
			$email    ."', '". $type   ."')  ";

		return (self::$db->query($query) == true) ? self::getLastMemberNumber() : false;
	}

	public static function addMember($name, $street, $city, $province, $postal, $email, $status)
	{
		self::initialize();

		$query = "INSERT INTO ". self::MEMBER ." (".
			self::MEMBER_NAME . ", " .
			self::MEMBER_STREET   .", ". self::MEMBER_CITY   .", ".
			self::MEMBER_PROVINCE .", ". self::MEMBER_POSTAL .", ".
			self::MEMBER_EMAIL    .", ". self::MEMBER_STATUS .") ".

			"VALUES ('" . $name . "', '" .
			$street   ."', '". $city   ."', '".
			$province ."', '". $postal ."', '".
			$email    ."', '". $status ."')  ";

		return (self::$db->query($query) == true) ? self::getLastProviderNumber() : false;
	}

	public static function deleteMember($number)
	{
		self::initialize();

		$query = "DELETE FROM ". self::MEMBER .
			" WHERE " 	   . self::MEMBER_NUMBER ."='". $number ."'";

		return self::$db->query($query);
	}

	public static function deleteProvider($number)
	{
		self::initialize();

		$query = "DELETE FROM ". self::PROVIDER .
			" WHERE " 	   . self::PROVIDER_NUMBER ."='". $number ."'";

		return self::$db->query($query);
	}

	public static function updateProvider($number, $name, $street, $city, $province, $postal, $email, $type)
	{
		self::initialize();

		$query = "UPDATE " . self::PROVIDER
			." SET ". self::PROVIDER_NAME ."='". $name ."', ".
			self::PROVIDER_STREET   ."='". $street   ."', ".
			self::PROVIDER_CITY     ."='". $city     ."', ".
			self::PROVIDER_PROVINCE ."='". $province ."', ".
			self::PROVIDER_POSTAL   ."='". $postal   ."', ".
			self::PROVIDER_EMAIL    ."='". $email    ."', ".
			self::PROVIDER_TYPE     ."='". $type     ."'  ".
			" WHERE " . self::PROVIDER_NUMBER ."='". $number ."' ";

		return self::$db->query($query);
	}

	public static function updateMember($number, $name, $street, $city, $province, $postal, $email, $type)
	{
		self::initialize();

		$query = "UPDATE " . self::MEMBER
			." SET ". self::MEMBER_NAME ."='". $name ."', ".
			self::MEMBER_STREET   ."='". $street   ."', ".
			self::MEMBER_CITY     ."='". $city     ."', ".
			self::MEMBER_PROVINCE ."='". $province ."', ".
			self::MEMBER_POSTAL   ."='". $postal   ."', ".
			self::MEMBER_EMAIL    ."='". $email    ."', ".
			self::MEMBER_STATUS   ."='". $type     ."'  ".
			" WHERE " . self::MEMBER_NUMBER ."='". $number ."' ";

		return self::$db->query($query);
	}

	public static function getAllServices()
	{
		self::initialize();

		return self::$db->select("SELECT * FROM " . self::SERVICE . " ORDER BY " . self::SERVICE_CODE);
	}

	public static function addService($code, $name, $fee)
	{
		self::initialize();

		$query =  "INSERT INTO ". self::SERVICE ." VALUES ('".
			$code ."', '".
			$name ."', '".
			$fee  ."')  ";

		return self::$db->query($query);
	}

	public static function deleteService($code)
	{
		self::initialize();

		$query = "DELETE FROM " . self::SERVICE .
			" WHERE " . self::SERVICE_CODE . "='" . $code . "'";

		return self::$db->query($query);
	}

	public static function getAllClaims()
	{
		self::initialize();

		return self::$db->select("SELECT * FROM " . self::CLAIM . " ORDER BY " . self::SUBMISSION_DATE_TIME);
	}

	public static function addClaim($subDate, $servCode, $memberNum, $providerNum, $servDate, $comments)
	{
		self::initialize();

		$comments = self::$db->escape($comments);

		return self::$db->query("INSERT INTO " . self::SERVICE . " VALUES ('${subDate}', '${servCode}', '${providerNum}', '${memberNum}', '${servDate}', '${comments}')");
		/*return self::$db->query("INSERT INTO " . self::SERVICE .
			" VALUES ('" . $subDate     . "', '"
			. $servCode    . "', '"
			. $providerNum . "', '"
			. $memberNum   . "', '"
			. $servDate    . "', '"
			. $comments    . "')");*/
	}

	public static function deleteClaim($submissionDate, $member, $provider)
	{
		self::initialize();


	}

	private static function getLastMemberNumber()
	{
		$result = self::$db->select("SELECT " . self::MEMBER_NUMBER . " FROM " .
			self::MEMBER . " ORDER BY " . self::MEMBER_NUMBER . " DESC LIMIT 1");

		return $result[0][self::MEMBER_NUMBER];
	}

	private static function getLastProviderNumber()
	{
		$result = self::$db->select("SELECT " . self::PROVIDER_NUMBER . " FROM " .
			self::PROVIDER . " ORDER BY " . self::PROVIDER_NUMBER . " DESC LIMIT 1");

		return $result[0][self::PROVIDER_NUMBER];
	}
}