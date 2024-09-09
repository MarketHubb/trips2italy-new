<?php
$section_fields = get_field('stats_heading');

$bg_data = [
    'image' => get_home_url() . '/wp-content/uploads/2023/05/Florence.jpeg',
    'classes' => ' bg-center bg-cover '
];
echo tw_section_open($section_fields); 
?>
<div class="mx-auto max-w-7xl relative z-10">
    <div class="pb-10 text-center">
        <?php echo tw_heading(get_the_ID(), 'stats_heading'); ?>
    </div>

    <?php $stats = get_field('stats', get_the_ID())['stats']; ?>

    <?php if (!empty($stats)) { ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 justify-center">
            <div class="lg:col-span-10 lg:col-start-2 py-6 rounded-lg bs-blur ring-2 ring-white shadow-lg">
                <div class="flex flex-col lg:flex-row divide-y-2 divide-y-white lg:divide-y-0 lg:divide-x-2">

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

    <div class="row hidden ">
        <div class="col-lg-9 z-index-2 border-radius-xl mx-auto py-3 bs-blur shadow-blur stats-cols mx-3 lg:mx-0">
            <div class="row">

                <?php
                $stats = get_stats(get_field('stats', get_the_ID())['stats']);
                if ($stats) {
                    // echo  $stats;
                }
                ?>

            </div>
        </div>
    </div>
</div>
</section>