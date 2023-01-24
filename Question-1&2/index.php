<?php

//Get the web services
require_once('services/WebServices.php');

$xmlData = simplexml_load_string(file_get_contents("php://input"));

$webservice = new WebServices($xmlData);

$option = (string)$xmlData->type;

switch ($option) {
    case 'center':
        $webservice->studentsWithCenter();
        break;

    case 'category':
        $webservice->studentsWithCategory();
        break;

    case 'count':
        $webservice->studentsWithCount();
        break;
}
