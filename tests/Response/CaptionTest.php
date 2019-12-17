<?php

namespace Response;

use PHPUnit\Framework\TestCase;
use Smoqadam\Response\Caption;
use Smoqadam\Scrapper;

class CaptionTest extends TestCase
{
    /**
     * @var Caption
     */
    private $caption;
    private $scrapper;

    protected function setUp(): void
    {
        $this->scrapper = new Scrapper('VVx6ntr5OqI');
        $this->caption = $this->scrapper->getCaption();
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
