<?php

namespace App\Console\Commands;

use App\Models\Invitation;
use App\Models\User;
use App\Service\ConsumerService;
use App\Service\RabbitService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consume';

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
//        $channel->queue_declare('hello', false, true, false, false); //объявляем очередь
//
//        echo " [*] Waiting for messages. To exit press CTRL+C\n";
//
//        $callback = function ($msg) {
//            $invitationId = $msg->body;
//            $invitation = Invitation::where('id', '=', $invitationId)->first();
//
//            $userTo = User::where('id', '=', $invitation->user_id_to)->first();
//            $userFrom = User::where('id', '=', $invitation->user_id_from)->first();
//
//            $text = ['user'=>$userTo, 'userFrom'=>$userFrom, 'invitation'=>$invitation, 'text'=>'You have been invited to work on this task. If you want to accept this invitation, press YES, otherwise, press NO!', 'subject'=>'Invitation to perform a task'];
//
//            Mail::send(['text'=>'mail'], $text, function($message) use ($userTo, $userFrom, $text) {
//                $message->to($userTo->email, $userTo->name)->subject($text['subject']);
//                $message->from($userFrom->email, $userFrom->name);
//            });
//        };
//
//        $channel->basic_consume('hello', '', false, true, false, false, $callback);
//
//        try {
//            $channel->consume();
//        } catch (\Throwable $exception) {
//            echo $exception->getMessage();
//        }
        $messageContent = 'You have been invited to work on this task. If you want to accept this invitation, press YES, otherwise, press NO!';
        $subject = '11111111111111111111111';

        $consumerService = new RabbitService();
        $consumerService->consumer($messageContent, $subject);
    }
}
