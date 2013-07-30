<?php

	class Check
	{
		/**
		 * @param     $hostname
		 * @param int $port
		 * @param int $timeout
		 *
		 * @return bool
		 * @throws UnexpectedValueException
		 */
		static public function checkServer( $hostname, $port = 80, $timeout = 0 )
		{
			if ( preg_match( '/((WWW|www)?(\.)?)([0-9a-zA-Z_-]+)((\.{1})([a-zA-Z]{2,3}))$|([0-9]{1,3}\.){3}([0-9]{1,3})/',
					$hostname ) && preg_match( '/([0-9]{1,4})/', $port )
			)
			{
				return @fsockopen( $hostname, $port, $timeout ) ? true : false;
			} else
			{
				throw new UnexpectedValueException( "The domain or ip is not correct" );
			}
		}

		/**
		 * @param     $host
		 * @param     $port
		 * @param int $count
		 *
		 * @return array
		 */
		public static function ping( $host, $port, $count = 4 )
		{
			$ping_exec_result = self::ping_exec( $host, $count );

			if ( !empty( $ping_exec_result ) )
			{
				return $ping_exec_result;
			} else
			{
				$array_result = array();
				for ( $i = 0; $i < $count; $i++ )
				{
					$array_result[] = self::ping_socket( $host, $port, $count );
				}

				return $array_result;
			}

		}

		/**
		 * @param $host
		 * @param $count
		 *
		 * @return mixed
		 */
		private function ping_exec( $host, $count )
		{
			$host  = preg_replace( "/[^A-Za-z0-9.-]/", "", $host );
			$host  = escapeshellarg( $host );
			$count = preg_replace( "/[^0-9]/", "", $count );

			exec( "ping -c $count $host", $return_array );

			return $return_array;
		}

		/**
		 * @param     $host
		 * @param int $port
		 *
		 * @return bool|string
		 */
		private function ping_socket( $host, $port = 80 )
		{
			$timeA = microtime( true );
			$con   = @fsockopen( $host, $port, $errno, $errstr );
			$timeB = microtime( true );

			if ( $con )
			{
				return "Reply from $host: bytes=32 time=" . round( ( ( $timeB - $timeA ) * 1000 ), 0 ) . "ms TTL=NULL";
			} else
			{
				return false;
			}
		}

		/**
		 * @param $hostname
		 *
		 * @return array
		 * @throws UnexpectedValueException
		 */
		public function traceRoute( $hostname )
		{
			if ( preg_match( '/((WWW|www)?(\.)?)([0-9a-zA-Z_-]+)((\.{1})([a-zA-Z]{2,3}))$|([0-9]{1,3}\.){3}([0-9]{1,3})/',
				$hostname )
			)
			{
				$output   = array();
				$hostname = escapeshellarg( $hostname );
				@exec( "traceroute {$hostname}", $output );

				return $output;
			} else
			{
				throw new UnexpectedValueException( "The domain or ip is not correct" );
			}
		}

		/**
		 * @param $hostname
		 * @param $type
		 *
		 * @return array
		 * @throws UnexpectedValueException
		 * @throws Exception
		 */
		public function dnsLookup( $hostname, $type )
		{
			if ( preg_match( '/((WWW|www)?(\.)?)([0-9a-zA-Z_-]+)((\.{1})([a-zA-Z]{2,3}))$|([0-9]{1,3}\.){3}([0-9]{1,3})/',
				$hostname )
			)
			{
				$output   = array();
				$hostname = escapeshellarg( $hostname );

				switch ( strtoupper( $type ) )
				{
					CASE "A":
						@exec( "host -t {$type} {$hostname} | awk '{print $4}'", $output );
						if ( in_array( "found:", $output ) )
						{
							throw new Exception( "The host has no A records!" );
						}
						if ( in_array( "alias", $output ) )
						{
							for ( $i = 0; $i < count( $output ); $i++ )
							{
								$output[$i] = $output[$i + 1];
							}
							unset( $output[count( $output ) - 1] );
						}
						break;
					CASE "AAAA":
						@exec( "host -t {$type} {$hostname} | awk '{print $5}'", $output );
						if ( $output[0] == "record" )
						{
							throw new Exception( "The host has no AAAA records!" );
						}
						break;
					CASE "CNAME":
						@exec( "host -t {$type} {$hostname} | awk '{print $6}'", $output );
						if ( $output[0] == "" )
						{
							throw new Exception( "The host has no CNAME records!" );
						}
						break;
					CASE "MX":
						@exec( "host -t {$type} {$hostname} | awk '{print $7}'", $output );
						if ( $output[0] == "" )
						{
							throw new Exception( "The host has no MX records!" );
						}
						break;
					CASE "NS":
						@exec( "host -t {$type} {$hostname} | awk '{print $4}'", $output );
						if ( $output[0] == "NS" )
						{
							throw new Exception( "The host has no NS records!" );
						}
						if ( $output[0] == "alias" )
						{
							for ( $i = 0; $i < count( $output ); $i++ )
							{
								$output[$i] = $output[$i + 1];
							}
							unset( $output[count( $output ) - 1] );
						}
						break;
					CASE "TXT":
						@exec( "host -t {$type} {$hostname} | awk '{print $4 $5}'", $output );
						if ( $output[0] == "TXT" )
						{
							throw new Exception( "The host has no TXT records!" );
						}
						break;
					default:
						throw new UnexpectedValueException( "Wrong or Missing Record!" );
						break;
				}

				sort( $output );

				return $output;
			} else
			{
				throw new UnexpectedValueException( "The hostname is not correct" );
			}
		}

		/**
		 * @param $domain
		 *
		 * @return array
		 * @throws UnexpectedValueException
		 */
		public function whoIs( $domain )
		{
			if ( preg_match( '/((WWW|www)?(\.)?)([0-9a-zA-Z_-]+)((\.{1})([a-zA-Z]{2,3}))$/', $domain ) )
			{
				$output = array();
				$domain = escapeshellarg( $domain );
				@exec( "jwhois {$domain}", $output );

				return $output;
			} else
			{
				throw new UnexpectedValueException( "The vaule is not correct" );
			}
		}

	}
