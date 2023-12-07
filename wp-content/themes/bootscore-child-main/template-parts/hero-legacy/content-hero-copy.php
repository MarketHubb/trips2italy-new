    <?php if (is_singular('city')) { ?>

        <?php if ($args['hero']['region']) { ?>
            <h4 class="text-primary text-gradient mb-0">The <?php echo get_term($args['hero']['region'])->name; ?> region of Italy</h4>
        <?php } ?>

        <?php $city_name = format_region_title($args['parent_id']); ?>

        <h1 class="text-primary text-gradient mb-0"><?php echo get_field('city_name'); ?></h1>
        <h1 class="mb-4 fw-bolder"><?php echo format_region_page_type($post->ID, $args['parent_id']); ?></h1>

        <h1 class="d-none d-inline-block w-auto text-primary text-gradient text-uppercase city-name mb-3"><?php echo $city_name;?></h1>
        <h2 class="d-none d-inline-block w-auto text-uppercase mb-2"><?php echo format_region_page_type($post->ID, $args['parent_id']); ?></h2>

        <?php if ($args['hero']['subheading']) { ?>
            <h1 class="mb-4 fw-bolder"><?php echo $args['hero']['subheading']; ?></h1>
        <?php } ?>

        <?php if ($args['hero']['description']) { ?>
            <p class="lead fw-500 text-body-dark">
                <?php echo $args['hero']['_description']; ?>
            </p>
        <?php } ?>

        <?php if ($args['hero']['button']) { ?>
            <div class="buttons">
                <button type="button" class="btn bg-gradient-warning btn-lg mt-4"><?php echo $args['hero']['button']; ?></button>
            </div>
        <?php } ?>

    <?php } // is_singular('city) ?>

    <?php if (is_singular('trip')) { ?>
        <?php $page_id = get_field('page_id', $post->ID); ?>

        <h1 class="text-primary text-gradient mb-0">
            <?php the_field('banner_heading', $page_id); ?>
        </h1>

        <h1 class="mb-4 fw-bolder">
            <?php the_field('banner_subheading', $page_id); ?>
        </h1>
        <p class="lead fw-500 text-body-dark">
            <?php the_field('banner_description', $page_id); ?>
        </p>
        <div class="buttons">
            <button type="button" class="btn bg-gradient-warning btn-lg mt-4">Start Planning My Dream Honeymoon</button>
        </div>

    <?php } // is_singular('trip')  ?>

    <?php if (is_singular('itinerary')) { ?>
        <h1 class="text-primary text-gradient mb-0">
            <?php echo $args['hero']['copy']['heading']; ?>
        </h1>

        <h1 class="mb-4 fw-bolder">
            <?php echo $args['hero']['copy']['subheading']; ?>
        </h1>
        <p class="lead fw-500 text-body-dark">
            <?php echo $args['hero']['copy']['description']; ?>
        </p>
        <div class="buttons">
            <button type="button" class="btn bg-gradient-warning btn-lg mt-4">Start Planning My Dream Honeymoon</button>
        </div>

    <?php } // is_singular('trip')  ?>

    <?php if (is_page_template('page-templates/blog.php')) { ?>
        <h1 class="text-primary text-gradient mb-0">
            Our Blog
        </h1>

        <h1 class="mb-4 fw-bolder">
            <?php echo $args['hero']['copy']['subheading']; ?>
        </h1>
        <p class="lead fw-500 text-body-dark">
            Indulge in the exquisite flavors of Italy, immerse yourself in its rich culture and explore its stunning landscapes with our Italian travel blog. Join us on a journey that will tantalize your senses and leave you yearning for more.
        </p>

    <?php } //is_page_template('page-templates/blog.php')  ?>

