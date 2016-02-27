<?php

namespace MidoriKocak;

class CityFilter implements JsonCityReader
{

    public $data;
    public $cities;
    public $citiesList = [];

    /**
     * PHP 7 ile gelen değişikliklere dikkat edin
     */
    function openJsonFileToArray(string $filename)
    {
        $file = file_get_contents($filename);
        $array = json_decode($file, true);
        $this->data = $array;
    }

    public function prepareData()
    {
        if (!empty($this->data)) {
            foreach ($this->data as $districtData) {
                if(!isset($this->cities[$districtData['city_id']])){
                    $currentCity = $this->cities[$districtData['city_id']] = new City($districtData['city_id'], $districtData['city_name']);
                }
                $district = new District($districtData['district_id'], $currentCity, $districtData['district_name']);
                $currentCity->addDistrict($district);
                if (!isset($this->citiesList[$districtData['city_id']])) {
                    $this->citiesList[$districtData['city_id']] = $districtData['city_name'];
                }
            }
        }
    }

    public function getCities():string
    {
        return json_encode($this->citiesList);
    }

    public function getCity($id):string
    {
        $city = $this->cities[$id];
        return json_encode($city->getArray());
    }
}

class City
{
    private $id;
    private $name;
    private $districts = [];

    public function __construct($id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id()
    {
        return $this->id;
    }

    public function name():string
    {
        return $this->name;
    }

    public function addDistrict(District $district)
    {
        if (!isset($this->districts[$district->id()])) {
            $this->districts[$district->id()] = new District($district->id(), $this, $district->name());
        }
    }

    public function getArray():array
    {
        $districts = [];
        foreach ($this->districts as $district) {
            array_push($districts, $district->getArray());
        }
        return ['id' => $this->id(), 'name' => $this->name(), 'districts' => $districts];
    }

    public function districts():array
    {
        return $this->districts;
    }
}

class District
{
    private $id;
    private $cityId;
    private $name;

    public function __construct($id, City $city, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cityId = $city->id();
    }

    public function getArray():array
    {
        return ['id' => $this->id, 'name' => $this->name];
    }

    public function id()
    {
        return $this->id;
    }

    public function name():string
    {
        return $this->name;
    }
}