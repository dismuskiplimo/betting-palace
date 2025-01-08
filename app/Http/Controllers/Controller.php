<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $image_path;

    protected $_date;

    public function __construct(){
        $this->image_path = base_path(config('app.public_path') . '/' . 'images' . '/' . 'uploads');
    }

    public function log_error(\Exception $e){
        $error_log          = new \App\ErrorLog;
        $error_log->title   = $e->getMessage();
        $error_log->content = $e;
        $error_log->save();

        if(config('mail.enabled')){
            $title = config('app.name') . " | Error - Action needed";

            try{
                \Mail::send('emails.exception-detected', ['title' => $title, 'e' => $e], function ($message) use($title){
                    $message->subject($title);
                    $message->to(env('DEVELOPER_EMAIL'));
                });

            }catch(\Exception $e){
                //dd($e);
            }
        }
    }
}
