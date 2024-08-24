<?php
$hero = $args;

if (!$hero) {
    $hero['image'] = get_field('featured_image', $post->ID)['url'];
    $hero['heading'] = "Completely Custom " . get_the_title($post->ID) . " to Italy";
    $hero['description'] = get_field('excerpt');
    $type_singular = remove_s_from_end_of_string(get_the_title($post->ID));
    $hero['button_text'] = 'Get My Custom ' . $type_singular . ' Itinerary';
}
?>
<header class="header-2">
    <div class="page-header min-vh-75 relative" style="background-image: url(<?php echo $hero['image']; ?>)">
        <span class="mask bg-gradient-dark opacity-0"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 bs-blur shadow-lg rounded-5 px-5 py-4">

                    <?php if (!empty($hero['heading'])) { ?>
                    <h1 class=" pt-3">
                        <?php echo $hero['heading']; ?>
                    </h1>
                    <?php } ?>

                    <?php if (!empty($hero['description'])) { ?>
                        <p class="lead  mt-3">
                            <?php echo $hero['description']; ?>
                        </p>
                    <?php } ?>

                    <?php  ?>

                    <?php if ($hero['button_text']) { ?>
                    <button type="button" class="btn bg-orange btn-lg mt-2" data-target="form" data-type="Form">
                        <?php echo $hero['button_text']; ?>
                    </button>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="position-absolute w-100 z-index-1 bottom-0">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                </defs>
                <g class="moving-waves">
                    <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40"></use>
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                    <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95"></use>
                </g>
            </svg>
        </div>
    </div>
</header>