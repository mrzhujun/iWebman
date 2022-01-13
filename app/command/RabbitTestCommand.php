<?php

namespace app\command;

use Bunny\Channel;
use Bunny\Message;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Workerman\RabbitMQ\Client;

class RabbitTestCommand extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'config:rabbitMq';
    protected static $defaultDescription = '显示当前MySQL服务器配置';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('开始：');

            (new Client())->connect()->then(function (Client $client) {
                return $client->channel();
            })->then(function (Channel $channel) {
                return $channel->queueDeclare('hello', false, false, false, false)->then(function () use ($channel) {
                    return $channel;
                });
            })->then(function (Channel $channel) {
                echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
                $channel->consume(
                    function (Message $message, Channel $channel, Client $client) {
                        echo " [x] Received ", $message->content, "\n";
                    },
                    'hello',
                    '',
                    false,
                    true
                );
            });
            sleep(3);

    }

}