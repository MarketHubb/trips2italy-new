<?php if (isset($args) && !empty($args)) { ?>
    <div class="px-8 mx-auto scroller duration-[10s] sm:duration-[20s]" data-direction="right" data-speed="fast">
        <div class="scroller__inner gap-x-4 md:gap-x-8">
        <!-- <div class="scroller__inner grid grid-cols-5 md:grid-cols-7"> -->
            <?php foreach ($args as $index => $field) { ?>

                <img class="shadow-sm max-h-[70px] md:max-h-[200px] w-auto shadow-slate-400 rounded hover:scale-110 ease-linear duration-150 hover:ring-1 hover:ring-orange hover:cursor-pointer open-modal"
                    src="<?php echo esc_url($field['image']); ?>"
                    alt="<?php echo $field['description']; ?>"
                    data-modal-target="modal-<?php echo $index; ?>" />
                <div class="hidden">
                    <p class="modal-description"><?php echo $field['description']; ?></p>

                    <?php if (!empty($field['author'])) { ?>
                        <p class="modal-author"><?php echo $field['author']; ?></p>
                    <?php } ?>

                    <?php if (!empty($field['trip_type'])) { ?>
                        <p class="modal-trip"><?php echo get_the_title($field['trip_type']); ?></p>
                    <?php } ?>

                    <?php if (!empty($field['cities'])) { ?>
                        <ul class="modal-cities">
                            <?php foreach ($field['cities'] as $city) { ?>
                                <li><?php echo get_the_title($city); ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>

                    <?php if (!empty($field['regions'])) { ?>
                        <ul class="modal-regions">
                            <?php foreach ($field['regions'] as $region) { ?>
                                <li><?php echo get_term_by('name', $region, 'location_region'); ?></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>

                </div>

            <?php } ?>

        </div>
    </div>

    <!-- Modal container (hidden by default) -->

    <div id="modal-container" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl">
                <!-- Close button -->
                <button type="button" id="close-modal" class="absolute top-0 right-2 text-gray-400 hover:text-gray-700 focus:outline-none">
                    <span class="sr-only">Close</span>
                    <span aria-hidden="true" class="text-2xl font-medium">&times;</span>
                </button>
                <div class="p-8">
                    <div>
                        <img id="modal-image" src="" alt="" class="w-full h-auto rounded shadow-md ring-1 ring-gray-500">
                    </div>

                    <div class="block w-full mx-auto text-center rating pt-10 pb-8">
                        <i class="fas fa-lg fa-star text-warning"></i>
                        <i class="fas fa-lg fa-star text-warning"></i>
                        <i class="fas fa-lg fa-star text-warning"></i>
                        <i class="fas fa-lg fa-star text-warning"></i>
                        <i class="fas fa-lg fa-star text-warning"></i>
                    </div>
                    <div class="p-6">
                        <p id="modal-description" class="text-lg text-gray-600"></p>
                        <p id="modal-author" class="text-xl sm:text-2xl text-gray-950 stylized mt-2 inline-block"></p>

                        <div class="text-gray-600 text-sm mx-auto text-center pt-4 italic relative top-3">
                            <ul class="modal-locations inline-grid grid-flow-col gap-x-4 divide-x text-sm font-semibold">
                                <!-- Each .modal-cities and .modal-regions go here as <li> -->
                            </ul>
                            <p id="modal-trip" class="inline text-sm"></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>