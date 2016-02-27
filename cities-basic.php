<?php

    include('vendor/autoload.php');
    header("Content-Type: application/json");

    $file = file_get_contents('data/il-ilce.json');
    $data = json_decode($file,true);
    $cities = [];
    $districts = [];

    foreach($data as $district){
        if(!isset($cities[$district['city_id']])){
            $cities[$district['city_id']] = $district['city_name'];
        }
        if(!isset($districts[$district['city_id']])){
            $districts[$district['city_id']] = [];
        }
        else{
            array_push($districts[$district['city_id']], ['id'=>$district['district_id'],'name'=> $district['district_name']]);
        }
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        echo json_encode($districts[$id]);
    }
    else
    {
        echo json_encode($cities);
    }
?>