<?php
/* Template Name: Destinations */
get_header(); ?>

<?php
$location_region_terms = get_location_region_tax_terms();

if (!empty($location_region_terms)) {
    // $nav  = '<nav class="flex flex-1 flex-col bg-gray-50 px-4 py-7 ring-1 ring-gray-200/90 rounded shadow-sm" aria-label="Sidebar">';
    // $nav .= '<ul role="list" class="space-y-1">';
    $nav  = '<nav id="sidebar-nav" class="hidden md:block flex-1 flex-col px-4 py-7 rounded shadow-sm overflow-y-auto" aria-label="Sidebar">';
    $nav .= '<ul role="list" class="space-y-1 overscroll-none overflow-auto " id="sidebar-content">';
    $content = '<div class="flex flex-col gap-y-16">';

    foreach ($location_region_terms as $location_region) {
        // Navigation
        $nav .= '<li class="flex">';
        $nav .= '<div class="w-10 flex-shrink-0">';
        $nav .= '<img class="w-8 h-auto object-contain icon-blue-filter" src="' . esc_url(get_field('region_icon', $location_region)) . '" alt="">';
        $nav .= '</div>';
        $nav .= '<div class="flex-grow">';
        $nav .= '<a href="#region_' . esc_attr($location_region->term_id) . '" class="block p-2 text-base font-semibold leading-6 text-gray-800">';
        $nav .= esc_html($location_region->name);
        $nav .= '</a>';

        // Content - Region Card
        $content .= '<div id="region_' . esc_attr($location_region->term_id) . '" class="group/region flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">';
        $content .= '<a href="' . esc_url(get_term_link($location_region)) . '" class="block">';
        $content .= '<img class="group-hover/region:opacity-75 h-44 lg:h-56 w-full rounded-t-xl" src="' . get_field('featured_image', $location_region)['url'] . '" alt="' . esc_attr($location_region->name) . '">';
        $content .= '<div class="p-5 md:p-6 lg:p-7">';
        $content .= '<h3 class="text-2xl md:text-2xl lg:text-3xl tracking-normal font-base font-bold text-gray-800 group-hover/region:text-brand-500">' . esc_html($location_region->name) . '</h3>';
        $content .= '<p class="mt-1 text-gray-500 dark:text-neutral-400 text-base line-clamp-3 ">' . esc_html($location_region->description) . '</p>';
        $content .= '</div>';
        $content .= '</a>';

        $location_posts_by_region = get_location_posts_by_location_region_tax([$location_region], true);

        if (!empty($location_posts_by_region) && !empty($location_posts_by_region[0])) {
            $nav .= '<ul class="ml-2">';
            $content .= '<div class="grid grid-cols-1 gap-y-6 py-6 md:p-6 lg:p-7 mb-5">';
            $content .= '<div class="my-6 flex items-center gap-x-4 px-3">';
            $content .= '<div class="h-[1px] flex-auto bg-brand-500/20"></div>';
            $content .= '<p class="flex-none text-center text-base text-gray-500 font-semibold antialiased">';
            $content .= 'The cities  of ' .  esc_html($location_region->name) . '</p>';
            $content .= '<div class="h-[1px] flex-auto bg-brand-500/20"></div>';
            $content .= '</div>';

            foreach ($location_posts_by_region[0] as $location_post) {
                // Navigation
                $nav .= '<li>';
                $nav .= '<a href="#post_' . esc_attr($location_post->ID) . '" class="block px-2 py-1 text-sm text-gray-600 hover:text-indigo-600">';
                $nav .= esc_html(get_the_title($location_post->ID));
                $nav .= '</a>';
                $nav .= '</li>';

                // Content - Location Post Card (Horizontal)
                $content .= '<div id="post_' . esc_attr($location_post->ID) . '" class="flex bg-white rounded-b-xl sm:rounded-xl border-transparent hover:bg-brand-100/30 hover:border-brand-500 hover:shadow-md group">';
                $content .= '<a href="' . esc_url(get_permalink($location_post->ID)) . '" class="flex flex-col sm:flex-row w-full">';
                $content .= '<img class="rounded-0 sm:rounded-tl-xl sm:rounded-bl-xl group-hover:opacity-75 h-20 sm:h-auto w-full sm:w-1/3 object-cover" src="' . get_field('featured_image', $location_post)['sizes']['large'] . '" alt="' . esc_attr(get_the_title($location_post->ID)) . '">';
                $content .= '<div class="w-full sm:w-2/3 p-5 overflow-hidden">';
                $content .= '<h3 class="text-lg font-base tracking-normal font-semibold text-gray-800 group-hover:text-brand-500 dark:text-white">' . esc_html(get_the_title($location_post->ID)) . '</h3>';
                $content .= '<p class="mt-1 text-gray-500 group-hover:text-gray-600 text-sm sm:text-sm">' . wp_kses_post(wp_trim_words(wp_strip_all_tags(get_field('content_clean', $location_post->ID)), 20)) . '</p>';
                $content .= '</div>';
                $content .= '</a>';
                $content .= '</div>';
            }

            $nav .= '</ul>';
            $content .= '</div>';
            $content .= '</div>'; // Close region card
        }

        $nav .= '</div>';
        $nav .= '</li>';
    }

    $nav .= '</ul>';
    $nav .= '</nav>';

    $content .= '</div>';
?>



    <?php echo tw_section_open(); ?>

    <?php echo tw_container_open(); ?>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-x-8" id="location-posts">

        <div class="md:col-span-3">
            <?php echo $nav; ?>
        </div>

        <div class="md:col-span-9">
            <?php echo $content ?>
        </div>
    </div>

    <?php echo tw_container_close(); ?>

    <?php echo get_section_close(); ?>


<?php } ?>

<?php get_footer(); ?>