<?php 

/**
 * archive module
 * Table definition for 'items'
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/default
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Items';
$zz['table'] = '/*_PREFIX_*/items';

$zz['fields'][1]['field_name'] = 'item_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][13]['field_name'] = 'code';

$zz['fields'][3]['field_name'] = 'identifier';
$zz['fields'][3]['type'] = 'identifier';
$zz['fields'][3]['fields'] = ['code'];
$zz['fields'][3]['hide_in_list'] = true;

$zz['fields'][2]['field_name'] = 'item';

$zz['fields'][4]['field_name'] = 'description';
$zz['fields'][4]['type'] = 'memo';
$zz['fields'][4]['hide_in_list'] = true;

$zz['fields'][5]['title'] = 'Category';
$zz['fields'][5]['field_name'] = 'type_category_id';
$zz['fields'][5]['type'] = 'select';
$zz['fields'][5]['sql'] = 'SELECT category_id, category, main_category_id
	FROM categories
	ORDER BY path';
$zz['fields'][5]['display_field'] = 'category';
$zz['fields'][5]['show_hierarchy'] = 'main_category_id';
$zz['fields'][5]['show_hierarchy_subtree'] = wrap_category_id('item-types');

$zz['fields'][6]['title'] = 'Width';
$zz['fields'][6]['field_name'] = 'width_cm';
$zz['fields'][6]['unit'] = 'cm';
$zz['fields'][6]['type'] = 'number';

$zz['fields'][11]['title'] = 'Length';
$zz['fields'][11]['field_name'] = 'length_cm';
$zz['fields'][11]['unit'] = 'cm';
$zz['fields'][11]['type'] = 'number';

$zz['fields'][7]['title'] = 'Height';
$zz['fields'][7]['field_name'] = 'height_cm';
$zz['fields'][7]['unit'] = 'cm';
$zz['fields'][7]['type'] = 'number';

$zz['fields'][8] = zzform_include('items-media');
$zz['fields'][8]['title'] = 'Media';
$zz['fields'][8]['type'] = 'subtable';
$zz['fields'][8]['fields'][2]['type'] = 'foreign_key';

$zz['fields'][9]['field_name'] = 'remarks';
$zz['fields'][9]['type'] = 'memo';
$zz['fields'][9]['hide_in_list'] = true;

$zz['fields'][10]['title'] = 'Main Item';
$zz['fields'][10]['field_name'] = 'main_item_id';
$zz['fields'][10]['type'] = 'select';
$zz['fields'][10]['sql'] = 'SELECT item_id, code, item
	FROM items
	ORDER BY identifier';
$zz['fields'][10]['hide_in_list'] = true;

$zz['fields'][98]['title'] = 'Entry created';
$zz['fields'][98]['field_name'] = 'created';
$zz['fields'][98]['type'] = 'datetime';
$zz['fields'][98]['default'] = 'current_date';
$zz['fields'][98]['dont_copy'] = true;
$zz['fields'][98]['hide_in_list'] = true;

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;

$zz['sql'] = 'SELECT /*_PREFIX_*/items.*
		, /*_PREFIX_*/categories.category
	FROM /*_PREFIX_*/items
	LEFT JOIN /*_PREFIX_*/categories
		ON /*_PREFIX_*/items.type_category_id = /*_PREFIX_*/categories.category_id';
$zz['sqlorder'] = ' ORDER BY identifier';

$zz['record']['copy'] = true;
