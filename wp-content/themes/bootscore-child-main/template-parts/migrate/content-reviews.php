<?php $review_posts = get_reviews_ordered(); ?>

<?php echo tw_section_open(); ?>

<?php echo tw_container_open(); ?>

<div class="grid grid-cols-1 gap-6">
    <?php
    foreach ($review_posts as $review_post) {
        echo output_formatted_review($review_post);
    }
    ?>
</div>

</div>

</section>

