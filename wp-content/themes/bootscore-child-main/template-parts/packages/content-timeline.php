<div class="bg-white py-24 md:py-32">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-5">
        <div class="max-w-2xl xl:col-span-2">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">The itinerary</h2>
            <?php $package_description_split = get_package_description(get_the_ID()); ?>

            <?php if (!empty($package_description_split) && $package_description_split[1]) { ?>
                <p class="mt-6 text-base leading-7 text-gray-600">
                    <?php echo $package_description_split[1]; ?>
                </p>
            <?php } ?>
        </div>
        <?php
        if (have_rows('itinerary')):
            $images = get_field('images');
            $itinerary = '<ul role="list" class="-mt-12 space-y-12 divide-y divide-gray-200 xl:col-span-3">';
            while (have_rows('itinerary')) : the_row();
                $image_row = get_row_index() + 1;
                $itinerary .= '<li class="flex flex-col gap-10 pt-12 sm:flex-row">';
                $itinerary .= '<img class=" w-[250px] h-[250px] flex-none rounded-2xl object-cover" src="' . $images[$image_row]['image']['url'] . '" alt="">';
                $itinerary .= '<div class="max-w-xl flex-auto">';
                $itinerary .= '<h3 class="text-lg font-semibold leading-8 tracking-tight text-gray-900">' . get_sub_field('day') . '</h3>';
                $itinerary .= '<p class="mt-6 text-base leading-7 text-gray-600">' . get_sub_field('description') . '</p>';
                $itinerary .= '</div></li>';
            endwhile;
            $itinerary .= '</ul>';
            echo $itinerary;
        endif;
        ?>

    </div>
    </li>

    <!-- More people... -->
    </ul>
</div>
</div>