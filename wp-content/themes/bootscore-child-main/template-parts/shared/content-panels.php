<?php if (isset($args)) { ?>

    <?php
    $section_open = tw_output_section_open($args);
    if ($section_open) echo $section_open;
    ?>


    <?php echo tw_container_open(); ?>

    <?php
    $section_heading = tw_output_heading($args);
    if ($section_heading) echo $section_heading;
    ?>

    <ul class="flex lg:grid lg:grid-cols-3 lg:justify-center lg:content-center snap-slider snap-x snap-mandatory gap-x-2 lg:gap-x-8 lg:gap-y-8 py-6 lg:px-8 overflow-x-auto relative">

        <li class="rounded-xl w-1/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out"></li>

        <?php
        $content_fields = tw_get_template_content($args);

        if (!empty($content_fields)) {
            $output_function = !empty($args['content']['output_function']) ? $args['content']['output_function'] : null;
       
            if ($output_function && function_exists($output_function)) {
               $panels = ''; 
                
                foreach ($content_fields as $field) {
                    $panels .= $output_function($field);
                }
            }
        }

        echo $panels;
        ?>

        <li class="rounded-xl w-3/12 flex-shrink-0 lg:hidden snap-center opacity-65 transition-all duration-300 ease-in-out"></li>

    </ul>

    </div>

</section>

<?php } ?>