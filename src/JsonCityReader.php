<?php

namespace MidoriKocak;

interface JsonCityReader {
    function openJsonFileToArray(string $filename);
    function getCities():string;
    function getCity($id):string;
}