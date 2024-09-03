<?php
$output_array = output_order_testimonials();

$review_posts = get_posts(array(
    'post_type' => 'review',
    'posts_per_page' => -1,
    'order' => $output_array['order'],
    'orderby' => 'modified'
));

$reviews = '<div class="container">';
$reviews .= '<div class="row">';

foreach ($review_posts as $review_post) {
    $review_raw = get_field('review', $review_post->ID);
    // echo get_the_title( $review_post->ID );
    $title_raw = trim(remove_dashes_from_string(get_the_title($review_post->ID), "before"));
    $location_no_author = str_replace($title_raw, "", get_field('location', $review_post->ID));
    //    $locale = str_replace("??", "",mb_convert_encoding(get_field('location', $review_post->ID), 'UTF-8', 'UTF-8'));
    $location_raw = trim(remove_dashes_from_string($location_no_author, "after"));

    $location = str_replace($title_raw, "", $location_raw);
    $review = str_replace($location, "", $review_raw);
    $author_clean = str_replace("-", "", str_replace("&amp;", "&", $title_raw));
    $author = trim(str_replace($location, "", $author_clean));

    // if ($review && $author) {
        $reviews .= '<div class="col-md-4 my-4">';
        $reviews .= '<div class="quote-icon position-relative d-flex z-index-2 justify-content-center">';
        $reviews .= '<i class="fa-solid fa-quote-left text-secondary-500 fa-2xl"></i>';
        $reviews .= '</div>';
        $reviews .= '<div class="border-radius-lg mx-auto p-3 blur shadow-blur review-container">';
        $reviews .= '<p class="review-copy p-3">' . $review . '</p>';
        $reviews .= '<p class="clamp-1 px-3 fw-bold text-gradient text-primary mb-0">' . $author . '</p>';

        if ($location !== '' && $location !== $author) {
            $reviews .= '<p class="clamp-1 px-3 small">' . $location . '</p>';
        }

        $reviews .= '</div></div>';
    }
// }
$reviews .= '</div>';
$reviews .= '</div>';

echo $reviews;
