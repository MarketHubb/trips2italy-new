<?php $hero = $args; ?>

<?php //if ($hero['type'] === 'text-left') { ?>
<?php if (false) { ?>
    <img src="<?php echo home_url() . '/wp-content/uploads/2023/01/Logo-No-Shadow.svg'; ?>" class="hero-logo" alt="">
<?php } ?>

<div class="me-md-3 me-lg-5 me-xl-6">

    <?php
    $heading = hero_heading($hero);
    echo ($heading) ?: null;
    ?>

    <?php
    $description = output_hero_description($hero);
    echo ($description) ?: null;
    ?>

    <?php echo hero_callouts($args); ?>

    <?php
    $links = output_hero_links($hero);
    echo ($links) ?: null;
    ?>

</div>