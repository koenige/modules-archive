<?php 

/**
 * archive module
 * Form for 'items'
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/default
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz = zzform_include('items');

$values = [];
mf_default_categories_restrict($values, 'items');

if (array_key_exists('items', $values)) {
	$i = 30;
	foreach ($values['items'] as $category_id => $category) {
		mf_default_categories_subtable($zz, 'items', 'items', 30);
		$i++;
	}
}
