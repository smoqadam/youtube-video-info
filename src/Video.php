<?php


namespace Smoqadam;


use Smoqadam\Response\Details;
use Smoqadam\Response\Formats;
use Smoqadam\Response\Captions;

class Video
{
    /**
     * @var string
     */
    private $videoId;

    /**
     * base url for getting the video information
     * @var string
     */
    private $videoInfoUrl = 'https://youtube.com/get_video_info?video_id=';

    /**
     * @var array
     */
    private $videoInfo;

    public function __construct($videoId = '')
    {
        $this->setVideoId($videoId);
    }

    /**
     * Set the video ID and get the raw video information
     *
     * @param $videoId
     * @return $this
     * @throws \Exception
     */
    public function setVideoId($videoId): self
    {
        $this->videoId = $videoId;
        if (!$this->videoId) {
            throw new \InvalidArgumentException('Video Id is empty');
        }

        parse_str(file_get_contents($this->videoInfoUrl . $this->videoId), $info);

        if (!isset($info['player_response'])) {
            throw new \Exception("Video not found");
        }
        $this->videoInfo = json_decode($info['player_response'], true);
        return $this;
    }

    /**
     * @return array
     */
    public function getVideoInfo(): array
    {
        return $this->videoInfo;
    }

    /**
     * @return Details
     */
    public function getDetails(): Details
    {
        return new Details($this->videoInfo['videoDetails']);
    }

    /**
     * @return Formats
     * @throws \Exception
     */
    public function getFormats(): Formats
    {
        return new Formats($this->videoInfo['streamingData']);
    }

    /**
     * @param string $lang [default='en']
     * @return Captions
     * @throws \Exception
     */
    public function getCaptions($lang = 'en'): Captions
    {
        return new Captions($this->videoInfo['captions'], $lang);
    }
}