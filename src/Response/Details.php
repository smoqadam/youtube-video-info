<?php


namespace Smoqadam\Response;


class Details
{
    private $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->details['videoId'];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->details['title'];
    }

    /**
     * @return array
     */
    public function getThumbnails(): array
    {
        return $this->details['thumbnail']['thumbnails'];
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return intval($this->details['viewCount']);
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return floatval($this->details['averageRating']);
    }
}