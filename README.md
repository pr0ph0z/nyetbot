# Nyetbot ![Version](https://img.shields.io/badge/version-0.1.0-brightgreen.svg) [![Build Status](https://travis-ci.com/pr0ph0z/nyetbot.svg?branch=master)](https://travis-ci.com/pr0ph0z/nyetbot) ![compatible](https://img.shields.io/badge/PHP%207-Compatible-brightgreen.svg) ![DUB](https://img.shields.io/dub/l/vibe-d.svg)
LINE Messaging API SDK Lite for PHP.

----------

## Installation
### Using Composer

```sh
composer require pr0ph0z/nyetbot
```

then

```sh
composer install
```

#### Application Key

The next thing you should do after installing packages is set your application key that is needed for the bot.
You can rename the .env.example to .env or copy the .env.example then rename it to .env.

##### Keys
As by the 0.0.1 version, there's 3 key in .env file.

```
LINE_CHANNEL_ACCESS_TOKEN=
LINE_CHANNEL_SECRET=
LINE_TEST_ID=
```

You can obtain the Lchannel access token and channel secret from your [Line Developers page] (https://developers.line.me/console/).
LINE_TEST_ID is optional. You can fill it with your line ID if you want to do a test and the test result will be sended to your line account.

## Examples

All examples can be found [here](https://github.com/pr0ph0z/nyetbot/tree/dev/examples)