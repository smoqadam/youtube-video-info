<?php

namespace Response;

use PHPUnit\Framework\TestCase;
use Smoqadam\Response\Captions;
use Smoqadam\Video;

class CaptionTest extends TestCase
{
    /**
     * @var Captions
     */
    private $caption;
    private $scrapper;

    protected function setUp(): void
    {
        $this->scrapper = new Video('VVx6ntr5OqI');
        $this->caption = $this->scrapper->getCaptions();
        parent::setUp();
    }


    public function testGetCaptionUrl()
    {
        $res = filter_var($this->caption->getCaptionUrl(), FILTER_VALIDATE_URL);
        $this->assertNotFalse($res);
    }

    public function testParse()
    {
        $captions = $this->caption->parse();
        $this->assertInstanceOf(\ArrayAccess::class, $captions);
    }

    public function testParseFailed()
    {
        $this->expectException(\Exception::class);
        $this->scrapper->setVideoId('TEST');
        $captions = $this->caption->parse();
        $this->assertInstanceOf(\ArrayAccess::class, $captions);
    }
}
