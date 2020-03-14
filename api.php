<?php

if (isset($_GET['category'])) {
    $array = creacion();
    $category = $_GET['category'];
    $series = getValores($array);
    $series = $series[ucwords($category)];

    // print_r($series);
}

function creacion()
{
    $url = "http://api.tvmaze.com/shows";
    $array = json_decode(file_get_contents($url), TRUE);
    return $array;
}

function getValores($array)
{
    require_once 'serieIndividual.php';

    $series = array();

    /* for ($i = 0; $i < count($array); $i++) {
            if (in_array(ucwords($categoria), $array[$i]['genres'])) {
                $serie = new Serie($array[$i]['name'], $array[$i]['rating']['average'], $array[$i]['image']['medium'], $array[$i]['id']);
                $series[] = $serie;
            }
        } */

    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array[$i]['genres']); $j++) {
            $serie = array($array[$i]['name'], $array[$i]['rating']['average'], $array[$i]['image']['medium'], $array[$i]['id']);
            $series[$array[$i]['genres'][$j]][] = $serie;
        }
        /* if (in_array(ucwords($categoria), $array[$i]['genres'])) {
                $serie = new Serie($array[$i]['name'], $array[$i]['rating']['average'], $array[$i]['image']['medium'], $array[$i]['id']);
                $series[] = $serie;
            } */
    }

    return $series;
}

function getValoresIndividual($id)
{
    require_once 'serieIndividual.php';
    require_once 'cast.php';

    $url = "http://api.tvmaze.com/shows/" . $id . '?embed=cast';
    $array = json_decode(file_get_contents($url), TRUE);
    $serieTotal = array();

    if (count($array) > 0) {
        $serie = new Serie($array['name'], $array['rating']['average'], $array['image']['original'], $array['id']);
        $serie->setSummary($array['summary']);
        $serie->setLanguage($array['language']);

        $serie->setType($array['type']);
        $serie->setGenres($array['genres']);
        $serie->setStatus($array['status']);
        $serie->setSchedule($array['schedule']['days'][0] . ' at ' . $array['schedule']['time']);

        for ($i = 0; $i < count($array['_embedded']['cast']); $i++) {
            $castIndi = new Cast($array['_embedded']['cast'][$i]['person']['name'], $array['_embedded']['cast'][$i]['character']['name'], $array['_embedded']['cast'][$i]['person']['image']['medium']);
            $cast[] = $castIndi;
        }

        $serieTotal[] = $serie;
        $serieTotal[] = $cast;
    }
    return $serieTotal;
}
