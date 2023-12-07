<?php
if ($args) {
    $hero = $args;
/*    highlight_string("<?php\n\$hero =\n" . var_export($hero, true) . ";\n?>");*/
?>
<header>
    <div class="page-header min-vh-50">
        <div
            class="position-absolute fixed-top ms-auto w-100  z-index-0 d-block banner-full-width-text-overlay"
            style="background-image: url(<?php echo $hero['image']; ?>);">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 d-flex justify-content-center flex-column">
                    <div class="card card-body blur d-flex justify-content-center shadow-lg p-4 p-md-4 p-lg-5 mt-5">

                        <?php
                            if ($hero['breadcrumbs']) {
                                $breadcrumbs = '<div class="hero-breadcrumbs">';
                                foreach ($hero['breadcrumbs'] as $breadcrumb) {
                                    $breadcrumbs .= '<p class="small d-inline-flex align-items-center px-3 mb-0"><a href="' . $breadcrumb['link'] . '" class="d-inline-flex align-items-center fs-6">';

                                    if ($breadcrumb['icon']) {
                                        $breadcrumbs .= '<img src="' . $breadcrumb['icon'] . '" class="breadcrumb-icon me-2 mb-0"/>';
                                    }

                                    $breadcrumbs .= $breadcrumb['text'];
                                    $breadcrumbs .= '</a></p><span class="align-text-bottom">&rang;</span>';
                                }

                                $breadcrumbs .= '</div>';
                            }

                            if ($breadcrumbs) {
                                echo $breadcrumbs;
                            }
                            ?>

                        <div class="hero-text-container py-3">

                            <h1 class="text-gradient text-primary">
                                <?php echo $hero['heading'] ?>
                            </h1>

                            <?php if ($hero['heading_2']) { ?>
                                <h1 class="mb-0">
                                    <?php echo $hero['heading_2'] ?>
                                </h1>
                            <?php } ?>

                            <?php if ($hero['description']) { ?>
                                <p class="lead pe-5 me-5">
                                    <?php echo $hero['description']; ?>
                                </p>
                            <?php } ?>

                        </div>

                        <?php
                        $mobile = (bool)$hero['button_text_mobile'];

                        if (!$mobile) { ?>
                            <div class="buttons">
                                <button type="button" class="btn bg-gradient-warning btn-lg mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#modalppc" role="button">
                                    <?php echo $hero['button_text']; ?>
                                </button>
                            </div>
                        <?php } ?>

                        <?php if ($mobile) { ?>
                            <!-- Desktop -->
                            <div class="buttons">
                                <button type="button" class="d-none d-md-inline-block btn bg-gradient-warning btn-lg mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#modalppc" role="button">
                                    <?php echo $hero['button_text']; ?>
                                </button>
                            </div>

                            <!-- Mobile -->
                            <div class="buttons">
                                <button type="button" class="d-inline-block d-md-none btn bg-gradient-warning btn-lg mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#modalppc" role="button">
                                    <?php echo $hero['button_text_mobile']; ?>
                                </button>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php } ?>
