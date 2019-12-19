## youtube-video-info

Get the information about a youtube video

## Installation

`$ composer require smoqadam/youtube-video-info:dev-master`


## Usage

it's so easy to get the information about a youtueb's video. Let's say we need to fetch the caption for a spicific video:

```php

<?php

use Smoqadam;
use Smoqadam\Response\Entity\Subtitle;

ini_set('display_errors', 'On');
require_once 'vendor/autoload.php';

$videoId = 'VVx6ntr5OqI';
$video = new Video($videoId);

$captions = $video->getCaptions('en');

/** @var Subtitle $caption */
foreach ($captions as $caption) {
    echo $caption->getText();
    echo '<br>';
    echo $caption->getStart();
    echo '<br>';
    echo $caption->getDuration();
    echo '<br>';
    echo '<hr>'
}

```
Let's get the formats for that video:

```php
$formats = $video->getFormats();
/** @var Format $format */
foreach ($formats as $format) {
    echo $format->getUrl();
    echo $format->getMimeType();
    echo $format->getWidth();
    echo $format->getHeight();
    echo $format->getSize(); // in bytes
    echo $format->getQuality();
    echo $format->getFps();
    echo '<br>';
}
```

And finally, let's get some details about the video:

```php 

$details = $video->getDetails();
echo $details->getVideoId();
echo $details->getTitle();
echo $details->getThumbnails();
echo $details->getViewCount();
echo $details->getRating();
```


