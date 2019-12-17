<?php


namespace Smoqadam\Response;


class Details
{
    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function getVideoId()
    {
        return $this->details['videoId'];
    }

    public function getTitle()
    {
        return $this->details['title'];
    }

    public function getThumbnails()
    {
        return $this->details['thumbnail']['thumbnails'];
    }

    public function getViewCount()
    {
        return $this->details['viewCount'];
    }

    public function getRating()
    {
        return $this->details['averageRating'];
    }
}