<?php


use PHPUnit\Framework\TestCase;
use Smoqadam\Response\Captions;
use Smoqadam\Response\Details;
use Smoqadam\Response\Formats;
use Smoqadam\Video;

class ScrapperTest extends TestCase
{
    private $scrapper;
    private $scrapperInvalid;

    protected function setUp(): void
    {
        $this->scrapper = new Video('VVx6ntr5OqI');
        parent::setUp();
    }

    public function testGetVideoInfo()
    {
        $info = $this->scrapper->getVideoInfo();
        $this->assertIsArray($info);

        $this->assertArrayHasKey('videoDetails', $info);
        $this->assertArrayHasKey('streamingData', $info);
        $this->assertArrayHasKey('adaptiveFormats', $info['streamingData']);
        $this->assertArrayHasKey('captions', $info);
    }

    public function testGetFormats()
    {
        $formats = $this->scrapper->getFormats();
        $this->assertInstanceOf(Formats::class, $formats);
    }

    public function testGetCaption()
    {
        $captions = $this->scrapper->getCaptions();
        $this->assertInstanceOf(Captions::class, $captions);
    }

    public function testGetDetails()
    {
        $details = $this->scrapper->getDetails();
        $this->assertInstanceOf(Details::class, $details);
    }

    public function testInvalidVideoID()
    {
        $this->expectException(Exception::class);
        $this->scrapper->setVideoId('TEST');
        $info = $this->scrapper->getVideoInfo();
        $this->assertArrayHasKey('videoDetails', $info);
        $this->assertArrayHasKey('streamingData', $info);
        $this->assertArrayHasKey('adaptiveFormats', $info['streamingData']);
        $this->assertArrayHasKey('captions', $info);
    }
}
