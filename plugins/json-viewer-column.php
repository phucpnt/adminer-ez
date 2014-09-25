<?php

/*
 *  @link http://github.com/phucpnt/adminer-ez/#use
 *  @author Phuc PNT, http://github.com/phucpnt
 *  @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */

class AdminerJsonViewerColumn
{

	function editInput($table, $field, $attrs, $value) {
		$firstChar = substr($value, 0, 1);
		if (($firstChar == '{' || $firstChar == '[' ) && ($json			 = json_decode($value, true))) {
			echo '<pre class="adez-json-viewer" data-component="main/json-viewer" style="display:none"><code>' . $value . '</code></pre>';
		}
	}

}
