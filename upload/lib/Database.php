<?php

	class Database
	{
		/**
		 * @var string $_localhost
		 * @var string $_database
		 * @var string $_dbuser
		 * @var string $_dbpass
		 */
		private $_localhost;
		private $_database;
		private $_dbuser;
		private $_dbpass;

		/**
		 * @var mixed $connection
		 * @var mixed $dbselect
		 */
		private $_connection;
		private $dbselect;

		/**
		 * @param string $host
		 * @param string $db
		 * @param string $user
		 * @param string $pass
		 */
		public function __construct( $host = "localhost", $db = "database", $user = "user", $pass = "pass" )
		{
			$this->_localhost = $host;
			$this->_database  = $db;
			$this->_dbuser    = $user;
			$this->_dbpass    = $pass;
		}

		/**
		 * @return bool
		 */
		public function connect()
		{
			$this->_connection = mysql_connect( $this->_localhost, $this->_dbuser, $this->_dbpass );

			if ( !$this->_connection )
			{
				return false;
			} else
			{
				$this->dbselect = mysql_select_db( $this->_database, $this->_connection );

				if ( !$this->dbselect )
				{
					return false;
				} else
				{
					return true;
				}
			}
		}

	}
