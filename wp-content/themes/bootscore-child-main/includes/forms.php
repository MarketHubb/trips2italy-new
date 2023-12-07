<?php
function GetSeason() {
    $SeasonDates = array('/12/21'=>'Winter',
        '/09/21'=>'Autumn',
        '/06/21'=>'Summer',
        '/03/21'=>'Spring',
        '/01/01'=>'Winter');
    foreach ($SeasonDates AS $key => $value) // Loop through the season dates
    {
        $SeasonDate = date("Y").$key;
        if (strtotime("now") > strtotime($SeasonDate)) // If we're after the date of the starting season
        {
            return $value;
        }
    }
}

function get_current_year_season() {

    $seasons = [
        'winter' => [
            'start' => '01-12',
            'end' => '28-02',
            'months' => ['12','01','02'],
        ],
        'spring' => [
            'start' => '01-03',
            'end' => '31-05',
            'months' => ['03','04','05'],
        ],
        'summer' => [
            'start' => '01-06',
            'end' => '31-08',
            'months' => ['06','07','08'],
        ],
        'fall' => [
            'start' => '01-09',
            'end' => '30-11',
            'months' => ['09','10','11'],
        ]
    ];

    $today = new \DateTime();
    $current_month = $today->format('m');

    //Check if the year is a leap year (29th of Feb)
    $leap_year_date = '29-02-'.$today->format('Y');
    $is_leap_year = new \Datetime($leap_year_date);

    if ($leap_year_date === $is_leap_year->format('d-m-Y')) {
        $seasons['winter']['end'] = '29-02';
    }

    foreach ($seasons as $season_name => $season) {
        if (in_array($current_month,$season['months'])) {
            return [
                'season' => $season_name,
                'period' => [
                    'start' => new \DateTime($season['start'].'-'.$today->format('Y')),
                    'end' => new \DateTime($season['end'].'-'.$today->format('Y')),
                ]
            ];
        }
    }

}

function return_season_list($current_season) {
    $seasons = ['winter', 'spring', 'summer', 'fall'];
    $current_year = date("Y");

    foreach ($seasons as $key => $season) {
        if ($season === $current_season) {
            break;
        } elseif ($season !== $current_season) {
            unset($seasons[$key]);
            $seasons[] = $season;
        }
    }

    $seasons[] = $current_season;

    return $seasons;
}


// Primary Lead (Form ID - 11)
add_filter( 'gform_pre_render_11', 'populate_seasons_radio_input' );
add_filter( 'gform_pre_validation_11', 'populate_seasons_radio_input' );
add_filter( 'gform_pre_submission_filter_11', 'populate_seasons_radio_input' );
add_filter( 'gform_admin_pre_render_11', 'populate_seasons_radio_input' );
function populate_seasons_radio_input( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ($field_props = $field->id === 8) {
            
            $current_season = get_current_year_season()['season'];
            $season_list = return_season_list($current_season);
            $current_day = date("z");
            $winter_count = 0;
            $choices = [];

            foreach ($season_list as $season) {
                if ($season === 'winter' && $current_day > 200) {
                    $start_year = date("Y");
                    $end_year = date("Y", strtotime('+1 year'));
                    $val = ucfirst($season) . ', ' . $start_year . ' / ' . $end_year;
                    $choices[] = ['text' => $val, 'value' => $val];
                    $winter_count++;
                } else {
                    $year = date("Y", strtotime('+' . $winter_count . ' year'));
                    $val = ucfirst($season) . ', ' . $year;
                    $choices[] = ['text' => $val, 'value' => $val];
                }
            }
            $field->choices = $choices;

        }
    }

    return $form;

}

?>
