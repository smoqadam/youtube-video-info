<?php


namespace Smoqadam\Response\Entity;


class Subtitle implements \JsonSerializable
{
    private $startTime;
    private $duration;
    private $text;

    /**
     * @return mixed
     */
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     * @return Subtitle
     */
    public function setStartTime(int $startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Subtitle
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Subtitle
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return json_encode([
            'start' => $this->getStartTime(),
            'duration' => $this->getDuration(),
            'text' => $this->getText()
        ]);
    }
}