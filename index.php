<?php


use Smoqadam\Video;
use Smoqadam\Response;

require_once 'vendor/autoload.php';

$video = new Video('VVx6ntr5OqI');



echo json_encode($video->getFormats());