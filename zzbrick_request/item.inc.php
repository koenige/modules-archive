<?php 

/**
 * archive module
 * Show an item
 *
 * Part of »Zugzwang Project«
 * https://www.zugzwang.org/modules/archive
 *
 * @author Gustaf Mossakowski <gustaf@koenige.org>
 * @copyright Copyright © 2025 Gustaf Mossakowski
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL-3.0
 */


function mod_archive_item($params) {
	if (count($params) !== 1) return false;
	
	$sql = 'SELECT items.item_id, items.item, items.code, items.identifier
			, items.description, items.width_cm, items.length_cm, items.height_cm
			, items.remarks, items.created
			, category
			, main_items.identifier AS main_identifier
			, main_items.item AS main_item
			, main_items.code AS main_code
		FROM items
		LEFT JOIN categories
			ON items.type_category_id = categories.category_id
		LEFT JOIN items main_items
			ON items.main_item_id = main_items.item_id
		WHERE items.identifier = "%s"';
	$sql = sprintf($sql, $params[0]);
	$data = wrap_db_fetch($sql);
	if (!$data) return false;
	
	$sql = 'SELECT items.item_id, item, code, identifier
		FROM items
		LEFT JOIN items_media
			ON items_media.item_id = items.item_id
			AND sequence = 1
		WHERE main_item_id = %d
		ORDER BY code';
	$sql = sprintf($sql, $data['item_id']);
	$data['inside'] = wrap_db_fetch($sql, 'item_id');
	
	$data += wrap_get_media($data['item_id'], 'items', 'item');
	if (!empty($data['images_overview'])) {
		foreach ($data['images_overview'] as $medium_id => $medium) {
			$data['images_overview'][$medium_id]['path'] = '480';
			$data['images_overview'][$medium_id]['bigger_size_available'] = true;
		}
		$page['extra']['magnific_popup'] = true;
	}
	if (!empty($data['images'])) {
		foreach ($data['images'] as $medium_id => $medium) {
			$data['images'][$medium_id]['path'] = '240';
			$data['images'][$medium_id]['bigger_size_available'] = true;
		}
		$page['extra']['magnific_popup'] = true;
	}
	
	$page['text'] = wrap_template('item', $data);
	$page['title'] = $data['code'].'<br> '.$data['item'];
	$page['breadcrumbs'][]['title'] = $data['code'];
	return $page;
}
