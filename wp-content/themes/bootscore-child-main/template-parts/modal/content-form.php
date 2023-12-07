<div id="form">
<?php

$query_params = return_url_query_params();
if (array_key_exists('gclid', $query_params)) {
    $source = "Google Ads";
} else {
    $source = "Facebook Ads";
}

$dynamic = [
    'lead_source' => $source,
    'type' => get_the_title()
];

gravity_form(8, $display_title = false, $display_description = false, $display_inactive = false, $field_values=$dynamic, $ajax = true, 1);
?>
</div>

