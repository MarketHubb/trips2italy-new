<?php $global_options = get_field('included_global_options', get_the_id()); ?>

<?php if ($global_options) { ?>

    <?php $bg_image = get_field('global_features_bg_image', 'option')['url']; ?>

    <section class="flex items-center py-16 md:py-32 bg-gradient-overlay bg-bottom bg-cover bg-no-repeat" style="background-image: 
    linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4)), 
    url(<?php echo $bg_image;
        ?>);">
        <!-- <section class="flex md:hidden items-center py-16 md:py-32 bg-gradient-overlay"> -->
        <div class="container mx-auto space-y-6 lg:space-y-0 px-0">
            <div class="row section-heading mb-5 justify-content-center">
                <?php echo tw_heading(get_the_ID(), 'included'); ?>
            </div>

            <ul class="flex lg:grid lg:grid-cols-3 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-6 lg:gap-x-8 lg:gap-y-8 py-6 lg:px-8 overflow-x-auto relative bottom-8 lg:bottom-0">
                <li class="rounded-xl w-1/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out">
                </li>

                <?php $why_us = get_field('trip_features', 'option'); ?>

                <?php foreach ($why_us['featured'] as $why) { ?>

                    <li class="snap-item rounded-xl w-9/12 lg:w-full flex-shrink-0 snap-center opacity-65 lg:opacity-100  transition-all duration-300 ease-in-out">
                        <div class="bg-white flex flex-col lg:flex-row lg:gap-x-4 h-full overflow-hidden rounded-xl p-4 lg:px-6 transition-all duration-300 ease-in-out transform">
                            <div class="flex items-center justify-center p-2">
                                <!-- container for stacked elements -->
                                <div class="relative w-full max-w-lg aspect-auto pt-8">
                                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32  bg-brand opacity-50 rounded-full filter blur-xl"></div>
                                    <img src="<?php echo $why['image']['url'] ?>" alt="base image" class="relative h-32  z-10 w-full object-contain">
                                    <img src="<?php echo get_home_url() . '/wp-content/uploads/2024/07/spiral.svg'; ?>" alt="overlay image" class="absolute inset-0 w-full h-full object-contain opacity-20">
                                </div>
                            </div>
                            <div class="mt-2 text-center lg:text-left px-3 z-10 lg:ml-4">
                                <h5 class="d-inline-block fw-bolder text-uppercase mt-3 mb-0 text-xl md:text-2xl"><?php echo $why['heading']; ?></h5>
                                <h5 class="text-gradient text-primary stylized mb-4 text-3xl antialiased-[unset]"><?php echo $why['subheading']; ?></h5>
                                <div class="mx-auto text-center lg:text-left max-w-[90%] lg:max-w-full mb-3">
                                    <p class="text-gray-900 text-base px-3 lg:pl-0 leading-6"><?php echo $why['description']; ?></p>
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