<?php 

/**
 * archive module
 * Table definition for 'items/categories'
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/archive
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


$zz['title'] = 'Item Categories';
$zz['table'] = '/*_PREFIX_*/items_categories';

$zz['fields'][1]['title'] = 'ID';
$zz['fields'][1]['field_name'] = 'item_category_id';
$zz['fields'][1]['type'] = 'id';

$zz['fields'][4]['title'] = 'No.';
$zz['fields'][4]['field_name'] = 'sequence';
$zz['fields'][4]['type'] = 'number';

$zz['fields'][2]['field_name'] = 'item_id';
$zz['fields'][2]['type'] = 'select';
$zz['fields'][2]['sql'] = 'SELECT /*_PREFIX_*/items.item_id
		, code, /*_PREFIX_*/items.item
	FROM /*_PREFIX_*/items 
	ORDER BY /*_PREFIX_*/items.identifier';
$zz['fields'][2]['sql_character_set'][1] = 'utf8';
$zz['fields'][2]['sql_character_set'][2] = 'utf8';
$zz['fields'][2]['display_field'] = 'item';
$zz['fields'][2]['exclude_from_search'] = true;

$zz['fields'][3]['field_name'] = 'category_id';
$zz['fields'][3]['type'] = 'select';
$zz['fields'][3]['sql'] = 'SELECT category_id, category, description, main_category_id
	FROM /*_PREFIX_*/categories
	ORDER BY sequence, category';
$zz['fields'][3]['display_field'] = 'category';
$zz['fields'][3]['search'] = '/*_PREFIX_*/categories.category';
$zz['fields'][3]['show_hierarchy'] = 'main_category_id';
$zz['fields'][3]['show_hierarchy_subtree'] = wrap_category_id('tags');
if ($path = wrap_path('default_tables', 'categories'))
	$zz['fields'][3]['add_details'] = sprintf('%s?filter[maincategory]=%d', $path, wrap_category_id('tags'));

$zz['fields'][5]['field_name'] = 'type_category_id';
$zz['fields'][5]['type'] = 'hidden';
$zz['fields'][5]['type_detail'] = 'select';
$zz['fields'][5]['value'] = wrap_category_id('tags');
$zz['fields'][5]['hide_in_form'] = true;
$zz['fields'][5]['hide_in_list'] = true;
$zz['fields'][5]['exclude_from_search'] = true;
$zz['fields'][5]['for_action_ignore'] = true;

$zz['fields'][6]['field_name'] = 'property';
$zz['fields'][6]['typo_cleanup'] = true;

$zz['fields'][99]['field_name'] = 'last_update';
$zz['fields'][99]['type'] = 'timestamp';
$zz['fields'][99]['hide_in_list'] = true;


$zz['sql'] = 'SELECT /*_PREFIX_*/items_categories.*
		, /*_PREFIX_*/categories.category
		, /*_PREFIX_*/items.item
	FROM /*_PREFIX_*/items_categories
	LEFT JOIN /*_PREFIX_*/items USING (item_id)
	LEFT JOIN /*_PREFIX_*/categories USING (category_id)
';
$zz['sqlorder'] = ' ORDER BY /*_PREFIX_*/items.filename, /*_PREFIX_*/items_categories.sequence, /*_PREFIX_*/categories.path';
