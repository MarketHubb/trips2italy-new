<?php echo tw_section_open(); ?>
<?php echo tw_container_open(); ?>
<?php echo  tw_heading(get_the_ID(), 'package_related'); ?>

<div class="mt-5">

    <?php
    $packages = get_posts(array(
        'post_type' => 'package',
        'posts_per_page' => 6,
        'orderby' => 'rand',
    ));


    $related = '<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 md:gap-8">';
    foreach ($packages as $package) {
        $image = get_field('featured_image', $package->ID);
        if ($image) {
            $related .= '<div class="">';
            $related .= '<a href="' . get_permalink($package->ID) . '">';
            $related .= '<div class="card card-background move-on-hover h-[24rem] relative">';
            $related .= '<div class="object-cover bg-no-repeat h-full w-full absolute object-center" style="background-image: url(' . $image['url'] . ')"></div>';
            $related .= '<div class="grid grid-cols-1 h-full z-50 items-end p-6">';
            $related .= '<div>';
            $related .= '<h4 class="font-heading tracking-normal text-xl md:text-2xl text-white leading-tight mb-2 font-semibold">' . get_the_title($package->ID) . '</h4>';
            $related .= '<p class="hidden line-clamp-2 text-base md:text-lg text-white leading-tight">' . get_field('description', $package->ID) . '</p>';
            $related .= '</div>';
            $related .= '</div></div></div></a>';
        }
    }

    echo $related;
    ?>

</div>

<?php tw_container_and_section_close(); ?>