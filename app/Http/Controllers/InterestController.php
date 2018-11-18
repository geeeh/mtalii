<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interest;
use Mail;

class InterestController extends Controller
{

    /**
     * Create a new event.
     *
     * @param int     $event_id - parent event id.
     * @param Request $request  - request payload.
     *
     * @return null
     */
    public function create($event_id, Request $request)
    {
        $interest = new Interest();
        $interest->event_id = $event_id;
        $interest->email =  $request->input("email");
        $interest->phone = $request->input("phone");
        if ($interest->save()) {
            $this->_sendEmail($request->input());
        }

    }

    /**
     * Send email function.
     *
     * @param object $email - email data
     *
     * @return null
     */
    private function _sendEmail($email)
    {
        Mail::send(
            'emails.request', $email, function ($message) {
                $message->from('no-reply@mtalii.co.ke', 'Mtalii');
                $message->subject('Event Request');
                $message->to('godwingitonga89@gmail.com')
                    ->cc('godwingitonga89@gmail.com');
            }
        );
    }
}
