<?php
// region HERO
function get_hero_cta_and_callouts($hero_fields)
{
	$cta_fields = get_field('global_hero', 'option');
	$callout_fields = get_field('callout_icons', 'option');

	if (is_array($cta_fields) && empty($hero_fields['copy_main']) && empty($hero_fields['copy_secondary'])) {
		$hero_fields = array_merge($hero_fields, $cta_fields);
	}

	if (empty($hero_fields['callout_icons']) || $hero_fields['hero_global_icons']) {
		$hero_fields['callout_icons'] = $callout_fields;
	}

	return $hero_fields;
}

// region SECTONS
function get_scroll_panels($args = [])
{
	if (empty($args)) return null;

	$item_div_classes = !empty($args['item_div_classes']) ? $args['item_div_classes'] : ' bg-white flex flex-col lg:flex-row lg:gap-x-4 h-full overflow-hidden rounded-xl p-4 lg:px-6 transition-all duration-300 ease-in-out transform ';
	$item_img_classes = !empty($args['item_img_classes']) ? $args['item_img_classes'] : ' relative h-32 z-10 w-full object-contain ';
	$item_description_classes = !empty($args['item_description_classes']) ? $args['item_description_classes'] : ' text-gray-900 text-base px-3 lg:pl-0 leading-6 ';

	$panels = '<ul class="flex lg:grid lg:grid-cols-3 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-6 lg:gap-x-8 lg:gap-y-8 py-6 lg:px-8 overflow-x-auto relative bottom-8 lg:bottom-0">';
	$panels .= '<li class="rounded-xl w-1/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out"></li>';

	foreach ($args['content'] as $fields) {
		$panels .= '<li class="snap-item rounded-xl w-9/12 lg:w-full flex-shrink-0 snap-center opacity-65 lg:opacity-100 transition-all duration-300 ease-in-out">';
		$panels .= '<div class="' . $item_div_classes . '">';
		$panels .= '<div class="flex items-center justify-center p-2">';
		$panels .= '<div class="relative w-full max-w-lg aspect-auto">';
		$panels .= '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-brand opacity-50 rounded-full filter blur-xl"></div>';
		$panels .= '<img src="' . $fields['image']['url'] . '" alt="base image" class=" ' . $item_img_classes . '">';
		$panels .= '<img src="' . get_home_url() . '/wp-content/uploads/2024/07/spiral.svg" alt="overlay image" class="absolute inset-0 w-full h-full object-contain opacity-20">';
		$panels .= '</div></div>';
		$panels .= '<div class="mt-2 text-center lg:text-left px-3 z-10 lg:ml-4">';
		$panels .= '<h5 class="d-inline-block fw-bolder text-uppercase mt-3 mb-0 text-xl md:text-2xl">' . $fields['heading'] . '</h5>';
		$panels .= '<h5 class="text-gradient text-primary stylized mb-4 text-3xl antialiased-[unset]">' . $fields['subheading'] . '</h5>';
		$panels .= '<div class="mx-auto text-center lg:text-left max-w-[90%] lg:max-w-full mb-3">';
		$panels .= '<p class="' . $item_description_classes . '">' . $fields['description'] . '</p>';
		$panels .= '</div></div></div></li>';
	}

	$panels .= '<li class="rounded-xl w-3/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out"></li>';
	$panels .= '</ul>';

	return $panels;
}

