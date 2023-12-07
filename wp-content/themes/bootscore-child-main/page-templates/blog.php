<?php
/* Template Name: Blog */
get_header(); ?>

<?php
$hero_inputs = get_hero_inputs(get_queried_object());
/*highlight_string("<?php\n\$hero_inputs =\n" . var_export($hero_inputs, true) . ";\n?>");*/
?>

<div class="container post-list">
    <div class="row mt-5 mb-2">
        <div class="col-12">
            <h3>Catch up on the latest from Trips 2 Italy</h3>
        </div>
    </div>
<?php 
$posts = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => 12,
));
$output = '<div class="row">';
foreach ($posts as $article) {
    $output .= '<div class="col-lg-4 my-3">';
    $output .= '<div class="card h-100">';
    $output .= '<div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">';
    $output .= '<a href="javascript:;" class="d-block">';
    $output .= get_the_post_thumbnail($article->ID);
    $output .= '</a></div>';
    $output .= '<div class="card-body">';
    $output .= '<h4><a href="' . get_the_permalink($article->ID) . '">' . get_the_title($article->ID) . '</a></h4>';
    $output .=  get_excerpt_for_post(get_the_excerpt($article->ID), 150);
    $output .= '</div></div></div>';
}
$output .= '</div>';
echo $output;
?>
</div>



<?php get_footer(); ?>
