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
	$item_img_container_classes = !empty($args['item_img_container_classes']) ? $args['item_img_container_classes'] : ' flex items-center justify-center p-2 ';
	$ul_classes = !empty($args['ul_classes']) ? $args['ul_classes'] : ' flex lg:grid lg:grid-cols-3 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-6 lg:gap-x-8 lg:gap-y-8 py-6 lg:px-8 overflow-x-auto relative bottom-8 lg:bottom-0 ';

	$panels = '<ul class="' . $ul_classes . '">';
	$panels .= '<li class="rounded-xl w-1/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out"></li>';

	foreach ($args['content'] as $fields) {
		$panels .= '<li class="snap-item rounded-xl w-9/12 lg:w-full flex-shrink-0 snap-center opacity-65 lg:opacity-100 transition-all duration-300 ease-in-out">';
		$panels .= '<div class="' . $item_div_classes . '">';
		$panels .= '<div class="' . $item_img_container_classes . '">';
		$panels .= '<div class="relative w-full max-w-lg aspect-auto">';
		$panels .= '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-brand-500-500-500 opacity-50 rounded-full filter blur-xl"></div>';
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

function get_image_grid($content_collection)
{
	if (!empty($content_collection['content'])) {
		$grid_classes = !empty($content_collection['classes']['grid']) ? $content_collection['classes']['grid'] : ' grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 divide-y divide-y-gray-50 lg:divide-y-0 ';
		$heading_classes = !empty($content_collection['classes']['heading']) ? $content_collection['classes']['heading'] : ' text-[2rem] md:text-3xl lg:text-4xl mt-4 stylized text-secondary-500 ';
		$copy_container_classes = !empty($content_collection['classes']['copy_container']) ? $content_collection['classes']['copy_container'] : ' ';
		$image_classes = !empty($content_collection['classes']['image']) ? $content_collection['classes']['image'] : ' md:h-56 w-full object-cover object-center group-hover:opacity-75 ';
		$description_classes = !empty($content_collection['classes']['description']) ? $content_collection['classes']['description'] : ' line-clamp-3 text-gray-600 text-lg ';

		$image_grid = '<div class="' . $grid_classes . '">';

		foreach ($content_collection['content'] as $content) {
			$image_grid .= '<a href="' . $content['link'] .  '" class="group rounded-md ease-linear duration-100 ring-1 ring-gray-200 hover:scale-105 hover:ring-1 hover:ring-gray-400/20 hover:bg-sky-50/40 hover:shadow-md ">';
			$image_grid .= '<div class="w-full overflow-hidden rounded-t-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7 lg:mt-0 ">';
			$image_grid .= '<img src="' . $content['image'] . '" class="' . $image_classes . '"/>';
			$image_grid .= '</div>';
			$image_grid .= '<div class="rounded-md px-4 pt-5 pb-8 ">';

			if (isset($content_collection['badges']) && $content_collection['badges']) {
				$image_grid .= '<div class="h-6">';
			}

			if (!empty($content['badges'])) {
				$image_grid .= $content['badges'];
			}

			if (isset($content_collection['badges']) && $content_collection['badges']) {
				$image_grid .= '</div>';
			}

			$image_grid .= '<h3 class="' . $heading_classes . '">' . $content['heading']	 . '</h3>';

			if (!empty($content['description'])) {
				$image_grid .= '<p class="' . $description_classes . '">' . $content['description']	 . '</p>';
			}

			$image_grid .= '</div>';
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
			$heading_color_class = $i === 2 ? ' text-brand-700 ' : ' text-brand-700 ';
			$callout_color_class = $i === 2 ? ' text-secondary-600 ' : ' text-secondary-500 ';
			$description_color_class = $i === 2 ? ' text-gray-800 ' : ' text-gray-600 ';
			$why_us .= '<div class="relative px-6 lg:px-9 py-8' . $bg_color_class . '">';
			$why_us .= '<dt class="lg:text-xl ' . $heading_color_class . '">';
			$why_us .= '<svg class="hidden absolute left-0 top-1 h-5 w-5 text-secondary-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>';
			$why_us .= '<div class="text-xl">';
			$why_us .= '<span class="font-heading ' . $heading_color_class .  ' font-semibold antialiased block">' . $i . ') '  . $content_item['callout'] . '</span>';
			$why_us .= '<span class="stylized inline text-[150%] leading-[1] sm:leading-normal ' . $callout_color_class . '">' . $content_item['heading'] . '</span>';
			$why_us .= '</div>';
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
		$hero_fields['mobile_image'] = $hero_fields['mobile_image']['url'];
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
	$color = $light_bg ? ' text-brand-500-700 ' : ' text-white ';
	return ' mb-0 md:leading-normal font-heading tracking-none text-2xl md:text-2xl lg:text-3xl mb-1 ' . $color;
}

function tw_callout_classes($light_bg = true)
{
	$color = $light_bg ? ' text-secondary-500 ' : ' text-brand-500 ';
	return ' stylized font-normal text-4xl leading-[2.5rem] lg:leading-[3.5rem] lg:text-6xl text-brand-500 ' . $color;
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

function tw_section_open($section_attributes = null)
{
	$section_grid_classes = isset($section_attributes['grid_classes']) ? $section_attributes['grid_classes'] : ' px-6 lg:px-0 py-16 md:py-24 relative ';

	$section_open = '<section class="' . $section_grid_classes;

	if ($section_attributes['classes']) {
		$section_open .= $section_attributes['classes'];
	}

	$section_open .= '" ';

	if ($section_attributes['id']) {
		$section_open .= 'id="' . $section_attributes['id'] . '" ';
	}

	$section_open .= '>';

	if ($section_attributes['mobile_image']) {
		$section_open .= '<div class="absolute h-full w-full inset-0 bg-cover bg-center md:hidden" ';
		$section_open .= 'style="background-image: url(' . $section_attributes['mobile_image'] . ');">';
		$section_open .= '</div>';
	}

	if ($section_attributes['image']) {
		$section_open .= '<div class="absolute h-full w-full inset-0 bg-cover bg-center hidden sm:block" ';
		$section_open .= 'style="background-image: url(' . $section_attributes['image'] . ');">';
		$section_open .= '</div>';
	}

	if (!empty($section_attributes['overlay_classes'])) {
		$section_open .= '<div class="absolute h-full w-full inset-0 ' . $section_attributes['overlay_classes'] . ' "></div>';
	}


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

	$heading_base_classes = ' mb-0 md:leading-normal font-heading font-semibold antialiased tracking-none col-span-12 ';
	$align_class = $align ?: ' text-center ';
	$heading_classes = ($bg_color === 'Dark') ? ' text-white ' : ' text-brand-700 ';
	$heading  = '<div class="z-10 relative grid grid-cols-12 sm:block sm:pb-12 text-2xl md:text-2xl lg:text-3xl ' . $align_class . '">';
	$heading .= '<h2 class="' . $heading_base_classes . $heading_classes . '">';
	$heading .= $fields['heading'] . '</h2>';

	if (isset($fields['subheading']) && !empty($fields['subheading'])) {
		$subheading_base_classes = ' stylized font-normal text-[150%] ';
		$subheading_classes = ($bg_color === 'Dark') ? ' text-secondary-400 ' : ' text-brand-500 ';
		$subheading_align_classes = $align ? ' col-span-10 col-start-2 ' : ' col-span-12 ';
		$heading .= '<h2 class="' . $subheading_base_classes . $subheading_classes . $subheading_align_classes .  '">';
		$heading .= $fields['subheading'] . '</h2>';
	}

	if (isset($fields['description']) && !empty($fields['description'])) {

		$description_base_classes = 'font-normal text-base sm:text-lg md:text-xl  ';
		$description_container_classes = ' md:max-w-xl ';

		if (isset($fields['max_width'])) {
			$description_container_classes .= ' lg:max-w-[' . $fields['max_width'] . 'rem] ';
		}

		$description_container_classes .= (!$align) ? ' mx-2 sm:mx-auto ' : ' ';
		$description_classes = ($bg_color === 'Dark') ? ' text-white ' : ' text-gray-600 ';
		$description_align_classes = $align ? ' sm:mx-0 ' : ' mx-4 sm:mx-auto ';
		$heading .= '<div class="mt-4 sm:mt-6 col-span-12 ' . $description_align_classes . $description_container_classes . '">';
		$heading .= '<p class="' . $description_base_classes . $description_classes . '">';
		$heading .= $fields['description'] . '</p>';
		$heading .= '</div>';
	}

	$heading .= '</div>';

	return $heading;
}

function tw_section_heading($copy = [], $bg_light = true, $align = null)
{
	$heading_base_classes = ' mb-0 md:leading-normal font-heading font-bold tracking-none text-xl md:text-2xl lg:text-3xl ';
	$heading_classes = (!$bg_light) ? ' text-white ' : ' text-brand-700 ';
	$align_class = $align ?: ' text-center ';
	$heading  = '<div class="pb-12 ' . $align_class . '">';
	$heading .= '<h2 class="' . $heading_base_classes . $heading_classes . '">';
	$heading .= $copy['heading'] . '</h2>';

	if (isset($copy['subheading']) && !empty($copy['subheading'])) {
		$subheading_base_classes = ' stylized font-normal text-3xl md:text-4xl lg:text-6xl ';
		$subheading_classes = (!$bg_light) ? ' text-secondary-400 ' : ' text-brand-500 ';
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
