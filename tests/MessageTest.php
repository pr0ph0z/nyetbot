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
            getenv("LINE_TEST_ID", "Udeadbeefdeadbeefdeadbeefdeadbeef"), 
            "https://static.videezy.com/system/resources/thumbnails/000/002/361/original/blooming_cherry_tree.jpg", 
            "https://static.videezy.com/system/resources/thumbnails/000/002/361/original/blooming_cherry_tree.jpg"
        );

        $this->assertNull($s);
    }

    public function testPushVideo()
    {
        $this->bot();
        $s = $this->bot->message->pushVideo(
            getenv("LINE_TEST_ID", "Udeadbeefdeadbeefdeadbeefdeadbeef"), 
            "https://static.videezy.com/system/resources/previews/000/002/361/original/blooming-cherry-tree.mp4", 
            "https://static.videezy.com/system/resources/thumbnails/000/002/361/original/blooming_cherry_tree.jpg"
        );

        $this->assertNull($s);
    }

    public function testPushAudio()
    {
        $this->bot();
        $s = $this->bot->message->pushAudio(
            getenv("LINE_TEST_ID", "Udeadbeefdeadbeefdeadbeefdeadbeef"), 
            "https://cdn.online-convert.com/example-file/audio/m4a/example.m4a", 
            36000
        );

        $this->assertNull($s);
    }    

    public function testPushLocation()
    {
        $this->bot();
        $s = $this->bot->message->pushLocation(
            getenv("LINE_TEST_ID", "Udeadbeefdeadbeefdeadbeefdeadbeef"),
            "Institut Teknologi Bandung",
            "Jl. Ganesha No.10, Lb. Siliwangi, Coblong, Kota Bandung, Jawa Barat 40132",
            -6.8944857,
            107.6031654
        );

        $this->assertNull($s);
    }

    public function testPushSticker()
    {
        $this->bot();
        $s = $this->bot->message->pushSticker(
            getenv("LINE_TEST_ID", "Udeadbeefdeadbeefdeadbeefdeadbeef"),
            1,
            1
        );

        $this->assertNull($s);
    }

    public function testGetProfile()
    {
        $this->bot();

        $s = $this->bot->profile->getProfile("U74b3790aa73ad03017e8b8ee16cb5f23"); // this is my LINE ID lol
        $s = json_decode($s, true);

        $this->assertArrayHasKey('displayName', $s);
    }
}
