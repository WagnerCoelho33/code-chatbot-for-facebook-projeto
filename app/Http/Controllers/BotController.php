<?php

namespace App\Http\Controllers;

use CodeBot\WebHook;
use Illuminate\Http\Request;
use CodeBot\SendRequest;
use CodeBot\Message\Text;
use CodeBot\Message\Image;
use CodeBot\Message\Audio;
use CodeBot\Message\File;
use CodeBot\Message\Video;

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

        $message = new Image($senderId);
        $callSendApi->make($message->message('https://fathomless-castle-56481.herokuapp.com/img/homer.gif'));

        $message = new Audio($senderId);
        $callSendApi->make($message->message('https://fathomless-castle-56481.herokuapp.com/audio/woohoo.wav'));

        $message = new File($senderId);
        $callSendApi->make($message->message('https://fathomless-castle-56481.herokuapp.com/file/file.zip'));

        $message = new Video($senderId);
        $callSendApi->make($message->message('https://fathomless-castle-56481.herokuapp.com/video/video.mp4'));

        return '';
    }
}
