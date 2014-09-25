<?php

/* 
 *  @link http://github.com/phucpnt/adminer-ez/#use
 *  @author Phuc PNT, http://github.com/phucpnt
 *  @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */

class AdminerEzHead{

	public function head(){
		$js = array(
			'vendors/requirejs.js',
		);
		echo '<script src="js/vendors/require.js" data-main="js/common.js"></script>';
	}
}