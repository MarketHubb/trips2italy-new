<div class="full-width split">
    <div class="row g-0 min-vh-100">
        <div class="col-md-4 bg-full-height" style="background-image: url(<?php echo home_url() . '/wp-content/uploads/2023/07/Packages-Hero-Image.jpg'; ?>);">

        </div>

        <div class="col-md-8">

            <section class="py-7">
                <div class="container bg-white rounded  px-4 py-5 p-md-6">
                    <div class="row">
                        <div class="col">
                            <?php gravity_form(11, $display_title = false, $display_description = false, $display_inactive = false, $field_values=true, $ajax = true, 1); ?>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>