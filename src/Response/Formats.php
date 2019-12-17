<?php


namespace Smoqadam\Response;


use Smoqadam\Collection;
use Smoqadam\Response\Entity\Format;

class Formats extends Collection
{
    public function __construct($streamDetail)
    {
        $this->setFormats($streamDetail['adaptiveFormats']);
    }

    public function setFormats($formats)
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