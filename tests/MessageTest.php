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
        $s = $this->bot->message->pushText("Udeadbeefdeadbeefdeadbeefdeadbeef", "test");

        $this->assertNull($s);
    }
}
