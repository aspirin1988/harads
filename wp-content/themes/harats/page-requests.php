<?php

if($_POST['country']) {
    $obls = get_categories(array(
        'parent' => 7,
        'hide_empty' => 0,
    ));

    foreach($obls as $key => $obl) {
        $countries = get_categories(array(
            'parent' => $obl->cat_ID,
            'hide_empty' => 0,
        ));

        foreach($countries as $key2 => $country) {
            $cities = get_categories(array(
                'parent' => $country->cat_ID,
                'hide_empty' => 0,
            ));

            $countries[$key2]->cities = $cities;

        }

        $countries[$key]->countries = $countries;
    }

    echo json_encode($countries);
}