/* 
 *  @link http://github.com/phucpnt/adminer-ez/#use
 *  @author Phuc PNT, http://github.com/phucpnt
 *  @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */


(function(){

	define(['jquery', 'vendors/jquery.jsonview'], function($){
		var Viewer = function(el){
			var $el = $(el);
			var val = $(el).find('code').html();
			$el.JSONView(val, {collapsed: true}).show();
		};

		return Viewer;
	});

}.call(this));