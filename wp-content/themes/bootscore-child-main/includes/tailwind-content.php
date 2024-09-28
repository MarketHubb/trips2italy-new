<?php
/**
 * Get the image source for a post in the post list.
 *
 * This function retrieves the image source for a given post. For posts of type 'package',
 * it attempts to get the URL from the 'featured_image' ACF field. For other post types,
 * or if the ACF field is not set, it returns null.
 *
 * @param int $post_id The ID of the post for which to retrieve the image source.
 *
 * @return string|null The URL of the image source if found, null otherwise.
 *
 * @uses get_post_type() To check the type of the given post.
 * @uses get_field() To retrieve the ACF field value (requires Advanced Custom Fields plugin).
 *
 * @since 1.0.0
 *
 * @example
 * $image_src = get_post_list_img_src(123);
 * if ($image_src) {
 *     echo '<img src="' . esc_url($image_src) . '" alt="Featured Image">';
 * }
 */
function get_post_list_img_src($post_id)
{
    if (!isset($post_id)) return;

    if (get_post_type($post_id) === 'package') {
        $image_src = get_field('featured_image', $post_id)['url'];
    }

    return $image_src ?: null;
}

/**
 * Get a custom excerpt for a post in the post list.
 *
 * This function retrieves a custom excerpt for a given post. For posts of type 'package',
 * it gets the content from the 'description' ACF field. The excerpt is then truncated
 * to approximately 150 characters. For other post types, or if the ACF field is not set,
 * it returns null.
 *
 * @param int $post_id The ID of the post for which to retrieve the excerpt.
 *
 * @return string|null A truncated excerpt of approximately 150 characters if found, null otherwise.
 *
 * @uses get_post_type() To check the type of the given post.
 * @uses get_field() To retrieve the ACF field value (requires Advanced Custom Fields plugin).
 * @uses return_portion_of_text() A custom function to truncate the text to a specified length.
 *
 * @since 1.0.0
 *
 * @example
 * $excerpt = get_post_list_excerpt(123);
 * if ($excerpt) {
 *     echo '<p class="excerpt">' . esc_html($excerpt) . '</p>';
 * }
 */
function get_post_list_excerpt($post_id)
{
    if (!isset($post_id)) return;

    if (get_post_type($post_id) === 'package') {
        $excerpt = get_field('description', $post_id);
    }

    return return_portion_of_text($excerpt, 150) ?: null;
}

/**
 * Generate HTML markup for a list of blog posts.
 *
 * This function takes an array of post objects and generates HTML markup
 * for each post, including the featured image, publication date, title,
 * and excerpt. The generated HTML is based on the Tailwind UI blog posts component
 * and uses Tailwind CSS classes for styling.
 *
 * @link https://tailwindui.com/components/marketing/sections/blog-sections Tailwind UI Blog Posts Component
 *
 * @param array $posts An array of post objects to be rendered.
 *
 * @return string The concatenated HTML markup for all provided posts.
 *                Returns an empty string if the input array is empty.
 *
 * @uses get_the_post_thumbnail_url() To get the URL of the post's featured image.
 * @uses get_the_date() To get the formatted date of the post.
 * @uses get_the_title() To get the title of the post.
 * @uses get_the_excerpt() To get the excerpt of the post.
 * @uses get_excerpt_for_post() A custom function to limit the excerpt length.
 *
 * @since 1.0.0
 */
function get_post_list($query = null, $args = [])
{
    if (!$query || !$query->have_posts()) return null;

    $output = '';

    while ($query->have_posts()) : $query->the_post();
        // Vars
        $image_src = isset($args['image_src']) ? get_post_list_img_src(get_the_ID()) : get_the_post_thumbnail_url(get_the_ID());
        $heading = isset($args['heading']) ? $args['heading'] : get_the_title();
        $terms = isset($args['taxonomy']) ? get_the_terms(get_the_ID(), $args['taxonomy']) : null;
        $date = array_key_exists('date', $args) ? $args['date'] : get_the_date();
        $excerpt = isset($args['excerpt']) ? get_post_list_excerpt(get_the_ID()) : get_excerpt_for_post(get_the_excerpt(get_the_ID()), 150);
        $author = isset($args['author']) ? $args['author'] : get_the_author();
        $author_img_src = isset($args['author_image']) ? $args['author_image'] : get_avatar_url(get_the_author_meta('ID'));

        // Parent container (open)
        $output .= '<article class="flex flex-col items-start">';
        $output .= '<a href="' . esc_url(get_permalink(get_the_ID())) . '" class="group ease-linear duration-100 hover:scale-105">';

        // Image 
        if (!empty($image_src)) {
            $output .= '<div class="relative w-full">';
            $output .= '<img src="' . esc_url($image_src) . '" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] group-hover:opacity-75">';
            $output .= '<div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>';
            $output .= '</div>';
        }

        $output .= '<div class="max-w-xl flex flex-col">';

        // Date & terms
        $output .= '<div class="mt-8 flex items-center gap-x-4 text-xs">';
        if ($date) {
            $output .= '<time datetime="' . esc_attr(get_the_date('c')) . '" class="text-gray-500">';
            $output .= esc_html($date);
            $output .= '</time>';
        }
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $output .= '<span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">';
                $output .= esc_html($term->name);
                $output .= '</span>';
            }
        }
        $output .= '</div>';

        // Title & excerpt
        $output .= '<div class="group relative">';
        if (!empty($heading)) {
            $output .= '<h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-brand-400">';
            $output .= '<span class="absolute inset-0"></span>';
            $output .= esc_html($heading);
            $output .= '</h3>';
        }
        if (empty($excerpt)) {
            $excerpt = return_portion_of_text(strip_tags(remove_embeds_from_content(get_the_content(get_the_ID())), 150));
        }
        if (!empty($excerpt)) {
            $output .= '<p class="mt-5 line-clamp-3 leading-6 text-gray-600 group-hover:text-gray-800 text-base">';
            $output .= wp_kses_post($excerpt);
            $output .= '</p>';
        }
        $output .= '</div>';

        // Close copy & parent container
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</article>';

    endwhile;

    wp_reset_postdata(); // Reset the post data to avoid conflicts with main query

    return $output;
}


