<?php

namespace App\Service;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitService
{
    public function connection() {
        return new AMQPStreamConnection('rabbitmq', 5672, 'user', 'user');
    }

    public function publish(int $id) {
        $connection = $this->connection();
        $channel = $connection->channel();

        $msg = new AMQPMessage($id);
        $channel->basic_publish($msg, '', 'hello');

        $channel->close();
        $connection->close();
    }

    public function consumer(string $messageContent, string $subject)
    {
        $connection = $this->connection();
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, true, false, false); //объявляем очередь

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) use ($messageContent, $subject) {
            $invitationId = $msg->body;
            $invitation = Invitation::where('id', '=', $invitationId)->first();

            $userTo = User::where('id', '=', $invitation->user_id_to)->first();
            $userFrom = User::where('id', '=', $invitation->user_id_from)->first();

            $mail = ['user'=>$userTo, 'userFrom'=>$userFrom, 'invitation'=>$invitation, 'text'=>$messageContent, 'subject'=>$subject];

            Mail::send(['text'=>'mail'], $mail, function($message) use ($userTo, $userFrom, $mail) {
                $message->to($userTo->email, $userTo->name)->subject($mail['subject']);
                $message->from($userFrom->email, $userFrom->name);
            });
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
