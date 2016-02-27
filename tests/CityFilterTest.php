<?php
use MidoriKocak\CityFilter;

class CityFilterTest extends PHPUnit_Framework_TestCase
{
    public $cities;
    public $districts;
    public $cityFilter;

    public function setup()
    {
        $this->cityFilter = new CityFilter();
        $this->cityFilter->openJsonFileToArray('data/il-ilce.json');
        $this->cityFilter->prepareData();
        $this->compareCity = '{"id":6,"name":"Ankara","districts":[{"id":1130,"name":"Alt\u0131nda\u011f"},{"id":1157,"name":"Aya\u015f"},{"id":1167,"name":"Bala"},{"id":1187,"name":"Beypazar\u0131"},{"id":1227,"name":"\u00c7aml\u0131dere"},{"id":1231,"name":"\u00c7ankaya"},{"id":1260,"name":"\u00c7ubuk"},{"id":1302,"name":"Elmada\u011f"},{"id":1365,"name":"G\u00fcd\u00fcl"},{"id":1387,"name":"Haymana"},{"id":1427,"name":"Kalecik"},{"id":1473,"name":"K\u0131z\u0131lcahamam"},{"id":1539,"name":"Nall\u0131han"},{"id":1578,"name":"Polatl\u0131"},{"id":1658,"name":"\u015eerefliko\u00e7hisar"},{"id":1723,"name":"Yenimahalle"},{"id":1744,"name":"G\u00f6lba\u015f\u0131 \/ Ankara"},{"id":1745,"name":"Ke\u00e7i\u00f6ren"},{"id":1746,"name":"Mamak"},{"id":1747,"name":"Sincan"},{"id":1815,"name":"Kazan"},{"id":1872,"name":"Akyurt"},{"id":1922,"name":"Etimesgut"},{"id":1924,"name":"Evren"},{"id":2034,"name":"Pursaklar"}]}';
    }

    public function testGetCity()
    {
        $this->assertEquals($this->cityFilter->getCity('6'), $this->compareCity);
    }
}

?>
