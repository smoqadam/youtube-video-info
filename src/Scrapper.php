<?php


namespace Smoqadam;


use Smoqadam\Response\Details;
use Smoqadam\Response\Formats;
use Smoqadam\Response\Caption;

class Scrapper
{
    private $videoId;
    private $lang;
    private $caption;
    private $videoInfoUrl = 'https://youtube.com/get_video_info?video_id=';

    /**
     * @var array
     */
    private $videoInfo;

    public function __construct($videoId)
    {
        $this->videoId = $videoId;
        parse_str(file_get_contents($this->videoInfoUrl . $videoId), $info);
        $this->videoInfo = json_decode($info['player_response'], true);
    }

    public function getDetails(): Details
    {
        return new Details($this->videoInfo['videoDetails']);
    }

    public function getFormats()
    {
        return new Formats($this->videoInfo['streamingData']);
    }

    public function getAdaptiveFormats()
    {
        return $this->videoInfo['streamingData']['adaptiveFormats'];
    }

    public function getCaption($lang = 'en')
    {
        return new Caption($this->videoInfo['captions'], $lang);
    }
}