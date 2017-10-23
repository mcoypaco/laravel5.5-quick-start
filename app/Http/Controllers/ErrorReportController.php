<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests\SendErrorReport;
use App\Notifications\SendErrorReportNotification;
use Notification;

class ErrorReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(SendErrorReport $request)
    {
        $recipients = User::where('admin', true)->get();

        Notification::send($recipients, new SendErrorReportNotification($request));

        return response()->json(true);
    }
}

