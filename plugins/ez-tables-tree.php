<?php
/*
 *  @link http://github.com/phucpnt/adminer-ez/#use
 *  @author Phuc PNT, http://github.com/phucpnt
 *  @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 *  @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
 */

class AdminerEzTablesTree
{

	function rowRender($table) {
		echo '<span class="table-row">'
		. '<a href="' . h(ME) . 'select=' . urlencode($table) . '"' . bold($_GET["select"] == $table, 'action') . ">" . lang('select') . "</a> ";
		echo ' <a href="' . h(ME) . 'table=' . urlencode($table) . '"' . bold($_GET["table"] == $table, 'table-name') . ">" . h($table) . "</a><br>"
		. "</span>\n";
	}

	function mapItems($tabs) {
		$mapped = array();
		foreach ($tabs as $tab) {
			$mapped[] = array(
				'label'				 => $tab,
				'table_name'	 => $tab,
				'url_select'	 => (ME) . 'select=' . urlencode($tab),
				'url_structure' => (ME) . 'table=' . urlencode($tab)
			);
		}
		return $mapped;
	}

	function optimize($morethan, $indentedGroup) {
		$tree = array();
		foreach ($indentedGroup as $prefix => $tables) {
			if (count($tables) <= $morethan) {
				$tree = array_merge($tree, $this->mapItems($tables));
			} else {
				$subTree = array(
					'label'		 => $prefix,
					'children' => $this->mapItems($tables),
				);
				$tree[]	 = $subTree;
			}
		}
		return $tree;
	}

	function tablesPrint($tables) {
		$indent1st = array();
		foreach ($tables as $table => $type) {
			$prefix = substr($table, 0, strpos($table, '_') + 1);
			if (empty($indent1st[$prefix])) {
				$indent1st[$prefix] = array();
			}
			$indent1st[$prefix][] = $table;
		}
		$moreThan	 = 2;
		$tree			 = $this->optimize($moreThan, $indent1st);
		?>
		<div class="ez-tables-tree" data-component="main/tables-tree">
			<p><input type="text" placeholder="search table..." class="ez-table-search"/></p>
			<div class="ez-tree-view">
			</div>
		</div>
		<script>var ezTree = <?php echo json_encode($tree) ?>;</script>
		<?php
		return true;
	}

}
