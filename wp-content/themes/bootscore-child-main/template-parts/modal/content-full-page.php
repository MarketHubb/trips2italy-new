<?php //if (isset($args)) { ?>

    <!-- Full screen modal -->
    <div class="modal fade" id="leadModal" tabindex="-1" aria-labelledby="leadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <section class="py-7 bg-gray-100">
                        <div class="container bg-white rounded shadow-filter-md px-4 py-5 p-md-6">
                            <div class="row">
                                <div class="col">
                                    <?php gravity_form(11, $display_title = false, $display_description = false, $display_inactive = false, $field_values=true, $ajax = true, 1); ?>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<?php //} ?>
