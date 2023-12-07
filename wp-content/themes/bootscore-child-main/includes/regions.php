<?php
function format_city_title($post_id) {
    $title = trim(get_the_title($post_id));

    if (str_contains($title, "Ultimate Travel Guide")) {
        $clean_title = str_replace("Ultimate Travel Guide", "", $title);
    } else {
        $clean_title = str_replace("Ultimate", "", $title);
        $clean_title = str_replace("Travel Guide", "", $clean_title);
    }

    return $clean_title;
//    $title_topic_array = ["Culture", "Food", "And", "Wine", "History", "Things", "To", "Do"];
//
//    $clean_title_array = explode(" ", $clean_title);
//
//    foreach ($clean_title_array as $word) {
//        if (in_array("word"))
//    }

}

function city_child_topic($post_id) {
    $title = get_the_title($post_id);

    switch (true) {
        case str_contains($title, 'Culture'):
            return "Culture";
        case str_contains($title, 'Food'):
            return "Food & Wine";
        case str_contains($title, 'History'):
            return "History";
        case str_contains($title, 'Things'):
            return "Things To Do";
    }
}

function getEmbeddedPageBuilderVals($content, $search, $attribute) {
    $imageNumbers = array();
    $content_array = explode("\n", $content);
    foreach ($content_array as $text) {
        // Check if the text contains the 'images' attribute
        if (strpos($text, $search) !== false) {
            // Extract the value of the 'images' attribute
            preg_match('/'. $attribute . '="(.*?)"/', $text, $matches);
            // Split the value by comma to get an array of numbers
            $numbers = explode(',', $matches[1]);
            // Add the numbers to the imageNumbers array
            $imageNumbers = array_merge($imageNumbers, $numbers);
        }
    }
    return isset($imageNumbers) ? implode(',',$imageNumbers) : null;
}