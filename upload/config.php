<?php
    session_start();
    ob_start();

    /**
     * Variables needed for the configuration.
	 * @var $scriptName is the variable used for the default name of the script
	 * @var $extraDirectory is the Variable used for the subdirectory, if you are putting the script in a different folder
	 * rather than public_html
     */
    $scriptName = "HostChecker"; // The name of the script

    $extraDirectory = "HostChecker"; // The subdirectory

    /**
     * A specific variable if the script will be used in inner folder
     * keep it empty if the script is in the public_html folder
     */
    define('LIB_PATH', ($extraDirectory != "") ? $_SERVER['DOCUMENT_ROOT']. "/" . $extraDirectory . "/lib/" : $_SERVER['DOCUMENT_ROOT'] . "lib/" );

    /**
     * The following files are to be included in the main script
     */
    require_once LIB_PATH . 'Main.php';
    require_once LIB_PATH . 'Database.php';
    require_once LIB_PATH . 'Users.php';
    require_once LIB_PATH . 'Check.php';

    /**
     * Instantiating the database with its default values
     */
    $db = new Database("localhost", "hostchecker", "sadi", "30121992");
    $db->connect() or die("Database could not connect: " . mysql_error());

