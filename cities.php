<?php

    include('vendor/autoload.php');
    header("Content-Type: application/json");

    $cityFilter = new \MidoriKocak\CityFilter();
    $cityFilter->openJsonFileToArray('data/il-ilce.json');
    $cityFilter->prepareData();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        echo $cityFilter->getCity($id);
    }
    else
    {
        echo $cityFilter->getCities();
    }
?>