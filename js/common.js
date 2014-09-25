/* 
 *  @link http://github.com/phucpnt/adminer-ez/#use
 *  @author Phuc PNT, http://github.com/phucpnt
 *  @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */

(function () {
	require.config({
		paths: {
			'app': './main',
			'vendors': './vendors',
			'jquery': './vendors/jquery-2.1.1.min'
		}
	});

	require(['require', 'jquery'], function (require, jquery) {
		var $ = jquery;
		$(function () {
			$('[data-component]').each(function () {
				var $el = $(this);
				var moduleId = $(this).data('component');
				require([moduleId], function (Module) {
					new Module($el);
				});
			});
		});
	});

}).call(this);