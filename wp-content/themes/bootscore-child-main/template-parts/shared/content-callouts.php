<?php if (empty($args)) return; ?>

<?php
$section_open = tw_output_section_open($args);
if ($section_open) echo $section_open;
?>

<div class="mx-auto max-w-7xl relative z-10">

    <?php
    $section_heading = tw_output_heading($args);
    if ($section_heading) echo $section_heading;
    ?>

    <?php 
    $stats_post = get_field('stat_callouts', get_the_ID());
    $stats_global = get_field('stat_callouts', 'option');
     ?>

    <?php $stats = tw_get_template_content($args); ?>

    <?php if (!empty($stats)) { ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 justify-center">
            <div class="lg:col-span-10 lg:col-start-2 rounded-lg bs-blur ring-2 ring-white">
                <div class="flex flex-col lg:flex-row py-6 divide-y-2 divide-y-white lg:divide-y-0 lg:divide-x-2 shadow-xl shadow-black/30">

                    <?php foreach ($stats as $stat) { ?>

                        <div class=" text-center px-4 py-6">
                            <h3 class="text-brand-600 tracking-wide text-2xl font-semibold font-heading"><?php echo $stat['stat']; ?></h3>
                            <h4 class="mt-3 stylized text-secondary-500 text-[2rem] md:text-3xl lg:text-4xl mb-6"><?php echo $stat['subheading']; ?></h4>
                            <p class="text-gray-700 text-base lg:text-lg px-4"><?php echo $stat['description']; ?></p>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>

    <?php } ?>

</div>

</section>