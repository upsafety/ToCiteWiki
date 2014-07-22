<?php
// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: phpunit.php 44444 2013-01-05 21:24:24Z changi67 $

/**
* A simple wrapper around /usr/bin/phpunit to enable debugging
* tests with Xdebug from within Aptana or Eclipse.
* 
* Linux only (it should be simple to add support to other OSs).
*/
// Linux
require_once('/usr/bin/phpunit');

// Windows
// comment out the Linux require line (above) and uncomment the 2 lines below
//$pear_bin_path = getenv('PHP_PEAR_BIN_DIR').DIRECTORY_SEPARATOR;
//require_once($pear_bin_path."phpunit");
