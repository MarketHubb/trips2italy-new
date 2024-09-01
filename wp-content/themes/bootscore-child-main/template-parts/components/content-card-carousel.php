<?php //if (!empty($args)) { ?>

    <?php $content_fields = get_field('trip_types', get_the_id()); ?>

    <?php highlight_string("<?php\n\$content_fields =\n" . var_export($content_fields, true) . ";\n?>"); ?>

    <div class="w-full h-full py-20">
        <h2 class="max-w-7xl pl-4 mx-auto text-xl md:text-5xl font-bold text-neutral-800 dark:text-neutral-200 font-sans">
            Get to know your iSad.
        </h2>
        <div class="relative w-full">
            <div class="flex w-full overflow-x-scroll overscroll-x-auto py-10 md:py-20 scroll-smooth [scrollbar-width:none]">
                <div class="absolute right-0 z-[1000] h-auto w-[5%] overflow-hidden bg-gradient-to-l"></div>
                <div class="flex flex-row justify-start gap-4 pl-4 max-w-7xl mx-auto">
                    <!-- Repeat this structure for each card -->
                    <div class="last:pr-[5%] md:last:pr-[33%] rounded-3xl">
                        <button class="rounded-3xl bg-gray-100 dark:bg-neutral-900 h-80 w-56 md:h-[40rem] md:w-96 overflow-hidden flex flex-col items-start justify-start relative z-10">
                            <div class="absolute h-full top-0 inset-x-0 bg-gradient-to-b from-black/50 via-transparent to-transparent z-30 pointer-events-none"></div>
                            <div class="relative z-40 p-8">
                                <p class="text-white text-sm md:text-base font-medium font-sans text-left">Artificial Intelligence</p>
                                <p class="text-white text-xl md:text-3xl font-semibold max-w-xs text-left [text-wrap:balance] font-sans mt-2">You can do more with AI.</p>
                            </div>
                            <img alt="You can do more with AI." loading="lazy" decoding="async" class="transition duration-300 blur-0 object-cover absolute z-10 inset-0" src="your-image-url-here" />
                        </button>
                    </div>
                    <!-- End of card structure -->
                </div>
            </div>
            <div class="flex justify-end gap-2 mr-10">
                <button class="relative z-40 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center disabled:opacity-50">
                    <!-- Left arrow SVG -->
                </button>
                <button class="relative z-40 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center disabled:opacity-50" disabled="">
                    <!-- Right arrow SVG -->
                </button>
            </div>
        </div>
    </div>

<?php //} ?>