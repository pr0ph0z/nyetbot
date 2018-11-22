<?php

require __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
$dotenv->load();
$nyetbot = new Nyetbot\Nyetbot(getenv('LINE_CHANNEL_ACCESS_TOKEN'), getenv('LINE_CHANNEL_SECRET'));

$text = $nyetbot->message->getMessageText();

$nyetbot->message->replyText($text);
file_put_contents('log.txt', date('d-M-Y H:i:s').' Message: '.$nyetbot->message->getMessageText().PHP_EOL, FILE_APPEND);