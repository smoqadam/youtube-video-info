<?php


use Smoqadam\Scrapper;
use Smoqadam\Response;

require_once 'vendor/autoload.php';

$scrapper = new Scrapper('VVx6ntr5OqI');

//$captions = $scrapper->getCaptions();

//echo json_encode($captions);

echo json_encode($scrapper->getFormats());