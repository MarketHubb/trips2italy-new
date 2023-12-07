<section class="py-lg-7" id="package-type-container">
    <div class="container">

        <!-- Section Heading -->
        <div class="row">
            <div class="col-md-6 col-lg-9 mx-auto text-center">
                <h2>Packaged trip, or custom itinerary?</h2>
                <h2 class="text-gradient text-warning mb-0 font-weight-bolder">Find out which is right for you</h2>

            </div>
        </div>

        <!-- Tab Nav -->
        <div class="row mb-5">
            <div class="col-lg-8 col-md-10 col-12 mx-auto text-center">
                <div class="nav-wrapper mt-5">
                    <ul class="nav nav-pills nav-fill flex-row p-1" id="tabs-package-types" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 active fw-bold" data-type="packaged-trip" id="tabs-iconpricing-tab-1" data-bs-toggle="tab" href="#tabs-pricing-tab-1" role="tab" aria-selected="true">
                                Packaged Trip
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 fw-bold" data-type="custom-trip" id="tabs-iconpricing-tab-2" data-bs-toggle="tab" href="#tabs-pricing-tab-2" role="tab" aria-selected="false" tabindex="-1">
                                Custom Itinerary
                            </a>
                        </li>
                        <div class="moving-tab position-absolute nav-link" style="padding: 0px; transition: all 0.5s ease 0s; transform: translate3d(0px, 0px, 0px); width: 412px;"><a class="nav-link mb-0 active" id="tabs-iconpricing-tab-1" data-bs-toggle="tab" href="#tabs-pricing-tab-1" role="tab" aria-selected="true">-</a></div></ul>
                </div>
            </div>
        </div>

        <!-- Panels -->
        <div class="row trip-package-types" id="packaged-trip">
            <div class="card">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body">
                            <h3 class="text-gradient text-info">Packaged trips</h3>
                            <p>Crafted by Italians. Designed to let you see the real Italy and avoid the tourist traps.</p>
                            <div class="row mt-5 mb-2">
                                <div class="col-lg-3 col-12">
                                    <h6 class="text-dark tet-uppercase">What's included</h6>
                                </div>
                                <div class="col-6">
                                    <hr class="horizontal dark">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 ps-0">
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2"><strong>Completely customizable</strong></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2">Planned excursions, tours and local events</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 ps-sm-2 ps-0">
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2">Luxury accommodations & all travel</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2">24/7 access to our support team</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 my-auto">
                        <div class="card-body text-center">
                            <?php
                            $locations = get_field('locations');
                            $locations_array = explode(",", $locations);
                            $locations_count = count($locations_array);
                            ?>
                            <h6 class="mt-sm-4 mt-0 mb-0">
                                 Get this <?php echo get_field('days'); ?> day, <?php echo $locations_count; ?> city <span class="text-lowercase"><?php echo get_field('category')[0]; ?>:</span>
                            </h6>
                            <h1 class="mt-0">
                                <small>$</small><?php echo get_field('price'); ?>
                            </h1>
                            <button type="button" class="btn bg-gradient-info btn-lg mt-2">Talk to Us</button>
                            <p class="text-sm">Our no-hassle travel experts are here to help</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row trip-package-types d-none" id="custom-trip">
            <div class="card">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body">
                            <h3 class="text-gradient text-info">Custom Itinerary</h3>
                            <p>Every detail designed for your tastes and preferences. The ultimate in Italian travel.</p>
                            <div class="row mt-5 mb-2">
                                <div class="col-lg-3 col-12">
                                    <h6 class="text-dark tet-uppercase">What's included</h6>
                                </div>
                                <div class="col-6">
                                    <hr class="horizontal dark">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 ps-0">
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2"><strong>Everything in our packaged trips plus:</strong></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2">Boutique, luxury hotels</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 ps-sm-2 ps-0">
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2">Private guided tours</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center p-2">
                                        <div class="icon icon-shape icon-xs rounded-circle bg-gradient-dark opacity-6 shadow text-center">
                                            <i class="fas fa-check opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <span class="ps-2">Reservations to the finest local restaurants</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 my-auto">
                        <div class="card-body text-center">
                            <?php
                            $locations = get_field('locations');
                            $locations_array = explode(",", $locations);
                            $locations_count = count($locations_array);
                            ?>
                            <h6 class="mt-sm-4 mt-0 mb-0">
                                 Get your custom  <span class="text-lowercase"><?php echo get_field('category')[0]; ?> itinerary:</span>
                            </h6>
                            <h1 class="mt-0">
                                Get a Quote
                            </h1>
                            <button type="button" class="btn bg-gradient-info btn-lg mt-2">Talk to Us</button>
                            <p class="text-sm">Our no-hassle travel experts are here to help</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>