<?php $cta_bg_image = get_home_url() . '/wp-content/uploads/2023/05/Florence.jpeg'; ?>
<div
        class="bg-gradient-info position-relative m-3 border-radius-xl"
        style="background-image: url(<?php echo $cta_bg_image; ?>); background-repeat: no-repeat; background-size: cover; background-position: bottom;">
    <span class="mask bg-gradient-dark opacity-9"></span>
    <img src="<?php echo get_stylesheet_directory_uri() . '/img/waves-white.svg'; ?>" alt="pattern-lines" class="d-none position-absolute start-0 top-md-0 w-100 opacity-6">
    <div class="container pb-5 pt-5 postion-relative z-index-2 position-relative">
        <div class="row">
            <div class="col-md-7 mx-auto text-center">
                <span class="badge bg-gradient-light mb-2 text-dark">Live Italy</span>
                <h3 class="text-white">Ready to experience Italy like a local?</h3>
                <p class="text-white">Just tell us about where you want to go, or what you like to do and our team will start crafting your custom Italian vacation itinerary</p>
                <button type="button" class="btn bg-orange btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#modalppc">Get My Custom Itinerary
                </button>
            </div>
        </div>
    </div>x
</div>
