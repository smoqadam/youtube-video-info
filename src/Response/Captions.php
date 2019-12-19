<?php


namespace Smoqadam\Response;

use Smoqadam\Collection;
use Smoqadam\Response\Entity\Subtitle;

class Captions extends Collection
{
    private $captions;
    private $lang;

    public function __construct($captions, $lang)
    {
        if (!isset($captions['playerCaptionsTracklistRenderer']) || !isset($captions['playerCaptionsTracklistRenderer']['captionTracks'])) {
            throw new \Exception('Caption not found');
        }
        $this->captions = $captions['playerCaptionsTracklistRenderer']['captionTracks'];
        $this->lang = $lang;
        $this->parse();
    }

    /**
     * @return bool|mixed
     */
    public function getCaptionUrl()
    {
        foreach ($this->captions as $captionTrack) {
            if ($captionTrack['languageCode'] == $this->lang) {
                return $captionTrack['baseUrl'];
            }
        }
        return false;
    }

    /**
     * Fetch and parse the video caption
     *
     * @return $this
     * @throws \Exception
     */
    public function parse(): self
    {
        $captionUrl = $this->getCaptionUrl();
        if (!$captionUrl) {
            throw new \Exception("Caption for language: {$this->lang} not found");
        }

        $captions = new \SimpleXMLElement(file_get_contents($captionUrl));
        foreach ($captions as $caption) {
            $sub = new Subtitle();
            $sub->setDuration((int)$caption['dur']);
            $sub->setStartTime((int)$caption['start']);
            $sub->setText((string)$caption);
            $this[] = $sub;
        }
        return $this;
    }
}