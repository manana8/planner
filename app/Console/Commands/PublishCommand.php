<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'user', 'user');
//        $channel = $connection->channel();
//
//        $channel->queue_declare('hello', false, true, false, false);
//
//        $data = ['text'=>'You have been invited to work on this task. If you want to accept this invitation, press YES, otherwise, press NO!', 'subject'=>'Invitation to perform a task'];
//        $msg = new AMQPMessage(json_encode($data));
//        $channel->basic_publish($msg, '', 'hello');
//
//        echo " [x] Sent 'Hello World!'\n";
//
//        $channel->close();
//        $connection->close();
    }
}
