<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//a Hit Counter class
class Hit_counter
{
	// to time in seconds, which has to pass, before counting a new visit for a ip-address (optional; standard is 30 minutes)
	function Hit_Counter ()
	{
		log_message('debug', 'Hit Counter Initialized');
		include(APPPATH.'config/database'.EXT);
		if ( ! isset($db) OR count($db) == 0) {
			show_error('No database connection settings were found in the database config file.');
		}		
		if (!isset($active_group) OR !isset($db[$active_group])) {
			show_error('You have specified an invalid database connection group.');
		}
		$params = $db[$active_group];
		$to = 1800;
		
		if (is_numeric ($to))
			$this->timeout = intval ($to);
		else
			$this->timeout = 1800;
		$this->ip_addr = $_SERVER['REMOTE_ADDR'];
		$this->db_server = $params['hostname'];
		$this->db_name = $params['database'];
		$this->db_user = $params['username'];
		$this->db_password = $params['password'];
		$this->dropExpiredIPAddresses ();
		if ($this->countInternalUsers ())
			$this->updateCounter ();
	}

	// reset counter
	function resetCounter ()
	{
		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if (mysql_select_db ($this->db_name))
		{
			if (!$result = mysql_query ("DELETE FROM counter"))
				print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
				      . mysql_errno () . " - " . mysql_error () . "<br>";
			if (!$result = mysql_query ("DELETE FROM counter_ip"))
				print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
				      . mysql_errno () . " - " . mysql_error () . "<br>";
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
	}

	// get the number of visits of the current day (sysdate of db-server)
	function getTodaysVisitCount ()
	{
		$visit_counter = 0;

		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if ($result = mysql_db_query ($this->db_name, "SELECT visit_counter FROM counter WHERE cdate = CURRENT_DATE"))
		{
			if ($line = mysql_fetch_array ($result, MYSQL_ASSOC))
				$visit_counter = $line['visit_counter'];
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return $visit_counter;
	}

	// get the number of page-hits (page-impressions) of the current day (sysdate of db-server)
	function getTodaysHitCount ()
	{
		$hit_counter = 0;

		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if ($result = mysql_db_query ($this->db_name, "SELECT hit_counter FROM counter WHERE cdate = CURRENT_DATE"))
		{
			if ($line = mysql_fetch_array ($result, MYSQL_ASSOC))
				$hit_counter = $line['hit_counter'];
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return $hit_counter;
	}

	// get the total number of visits since the counter has been reset or restarted
	function getTotalVisitCount ()
	{
		$visit_counter = 0;

		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if ($result = mysql_db_query ($this->db_name, "SELECT SUM(visit_counter) FROM counter"))
		{
			if ($line = mysql_fetch_array ($result, MYSQL_ASSOC))
				$visit_counter = $line['SUM(visit_counter)'];
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return $visit_counter;
	}

	// get the total number of page-hits since the counter has been reset, created or restarted
	function getTotalHitCount ()
	{
		$hit_counter = 0;

		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if ($result = mysql_db_query ($this->db_name, "SELECT SUM(hit_counter) FROM counter"))
		{
			if ($line = mysql_fetch_array ($result, MYSQL_ASSOC))
				$hit_counter = $line['SUM(hit_counter)'];
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return $hit_counter;
	}

	// get the date since when the counter has been reset, created or restarted
	function getCounterStartDate ()
	{
		$counter_started = 0;

		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if ($result = mysql_db_query ($this->db_name, "SELECT MIN(cdate) FROM counter"))
		{
			if ($line = mysql_fetch_array ($result, MYSQL_ASSOC))
				$counter_started = $line['MIN(cdate)'];
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return $counter_started;
	}

	// get the number of users which are online at present
	function getUsersOnlineCount ()
	{
		$users_online = 0;

		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if ($result = mysql_db_query ($this->db_name, "SELECT COUNT(*) FROM counter_ip"))
		{
			if ($line = mysql_fetch_array ($result, MYSQL_ASSOC))
				$users_online = $line['COUNT(*)'];
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return $users_online;
	}

	// re-initialize the counter with given values
	// start_date must have the format 'Y[YYY]-M[M]-D[D]'
	// start_visits number of visits
	// start_hits number of hots (page-impressions)
	function initCounter ($start_date, $start_visits, $start_hits)
	{
		if (is_int ($start_visits) && is_int ($start_hits))
		{
			list ($year, $month, $day) = explode ('-', $start_date);
			if (checkdate ($month, $day, $year))
			{
				$this->resetCounter ();
				$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
					or die (mysql_errno () . " - " . mysql_error () . "<br>");
				if (!$result = mysql_db_query ($this->db_name, "INSERT INTO counter VALUES ('" . $start_date . "', " . $start_visits . ", " . $start_hits . ")"))
					print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
					      . mysql_errno () . " - " . mysql_error () . "<br>";
				mysql_close ($db_connection);
			}
			else
				print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
				      . "invalid date or date format<br>";
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . "invalid start values for hits and/or visits<br>";
	}

	// imagine the following as private ;-)
	// check if tables are available and create them, if they do not exist
	function checkTables ()
	{
		if ($result = mysql_query ("SHOW TABLES"))
		{
			$tables = array ();
			while ($row = mysql_fetch_row ($result))
				array_push ($tables, $row[0]);
			if (!in_array ("counter", $tables))
				mysql_query ("CREATE TABLE counter ("
					     . "cdate DATE NOT NULL,"
					     . "visit_counter INT DEFAULT 1 NOT NULL,"
					     . "hit_counter INT DEFAULT 1 NOT NULL,"
					     . "PRIMARY KEY (cdate))");
			if (!in_array ("counter_ip", $tables))
				mysql_query ("CREATE TABLE counter_ip ("
					     . "ip_addr CHAR (30) NOT NULL ,"
					     . "last_hit TIMESTAMP NOT NULL,"
					     . "PRIMARY KEY (ip_addr))");
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
	}

	// checks for internal users (if cookie InternalUser is set)
	// for internal users counting is deactivated
	function countInternalUsers ()
	{
		if ((isset ($_COOKIE['CountInternalUsers']) && $_COOKIE['CountInternalUsers'] == "yes") || !isset ($_COOKIE['CountInternalUsers']))
			return TRUE;
		return FALSE;
	}

	// deletes the ip-addresses for expired visits
	function dropExpiredIPAddresses ()
	{
		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if (mysql_select_db ($this->db_name))
		{
			$this->checkTables ();
			// delete expired ip-addresses
			if (!$result = mysql_query ("DELETE FROM counter_ip "
						   . "WHERE CURRENT_TIMESTAMP - INTERVAL " . $this->timeout . " SECOND > last_hit"))
				print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
				      . mysql_errno () . " - " . mysql_error () . "<br>";
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
	}

	// update counter values
	function updateCounter ()
	{
		$db_connection = mysql_connect ($this->db_server, $this->db_user, $this->db_password)
			or die (mysql_errno () . " - " . mysql_error () . "<br>");
		if (mysql_select_db ($this->db_name))
		{
			// increment page hits
			if ($result = mysql_query ("SELECT hit_counter FROM counter WHERE cdate = DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d')"))
			{
				if (mysql_num_rows ($result) == 1)
				{
					if (!$result = mysql_query ("UPDATE counter SET hit_counter = hit_counter + 1 WHERE cdate = DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d')"))
						print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
						      . mysql_errno () . " - " . mysql_error () . "<br>";
				}
				else
				{
					if (!$result = mysql_query ("INSERT INTO counter VALUES (CURRENT_TIMESTAMP, 0, 1)"))
						print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
						      . mysql_errno () . " - " . mysql_error () . "<br>";
				}
			}
			// update ip-addresses ...
			if ($result = mysql_query ("SELECT ip_addr FROM counter_ip WHERE ip_addr = '" . $this->ip_addr . "'"))
			{
				if (mysql_num_rows ($result) == 1)
				{
					if (!$result = mysql_query ("UPDATE counter_ip SET last_hit = CURRENT_TIMESTAMP "
								   . "WHERE ip_addr = '" . $this->ip_addr . "'"))
						print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
						      . mysql_errno () . " - " . mysql_error () . "<br>";
				}
				else
				{
					if (!$result = mysql_query ("INSERT INTO counter_ip VALUES ('" . $this->ip_addr . "', CURRENT_TIMESTAMP)"))
						print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
						      . mysql_errno () . " - " . mysql_error () . "<br>";
					// and increment visits
					if (!$result = mysql_query ("UPDATE counter SET visit_counter = visit_counter + 1 WHERE cdate = DATE_FORMAT(CURRENT_TIMESTAMP, '%Y-%m-%d')"))
						print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
						      . mysql_errno () . " - " . mysql_error () . "<br>";
				}
			}
		}
		else
			print __CLASS__ . "::" . __FUNCTION__ . "()[" . __FILE__ . ":" . __LINE__ ."]: "
			      . mysql_errno () . " - " . mysql_error () . "<br>";
		mysql_close ($db_connection);
		return 0;
	}

	var $ip_addr;
	var $timeout;
	var $db_server;
	var $db_name;
	var $db_user;
	var $db_password;
}
?>
