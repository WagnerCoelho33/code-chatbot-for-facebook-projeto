<?php

namespace App\Http\Controllers;

use CodeBot\WebHook;
use Illuminate\Http\Request;
use CodeBot\SendRequest;
use CodeBot\Message\Text;
use CodeBot\CallSendApi;

class BotController extends Controller
{
    public function subscribe()
    {
        $webhook = new WebHook;
        $subscribe = $webhook->check(config('botfb.validationToken'));
        if (!$subscribe) 
        {
            abort(403, 'Unauthorized action.');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SendRequest;
        $senderId = $sender->getSenderId();
        $message = $sender->getMessage();

        $text = new Text($senderId);
        $callSendApi = new CallSendApi(config('botfb.pageAccessToken'));

        $callSendApi->make($text->message('Oii, eu sou um bot... '));
        $callSendApi->make($text->message('Você digitou: '. $message));

        $message = new Image($sendrId);
        $callSendApi->make($message->message('https://media.tenor.com/images/e16e2812a551f9a788e625a14a969b75/tenor.gif'));
        
        $message = new Audio($sendrId);
        $callSendApi->make($message->message('https://calopsitasbetim.com.br/wp-content/uploads/2016/05/hino-atletico-mp3-calopsitasbetim.mp3?_=1'));

        $message = new Video($sendrId);
        $callSendApi->make($message->message('https://media.tenor.com/images/e16e2812a551f9a788e625a14a969b75/tenor.mp4'));
        return '';

        $message = new File($sendrId);
        $callSendApi->make($message->message('https://media.tenor.com/images/e16e2812a551f9a788e625a14a969b75/tenor.pdf'));
        return '';
    }
}
