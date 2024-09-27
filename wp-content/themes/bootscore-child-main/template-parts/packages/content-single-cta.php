<div class="bg-gradient-to-r from-brand-900 via-brand-700 to-brand-600 py-24 sm:py-32">
<!-- <div class="bg-gradient-to-r from-brand-200 to-brand-100 py-24 sm:py-32"> -->
    <div class="relative isolate">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-2xl flex-col gap-16 bg-white/90 px-6 py-16 ring-1 ring-white/10 sm:rounded-3xl sm:p-8 lg:mx-0 lg:max-w-none lg:flex-row lg:items-center lg:py-20 xl:gap-x-20 xl:px-20">
                <?php
                $images = get_field('images', get_the_ID());
                if (!empty($images)) {
                    $img_src = $images[0]['image']['url'];
                }
                ?>
                <?php if ($img_src) { ?>
                    <img class="h-96 w-full flex-none rounded-2xl object-cover shadow-xl lg:aspect-square lg:h-auto lg:max-w-sm" src="<?php echo $img_src; ?>" alt="">
                <?php } ?>
                <div class="w-full flex-auto">
                    <h2 class="text-3xl font-bold tracking-tight text-brand-700 sm:text-4xl">Package details:</h2>
                    <?php
                    $locations = get_field('locations', get_the_ID());
                    $regions = get_field('regions', get_the_ID());

                    if (!empty($locations)) {
                        $location_copy = '';
                        // location (posts)
                        foreach ($locations as $location_id) {
                            $location_copy .= ' ' . get_the_title($location_id);
                        }
                        // region (terms)
                        foreach ($regions as $region_id) {
                            $location_copy .= ' ' . get_term($region_id)->name;
                        }

                        if (!empty($location_copy)) {
                            $location_copy = ' to' . $location_copy;
                        }
                    }
                    $day_count = !empty(get_field('itinerary')) ? ' ' . count(get_field('itinerary')) . '-day,' : '';
                    $description = 'This' . $day_count . ' custom-crafted vacation package ' . $location_copy . ' includes:'
                    ?>
                    <p class="mt-6 text-lg leading-8 text-gray-500"><?php echo $description; ?></p>
                    <?php



                    $features_array = [
                        'price' => ''
                    ];
                    ?>
                    <?php
                    if (have_rows('includes')):
                        $includes = '<ul role="list" class="mt-10 grid grid-cols-1 gap-x-8 gap-y-3 text-lg leading-7 text-gray-700">';
                        while (have_rows('includes')) : the_row();
                            $item = trim(str_replace(';', '', str_replace('-', '', get_sub_field('item'))));
                            $includes .= '<li class="flex gap-x-3">';
                            $includes .= '<svg class="h-7 w-5 flex-none fill-brand-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">';
                            $includes .= '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />';
                            $includes .= '</svg>';
                            $includes .= $item;
                            $includes .= '</li>';
                        endwhile;
                        $includes .= '</ul>';

                        echo $includes;
                    endif;
                    ?>

                    <div class="mt-10 flex">
                        <a href="#" class="text-sm font-semibold leading-6 text-indigo-400">See our job postings <span aria-hidden="true">&rarr;</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-x-0 -top-16 -z-10 flex transform-gpu justify-center overflow-hidden blur-3xl" aria-hidden="true">
            <div class="aspect-[1318/752] w-[82.375rem] flex-none bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-25" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>
        </div>
    </div>
</div>