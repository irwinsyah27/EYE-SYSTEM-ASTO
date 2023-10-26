<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class EmailSend
{
    public static function sendEmail($email, $status, $description){

        $data['email'] = $email;
        $data['title'] = 'Notifikasi Workorder Eye System';
        $data['status'] = $status;
        $data['description'] = $description;

        Mail::send('pages.email.email', ['data' => $data], function($message) use ($data) {
            $message->to($data['email'])->subject($data['title']);
        });
    }

    public static function adminSendEmail(){

        $data['title'] = 'Notifikasi Workorder Eye System';
        $data['body'] = 'Hallo Eye System, ada Pengajuan Permohonan dari aplikasi, Silahkan Dicek';
        $data['email'] = 'admin.eng.asto@kppmining.com';
        $data['cc'] = ['afrizal.yura@kppmining.com','agnesti.indul@kppmining.com','yoga.efendi@kppmining.com'];

        Mail::send('pages.email.adminEmail', ['data' => $data], function($message) use ($data) {
            $message->to($data['email'])->subject($data['title'])->cc($data['cc']);
        });
    }
}