// function get_post_list2($posts = [], $args = [])
// {
//     if (empty($posts)) return null;
//         global $post;

//         $output = '';
//                 if ($posts->have_posts()) : 

//      while ($posts->have_posts()) : $posts->the_post(); 


//         // foreach ($posts as $post) {
//             // Vars
//             $image_src = isset($args['image_src']) ? $args['image_src'] : get_the_post_thumbnail_url($post->ID);
//             $heading = isset($args['heading']) ? $args['heading'] : get_the_title($post->ID);
//             $terms = isset($args['taxonomy']) && taxonomy_exists($args['taxonomy']) ? get_the_terms($post, $args['taxonomy']) : null;
//             $date = isset($args['date']) ? $args['date'] : get_the_date('', $post->ID);
//             $excerpt = isset($args['excerpt']) ? $args['excerpt'] : get_excerpt_for_post(get_the_excerpt($post->ID), 150);
//             $author = isset($args['author']) ? $args['author'] : get_the_author_meta('display_name', $post->post_author);
//             $author_img_src = isset($args['author_img_src']) ? $args['author_img_src'] : get_avatar_url($post->post_author);

//             // Parent container (open)
//             $output .= '<article class="flex flex-col items-start">';
//             $output .= '<a href="' . esc_url(get_permalink($post)) . '" class="group rounded-md ease-linear duration-100 hover:scale-105">';

//             // Image 
//             if (!empty($image_src)) {
//                 $output .= '<div class="relative w-full">';
//                 $output .= '<img src="' . $image_src . '" alt="" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] group-hover:opacity-75">';
//                 $output .= '<div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10"></div>';
//                 $output .= '</div>';
//             }

//             $output .= '<div class="max-w-xl flex flex-col">';

//             // Date & terms
//             $output .= '<div class="mt-8 flex items-center gap-x-4 text-xs">';
//             if (!empty($date)) {
//                 $output .= '<time datetime="' . get_the_date('c', $post->ID) . '" class="text-gray-500">';
//                 $output .= $date;
//                 $output .= '</time>';
//             }
//             if (!empty($terms)) {
//                 foreach ($terms as $term) {
//                     $output .= '<span class="hidden relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">';
//                     $output .= $term->name;
//                     $output .= '</span>';
//                 }
//             }
//             $output .= '</div>';

//             // Title & excerpt
//             $output .= '<div class="group relative self-end">';
//             if (!empty($heading)) {
//                 $output .= '<h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-brand-400 hover:text-brand-400">';
//                 // $output .= '<a href="' . esc_url(get_permalink($post->ID)) . '">';
//                 $output .= '<span class="absolute inset-0"></span>';
//                 $output .= esc_html($heading);
//                 // $output .= '</a>';
//                 $output .= '</h3>';
//             }
//             if (!empty($excerpt)) {
//                 $output .= '<p class="mt-5 line-clamp-3 leading-6 text-gray-600 group-hover:text-gray-800 text-base">';
//                 $output .= $excerpt;
//                 $output .= '</p>';
//             }
//             $output .= '</div>';

//             // Author
//             if (!empty($author) && !empty($author_img_src)) {
//                 $output .= '<div class="hidden relative mt-8 items-center gap-x-4">';
//                 $output .= '<img src="' . $author_img_src . '" alt="" class="h-10 w-10 rounded-full bg-gray-100">';
//                 $output .= '<div class="text-sm leading-6">';
//                 $output .= '<p class="font-semibold text-gray-900">';;
//                 $output .= '<span class="absolute inset-0"></span>';
//                 $output .= $author;
//                 $output .= '</p>';
//                 $output .= '</div>';
//                 $output .= '</div>';
//             }

//             // Close copy & parent container
//             $output .= '</div>';
//             $output .= '</a>';
//             $output .= '</article>';
//         }

//     return $output;
// }
