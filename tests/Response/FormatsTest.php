<?php

namespace Response;

use Smoqadam\Response\Formats;
use PHPUnit\Framework\TestCase;
use Smoqadam\Video;

class FormatsTest extends TestCase
{
    /**
     * @var Formats
     */
    private $formats;
    private $scrapper;
    private $videoId = 'VVx6ntr5OqI';

    protected function setUp(): void
    {
        $this->scrapper = new Video($this->videoId);
        $this->formats = $this->scrapper->getFormats();
        parent::setUp();
    }

    public function testFormatsNotFound()
    {
        $this->expectException(\Exception::class);

        $this->scrapper->setVideoId('test');
        $formats = $this->scrapper->getFormats();

    }

    public function testFormatAsJson()
    {
        $this->assertJson(json_encode($this->formats));
    }
}
