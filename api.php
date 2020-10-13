<?php

if (isset($_GET['category'])) {
    $array = creacion();
    $category = $_GET['category'];
    $series = getValores($array);
    $series = $series[ucwords($category)];
}

function creacion()
{
    $url = "http://api.tvmaze.com/shows";
    $array = json_decode(file_get_contents($url), TRUE);
    return $array;
}

function getValores($array)
{
    $series = array();

    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < count($array[$i]['genres']); $j++) {
            $image = str_replace('http', 'https', $array[$i]['image']['medium']);
            $serie = array($array[$i]['name'], $array[$i]['rating']['average'], $image, $array[$i]['id']);
            $series[$array[$i]['genres'][$j]][] = $serie;
        }
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
        $image = str_replace('http', 'https', $array['image']['original']);
        $serie = new Serie($array['name'], $array['rating']['average'], $array['image']['original'], $array['id']);
        $serie->setSummary($array['summary']);
        $serie->setLanguage($array['language']);

        $serie->setType($array['type']);
        $serie->setGenres($array['genres']);
        $serie->setStatus($array['status']);
        $serie->setSchedule($array['schedule']['days'][0] . ' at ' . $array['schedule']['time']);

        for ($i = 0; $i < count($array['_embedded']['cast']); $i++) {
            $imageCast = $array['_embedded']['cast'][$i]['person']['image']['medium'];
            $castIndi = new Cast($array['_embedded']['cast'][$i]['person']['name'], $array['_embedded']['cast'][$i]['character']['name'], $imageCast);
            $cast[] = $castIndi;
        }

        $serieTotal[] = $serie;
        $serieTotal[] = $cast;
    }
    return $serieTotal;
}