function get_image_grid($content_array, $lg_grid_cols = 3, $height = null)
{
	if (!empty($content_array)) {
		$height = $height ?: '56';
		$image_grid = '<div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-' . $lg_grid_cols . ' xl:gap-x-8 divide-y divide-y-gray-50 lg:divide-y-0">';

		foreach ($content_array as $content) {
			$image_grid .= '<a href="' . $content['link'] .  '" class="group">';
			$image_grid .= '<div class="w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7 mt-10 lg:mt-0">';
			$image_grid .= '<img src="' . $content['image'] . '" class="h-' . $height . ' w-full object-cover object-center group-hover:opacity-75"/>';
			$image_grid .= '</div>';
			$image_grid .= '<h3 class="text-xl md:text-2xl lg:text-3xl mt-4 stylized text-orange">' . $content['heading']	 . '</h3>';
			$image_grid .= '<p class="line-clamp-3 text-gray-600 text-lg">' . $content['description']	 . '</p>';
			$image_grid .= '</a>';
		}
		$image_grid .= '</div>';
	}
	return $image_grid;
}
function get_vertical_list($content_array)
{
	if (!empty($content_array)) {
		$why_us = '';
		$i = 1;
		foreach ($content_array as $content_item) {
			$bg_color_class = $i === 2 ? ' bg-orange-100 ' : '';
			$description_color_class = $i === 2 ? ' text-gray-800 ' : ' text-gray-600 ';
			$why_us .= '<div class="relative px-6 lg:px-9 py-8' . $bg_color_class . '">';
			$why_us .= '<dt class="text-gray-900 lg:text-xl">';
			$why_us .= '<svg class="hidden absolute left-0 top-1 h-5 w-5 text-orange" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>';
			$why_us .= '<span class="text-xl font-heading text-blueGray font-bold antialiased block">' . $content_item['callout'] . '</span>';
			$why_us .= '<span class="stylized inline text-3xl lg:text-4xl  text-orange">' . $content_item['heading'] . '</span>';
			$why_us .= '<dd class=" mt-5 ' . $description_color_class . '">' . $content_item['description'] . '</dd>';
			$why_us .= '</dt>';
			$why_us .= '</div>';
			$i++;
		}
	}
	return $why_us;
}

function get_hero_fields($queried_obj)
{
	$hero_fields = get_field('hero_simple', $queried_obj);
	$legacy_hero_fields = get_hero_inputs($queried_obj);

	if (isset($hero_fields['image']['url'])) {
		$hero_fields['image'] = $hero_fields['image']['url'];
	}

	$hero_field_join = [
		'image' => '["images"]["background_image"]',
		'heading' => '["copy"]["heading_1"]["desktop"]',
		'subheading' => '["copy"]["heading_2"]["desktop"]',
		'description' => '["copy"]["description"]["desktop"]'
	];

	foreach ($hero_field_join as $key => $val) {
		if (empty($hero_fields[$key])) {
			$value = eval('return $legacy_hero_fields' . $val . ';');
			$hero_fields[$key] = $value;
		}
	}

	$hero_fields = get_hero_cta_and_callouts($hero_fields);

	return $hero_fields;
}

// GLOBAL
function tw_heading_classes($light_bg = true)
{
	$color = $light_bg ? ' text-blueGray ' : ' text-white ';
	return ' mb-0 md:leading-normal font-heading tracking-none text-2xl md:text-2xl lg:text-3xl mb-1 ' . $color;
}

function tw_callout_classes($light_bg = true)
{
	$color = $light_bg ? ' text-orange ' : ' text-blue ';
	return ' stylized font-normal text-4xl lg:text-6xl text-blue ' . $color;
}

function tw_form_cta_btn($args)
{
	if (empty($args)) return null;

	$btn_base_classes = ' rounded-md bg-orangeDark hover:bg-orangeLight px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm ';
	$btn_classes = !empty($args['classes']) ? $btn_base_classes . $args['classes'] : $btn_base_classes;

	$btn  = '<button ';
	$btn .= 'class="' . $btn_classes . '" ';
	$btn .= 'data-target="form" data-type="Form">';
	$btn .= $args['copy'] . '</button>';

	return $btn;
}
function tw_cta_btn($args)
{
	if (empty($args)) return null;
	$btn_base_classes = ' rounded-md bg-orangeDark hover:bg-orangeLight px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm ';
	$btn_classes = !empty($args['classes']) ? $btn_base_classes . $args['classes'] : $btn_base_classes;
	$btn  = '<button ';
	$btn .= 'class="' . $btn_classes . '" ';

	if ($args['attributes']) {
		$btn .= $args['attributes'];
	}

	$btn .= '>';
	$btn .= $args['copy'] . '</button>';

	return $btn;
}

function tw_section_open($bg_data = null)
{
	$section_open = '<section class="px-6 lg:px-0 py-16 md:py-24 ';

	if ($bg_data['classes']) {
		$section_open .= $bg_data['classes'];
	}

	$section_open .= '" ';

	if ($bg_data['image']) {
		$section_open .= 'style="background-image:url(';
		$section_open .= $bg_data['image'] . ')" ';
	}

	$section_open .= '>';

	return $section_open;
}

