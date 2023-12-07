<?php $hero = $args; ?>

             </div> <!-- <div class="col-lg-7 text-center mx-auto"> -->

         </div>

    </div>


    <?php
    if ($hero['wave'] === 'wave')
        get_template_part('template-parts/hero/content', 'wave');
    ?>

    </div>

</header>

<?php
$stats['content'] = $hero['stats'];
if ($hero['stats']) {
    get_template_part('template-parts/shared/content', 'stats', $stats);
}
?>