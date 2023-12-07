<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Trips2Italy_2018
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <div class="container py-5">
                <div class="row">
                    <div class="col">

                        <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.

                        // Load related topics
                        get_template_part('inc/menu', 'reltopics');

                        ?>


                    </div>
                </div>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
$show_sidebar = get_field("add_sidebar");
if ($show_sidebar) {
    get_sidebar();
}
get_footer();
get_template_part('modal');

/*
function print_scripts_styles() {

    $result = [];
    $result['scripts'] = [];
    $result['styles'] = [];

    // Print all loaded Scripts
    global $wp_scripts;
    foreach( $wp_scripts->queue as $script ) :
       $result['scripts'][] =  $wp_scripts->registered[$script]->src . ";";
    endforeach;

    // Print all loaded Styles (CSS)
    global $wp_styles;
    foreach( $wp_styles->queue as $style ) :
       $result['styles'][] =  $wp_styles->registered[$style]->src . ";";
    endforeach;

    return $result;
}

print_r( print_scripts_styles() );
*/

