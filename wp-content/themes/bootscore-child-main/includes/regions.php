<?php
function checkFirstTwoChars($str)
{
    $firstTwoChars = substr($str, 0, 2);

    if (strtolower($firstTwoChars) === '<h') {
        return true;
    } else {
        return false;
    }
}

function explodeByH3($str)
{
    $pattern = '/(<h3>.*?<\/h3>)/i';
    $result = preg_split($pattern, $str, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    return $result;
}

function splitStringByHeadings($string)
{
    $output = [];
    $currentItem = '';
    $length = strlen($string);
    $i = 0;

    while ($i < $length) {
        if ($string[$i] === '<' && ($string[$i + 1] === 'h' || $string[$i + 1] === 'H' || $string[$i + 1] === 'p')) {
            if (!empty($currentItem)) {
                $output[] = $currentItem;
                $currentItem = '';
            }
            $currentItem .= $string[$i];
            $i++;
            while ($i < $length && $string[$i] !== '>') {
                $currentItem .= $string[$i];
                $i++;
            }
            if ($i < $length) {
                $currentItem .= $string[$i];
            }
        } else {
            $currentItem .= $string[$i];
        }
        $i++;
    }

    if (!empty($currentItem)) {
        $output[] = $currentItem;
    }

    return $output;
}
function format_city_title($post_id)
{
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

function city_child_topic($post_id)
{
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

function getEmbeddedPageBuilderVals($content, $search, $attribute)
{
    $imageNumbers = array();
    $content_array = explode("\n", $content);
    foreach ($content_array as $text) {
        // Check if the text contains the 'images' attribute
        if (strpos($text, $search) !== false) {
            // Extract the value of the 'images' attribute
            preg_match('/' . $attribute . '="(.*?)"/', $text, $matches);
            // Split the value by comma to get an array of numbers
            $numbers = explode(',', $matches[1]);
            // Add the numbers to the imageNumbers array
            $imageNumbers = array_merge($imageNumbers, $numbers);
        }
    }
    return isset($imageNumbers) ? implode(',', $imageNumbers) : null;
}
