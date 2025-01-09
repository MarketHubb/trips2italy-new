<?php if (empty($args)) return ''; ?>

<div class="grid grid-cols-1 lg:grid-cols-12 justify-center">
    <div class="lg:col-span-10 lg:col-start-2 rounded-lg bs-blur ring-2 ring-white">
        <div class="flex flex-col lg:flex-row py-6 divide-y-2 divide-y-white lg:divide-y-0 lg:divide-x-2 shadow-xl shadow-black/30">
            
            <?php 
            if (!empty($args['content']['content_stats'])) :
                foreach ($args['content']['content_stats'] as $stat) :
            ?>
                <div class="text-center px-4 py-6">
                    <h3 class="text-brand-600 tracking-wide text-2xl font-semibold font-heading">
                        <?php echo esc_html($stat['stat']); ?>
                    </h3>
                    <h4 class="mt-3 stylized text-secondary-500 text-[2rem] md:text-3xl lg:text-4xl mb-6">
                        <?php echo esc_html($stat['subheading']); ?>
                    </h4>
                    <p class="text-gray-700 text-base lg:text-lg px-4">
                        <?php echo esc_html($stat['description']); ?>
                    </p>
                </div>
            <?php 
                endforeach;
            endif; 
            ?>

        </div>
    </div>
</div>