function tw_container_open()
{
	return '<div class="max-w-7xl mx-auto">';
}

function tw_container_and_section_close()
{
	return '</div></section>';
}

function tw_heading($post_id, $field_name, $align = null)
{
	$fields = get_field($field_name, $post_id);
	if (empty($fields['heading']) && empty($fields['subheading'])) {
		$field_prefix = 'global_' . $field_name . '_';
		$fields = [
			'background_color' => get_field($field_prefix . 'background_color', 'option'),
			'heading' => get_field($field_prefix . 'heading', 'option'),
			'subheading' => get_field($field_prefix . 'subheading', 'option'),
			'description' => get_field($field_prefix . 'description', 'option')
		];
	}

	if (empty($fields)) return;

	$bg_color = $fields['background_color'];

	$heading_base_classes = ' mb-0 md:leading-normal font-heading tracking-none text-2xl md:text-2xl lg:text-3xl ';
	$align_class = $align ?: ' text-center ';
	$heading_classes = ($bg_color === 'Dark') ? ' text-white ' : ' text-blueGray ';
	$heading  = '<div class="pb-12 ' . $align_class . '">';
	$heading .= '<h2 class="' . $heading_base_classes . $heading_classes . '">';
	$heading .= $fields['heading'] . '</h2>';

	if (isset($fields['subheading']) && !empty($fields['subheading'])) {
		$subheading_base_classes = ' stylized font-normal text-4xl lg:text-6xl ';
		$subheading_classes = ($bg_color === 'Dark') ? ' text-orangeLight ' : ' text-blue ';
		$heading .= '<h2 class="' . $subheading_base_classes . $subheading_classes . '">';
		$heading .= $fields['subheading'] . '</h2>';
	}

	if (isset($fields['description']) && !empty($fields['description'])) {

		$description_base_classes = 'font-normal text-base sm:text-lg md:text-xl ';
		$description_container_classes = ' md:max-w-xl ';

		if (isset($fields['max_width'])) {
			$description_container_classes .= ' lg:max-w-[' . $fields['max_width'] . 'rem] ';
		}

		$description_container_classes .= (!$align) ? ' mx-auto ' : ' ';
		$description_classes = ($bg_color === 'Dark') ? ' text-white ' : ' text-gray-600 ';
		$heading .= '<div class="mt-6' . $description_container_classes . '">';
		$heading .= '<p class="' . $description_base_classes . $description_classes . '">';
		$heading .= $fields['description'] . '</p>';
		$heading .= '</div>';
	}

	$heading .= '</div>';

	return $heading;
}

function tw_section_heading($copy = [], $bg_light = true, $align = null)
{
	$heading_base_classes = ' mb-0 md:leading-normal font-heading tracking-none text-xl md:text-2xl lg:text-3xl ';
	$heading_classes = (!$bg_light) ? ' text-white ' : ' text-blueGray ';
	$align_class = $align ?: ' text-center ';
	$heading  = '<div class="pb-12 ' . $align_class . '">';
	$heading .= '<h2 class="' . $heading_base_classes . $heading_classes . '">';
	$heading .= $copy['heading'] . '</h2>';

	if (isset($copy['subheading']) && !empty($copy['subheading'])) {
		$subheading_base_classes = ' stylized font-normal text-3xl md:text-4xl lg:text-6xl ';
		$subheading_classes = (!$bg_light) ? ' text-orangeLight ' : ' text-blue ';
		$heading .= '<h2 class="' . $subheading_base_classes . $subheading_classes . '">';
		$heading .= $copy['subheading'] . '</h2>';
	}

	if (isset($copy['description']) && !empty($copy['description'])) {
		$description_base_classes = 'font-normal text-base sm:text-base md:text-lg ';
		$description_classes = (!$bg_light) ? ' text-white ' : ' text-gray-600 ';
		$heading .= '<div class="mt-6 ';

		if (!$align) {
			$heading .= ' md:max-w-2xl mx-auto ';
		}
		$heading .= ' ">';
		$heading .= '<p class="' . $description_base_classes . $description_classes . '">';
		$heading .= $copy['description'] . '</p></div>';
	}

	$heading .= '</div>';

	return $heading;
}
