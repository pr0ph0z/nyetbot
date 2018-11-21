<?php
use Nyetbot\Nyetbot;
use Dotenv\Dotenv;

class MessageTest extends \PHPUnit\Framework\TestCase
{
    protected $bot;

    public function bot()
    {
        $dotenv = new Dotenv(__DIR__.'/..');
        $dotenv->load();
        $this->bot = new Nyetbot();
        $this->bot->setChannelAcessToken(getenv('LINE_CHANNEL_ACCESS_TOKEN'));
        $this->bot->setChannelSecret(getenv('LINE_CHANNEL_SECRET'));
    }

    public function testPushText()
    {
        $this->bot();
        $s = $this->bot->message->pushText(getenv("LINE_TEST_ID"), "test");

        $this->assertNull($s);
    }

    public function testPushImage()
    {
        $this->bot();
        $s = $this->bot->message->pushImage(
            getenv("LINE_TEST_ID"), 
            "https://static.videezy.com/system/resources/thumbnails/000/002/361/original/blooming_cherry_tree.jpg", 
            "https://static.videezy.com/system/resources/thumbnails/000/002/361/original/blooming_cherry_tree.jpg"
        );

        $this->assertNull($s);
    }

    public function testPushVideo()
    {
        $this->bot();
        $s = $this->bot->message->pushVideo(
            getenv("LINE_TEST_ID"), 
            "https://static.videezy.com/system/resources/previews/000/002/361/original/blooming-cherry-tree.mp4", 
            "https://static.videezy.com/system/resources/thumbnails/000/002/361/original/blooming_cherry_tree.jpg"
        );

        $this->assertNull($s);
    }
}
