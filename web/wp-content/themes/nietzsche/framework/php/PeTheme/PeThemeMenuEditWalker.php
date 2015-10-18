<?php

class PeThemeMenuEditWalker extends Walker_Nav_Menu_Edit {
	
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$buffer = $output;
		parent::start_el($output,$item,$depth,$args,$id);

		$li = str_replace($buffer,"",$output);
		
		$fields = apply_filters("pe_theme_menu_custom_fields","",$item);

		if ($fields) {
			$fields = sprintf('<div class="pe_theme"><div class="contents">%s</div></div>',$fields);
			$li = preg_replace('/(<div class="menu-item-settings" .+>)/','\1'.$fields,$li);
		}

		$output = $buffer.$li;
	}

}

?>