<div id="intro">
    <div class="text-center px-md-4 px-lg-5">
        <h1 class="fw-900 lh-1 mb-2 mt-0 pb-2 pb-md-1 text-white roboto fs-3">
            Your Dream Italian <span class="trip-type">Trip</span>
            <span class="script text-blue mt-2">Starts Here</span>
        </h1>
        <div class="feature-seperator"></div>
        <p id="modal-body-subheadline" class="mb-5 lh-sm text-white fw-500 px-md-3 px-lg-4">Just share a few details like when you want to go, and what you like to do. Our Italian-born travel experts will do the rest.</p>
    </div>
    <div class="mb-md-5 mx-auto text-center">
        <?php
//        $start_attr = 'type="button" class="btn btn-primary modal-cta" id="start"';
        $start_attr = 'type="button" class="btn btn-sm bg-orange text-white btn-round" id="start"';
        $start_btn = array(
            'type' => 'button',
            'text' => 'Start Now <i class="fa-solid fa-arrow-right ms-1"></i>',
            'attributes' => $start_attr
        );
        echo return_cta_btn($start_btn);

        ?>
    </div>
    <div class="mt-5 text-center">
        <p class="text-center text-white mt-5 pt-4 mb-3 lh-sm fw-500">
            <span class="d-md-block fw-bolder fs-5 mb-2"><i class="fa-solid fa-phone fa-sm me-1 opacity-50"></i> Prefer to Call ?</span>
            Talk to our amazing, in-house Italian travel experts
        </p>
        <p class="text-center text-white fw-bold">
            <a href="tel:+1-866-464-8259" class="text-white fs-5 letter-spacing-1 border-bottom border-1 border-light">1-866-464-8259</a>
        </p>
    </div>
</div>
