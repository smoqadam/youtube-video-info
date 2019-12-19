<?php


namespace Smoqadam\Response;


use Smoqadam\Collection;
use Smoqadam\Response\Entity\Format;

class Formats extends Collection
{
    public function __construct(array $streamDetail)
    {
        if (!isset($streamDetail['adaptiveFormats'])) {
            throw new \Exception('Video formats not found');
        }
        $this->setFormats($streamDetail['adaptiveFormats']);
    }

    public function setFormats($formats): void
    {
        foreach ($formats as $format) {
            $formatObj = new Format();
            $formatObj->setUrl($format['url']);
            $formatObj->setFps($format['fps'] ?? 0);
            $formatObj->setWidth($format['width'] ?? 0);
            $formatObj->setHeight($format['height'] ?? 0);
            $formatObj->setQuality($format['quality']);
            $formatObj->setMimeType($format['mimeType']);
            $formatObj->setSize($format['contentLength']);
            $this[] = $formatObj;
        }
    }
}