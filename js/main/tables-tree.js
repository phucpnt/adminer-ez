/* 
 *  @link http://github.com/phucpnt/adminer-ez/#use
 *  @author Phuc PNT, http://github.com/phucpnt
 *  @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */

(function () {

	define(['jquery', 'vendors/tree.jquery'], function ($) {
		/**
		 * @type {Array}
		 */
		var data = ezTree;
		var copied = JSON.stringify(ezTree);
		var Module = function (el) {
			var $el = $(el);
			var $tree = $el.find('.ez-tree-view');
			$tree.tree({
				data: data,
				autoOpen: true,
				selectable: false,
				useContextMenu: false,
				onCreateLi: markItUp
			});
			var $search = $el.find('.ez-table-search');
			var tid = false;
			$search.on('keyup', function () {
				clearTimeout(tid);
				console.log($search.val());
				tid = setTimeout(function () {
					$tree.tree('loadData', filterIt($search.val(), JSON.parse(copied)));
				}, 100);
			});
		};
		var filterIt = function (search, data) {
			var filteredData = [];
			if (search === '') {
				return data;
			}
			$.each(data, function (index, group) {
				if (group.table_name && group.table_name.indexOf(search) >= 0) {
					filteredData.push(group);
				}
				else if (!group.children) {
					return;
				}
				var filteredTabs = [];
				$.each(group.children, function (index, table) {
					if (table.table_name.indexOf(search) >= 0) {
						filteredTabs.push(table);
					}
				});
				if (filteredTabs.length) {
					group.children = filteredTabs;
					filteredData.push(group);
				}
			});
			return filteredData;
		};
		var markItUp = function (table, $li) {
			if (!table.table_name) {
				return;
			}
			var select = document.createElement('a');
			select.text = 'Select';
			select.href = table.url_select;

			var structure = document.createElement('a');
			structure.text = table.table_name;
			structure.href = table.url_structure;

			$li.find('.jqtree-title')
							.before(select)
							.empty().append(structure)
							;
		};
		return Module;
	});

}.call(this));
