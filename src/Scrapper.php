<?php


namespace Smoqadam;


use Smoqadam\Response\Details;
use Smoqadam\Response\Formats;
use Smoqadam\Response\Caption;

class Scrapper
{
    private $videoId;
    private $videoInfoUrl = 'https://youtube.com/get_video_info?video_id=';

    /** 'VVx6ntr5OqIa'
     * @var array
     */
    private $videoInfo;

    public function __construct($videoId = '')
    {
        $this->setVideoId($videoId);
    }

    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
        if (!$this->videoId) {
            throw new \Exception('Video Id is empty');
        }

        parse_str(file_get_contents($this->videoInfoUrl . $this->videoId), $info);

        if (!isset($info['player_response'])) {
            throw new \Exception("Video not found");
        }
        $this->videoInfo = json_decode($info['player_response'], true);
        return $this;
    }


    public function getVideoInfo()
    {
        return $this->videoInfo;
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