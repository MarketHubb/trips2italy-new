<?php $global_options = get_field('included_global_options', get_the_id()); ?>

<?php if ($global_options) { ?>

    <?php $bg_image = get_field('global_features_bg_image', 'option')['url']; ?>

    <section class="flex items-center py-16 md:py-32 bg-gradient-overlay bg-bottom bg-cover bg-no-repeat" style="background-image: 
    linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4)), 
    url(<?php echo $bg_image;
        ?>);">
        <!-- <section class="flex md:hidden items-center py-16 md:py-32 bg-gradient-overlay"> -->
        <!-- <div class="container mx-auto space-y-6 lg:space-y-0 px-0"> -->

        <?php echo tw_container_open(); ?>

        <?php
        $heading_args = [
            'post_id' => get_the_ID(),
            'field_name' => 'included',
            'container_classes' => ' pb-10 z-10 relative sm:block sm:pb-12 text-2xl md:text-2xl lg:text-3xl px-6 ' 
        ];
        $section_heading = tw_output_section_heading($heading_args);

        if (!empty($section_heading)) {
            echo $section_heading;
        }

        ?>

        <ul class="flex lg:grid lg:grid-cols-3 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-2 lg:gap-x-8 lg:gap-y-8 py-6 lg:px-8 overflow-x-auto relative">
            <li class="rounded-xl w-1/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out">
            </li>

            <?php $why_us = get_field('trip_features', 'option'); ?>

            <?php foreach ($why_us['featured'] as $why) { ?>

                <li class="snap-item rounded-xl w-9/12 lg:w-full flex-shrink-0 snap-center opacity-65 lg:opacity-100  transition-all duration-300 ease-in-out">
                    <div class="bg-white opacity-[98%] grid grid-cols-1 md:grid-cols-12 lg:gap-x-4 h-full overflow-hidden rounded-xl p-4 lg:px-6 transition-all duration-300 ease-in-out transform">
                        <div class="flex items-center justify-center p-2 md:col-span-3">
                            <!-- container for stacked elements -->
                            <div class="grid mt-4 sm:mt-0 relative justify-center w-full max-w-lg aspect-auto">
                                <div class="absolute sm:top-1/2 left-1/2 transform -translate-x-1/2 sm:-translate-y-1/2 w-32 h-32  bg-brand-500/50 opacity-50 rounded-full filter blur-xl"></div>
                                <img src="<?php echo $why['image']['url'] ?>" alt="base image" class="relative h-32 w-auto z-10 object-contain drop-shadow-md">
                                <img src="<?php echo get_home_url() . '/wp-content/uploads/2024/07/spiral.svg'; ?>" alt="overlay image" class="absolute inset-0 w-full h-full object-contain opacity-60">
                            </div>
                        </div>
                        <div class="mt-2 text-center lg:text-left z-10 lg:ml-2 md:col-span-9">
                            <h5 class="d-inline-block fw-bolder text-uppercase mt-3 mb-0 text-xl md:text-2xl"><?php echo $why['heading']; ?></h5>
                            <h5 class="text-gradient text-primary stylized mb-3 md:mb-1 text-3xl antialiased-[unset]"><?php echo $why['subheading']; ?></h5>
                            <div class="mx-auto text-center lg:text-left max-w-[90%] lg:max-w-full mb-3">
                                <p class="text-gray-800 font-medium text-base px-3 lg:pl-0 leading-normal md:leading-6 mb-5"><?php echo $why['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </li>


            <?php } ?>
            </li>
            <li class="rounded-xl w-3/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out">
            </li>
        </ul>
        </div>
    </section>
<?php } ?>