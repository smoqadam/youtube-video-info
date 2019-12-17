<?php

use Smoqadam\Collection;
use Smoqadam\Scrapper;
use Smoqadam\Response;

require_once 'vendor/autoload.php';

$scrapper = new Scrapper('VVx6ntr5OqI');

//$thumbs = $scrapper->getDetails()->getThumbnails();
//print_r($thumbs);

$formats = $scrapper->getFormats();
//echo json_decode($formats);
///** @var Response\Entity\Format $format */
//foreach ($formats as $format) {
//    echo $format->getUrl();
//}

//$subs = $scrapper->getCaption('en');
//print_r($subs);


