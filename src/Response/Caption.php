<?php


namespace Smoqadam\Response;

use Smoqadam\Collection;
use Smoqadam\Response\Entity\Subtitle;

class Caption extends Collection
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
    }

    public function getCaptionUrl()
    {
        foreach ($this->captions as $captionTrack) {
            if ($captionTrack['languageCode'] == $this->lang) {
                return $captionTrack['baseUrl'];
            }
        }
        return false;
    }

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