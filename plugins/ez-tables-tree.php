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
		echo '<span class="table-row"><a href="' . h(ME) . 'select=' . urlencode($table) . '"' . bold($_GET["select"] == $table) . ">" . lang('select') . "</a> ";
		echo '<a href="' . h(ME) . 'table=' . urlencode($table) . '"' . bold($_GET["table"] == $table) . ">" . h($table) . "</a><br></span>\n";
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
		$moreThan = 2;
		?>
		<div class="ez-tables-tree" data-component="main/tables-tree">
			<p><input type="text" placeholder="search" class="ez-table-search"/></p>
			<div class="ez-tree-view">
				<ul>
					<?php
					foreach ($indent1st as $prefix => $tabs):
						if (count($tabs) > $moreThan):
							?>
							<li><?php echo $prefix ?>
								<ul>
									<?php
									foreach ($tabs as $table):
										?>
										<li> <?php $this->rowRender($table); ?> </li>
										<?php
									endforeach;
									?>
								</ul>
							</li>
							<?php
						else:
							foreach ($tabs as $tab):
								?>
								<li> <?php $this->rowRender($tab); ?> </li>
								<?php
							endforeach;
						endif;
					endforeach;
					?>
				</ul>
			</div>
		</div>
		<?php
		return true;
	}

}
