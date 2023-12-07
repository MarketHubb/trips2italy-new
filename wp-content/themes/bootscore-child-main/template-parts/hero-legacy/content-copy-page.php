<!-- Hero - Text (Desktop) -->
<?php $hero = $args; ?>

<div class="my-auto d-none d-md-block <?php echo $hero['text_col']; ?>">

    <?php if (get_field('hero')['hero_text_background']) { ?>

        <div class="text-container text-background shadow-sm">
            <h1 class="mb-4">
                                <span class="text-white d-block">
                                    <?php echo $hero['hero_heading_1']; ?>
                                </span>
                <span class="text-gradient text-warning">
                                    <?php echo $hero['hero_heading_2']; ?>
                                </span>
            </h1>
            <p class="fw-bold lead text-white text-start lh-base">
                <?php echo $hero['hero_description']; ?>
            </p>
            <div class="buttons mx-auto">
                <button type="button" class="btn bg-gradient-warning btn-lg mt-4" data-bs-toggle="modal" data-bs-target="#modalppc">
                    Plan My Dream Trip
                </button>
            </div>
        </div>

    <?php } else { ?>

        <div class="text-container">
            <h1 class="text-primary text-gradient mb-0"><?php echo $hero['hero_heading_1']; ?></h1>
            <h1 class="mb-4 fw-bolder"><?php echo $hero['hero_heading_2']; ?></h1>
            <p class="lead fw-500 text-body-dark">
                <?php echo $hero['hero_description']; ?>
            </p>
            <div class="buttons">
                <button type="button" class="btn bg-gradient-warning btn-lg mt-4">Start Planning My Dream Vacation</button>
            </div>
        </div>

    <?php } ?>

</div>
