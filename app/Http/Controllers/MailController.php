<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $email = $request->email;

        $details = [
            'title' => 'Email from Admin',
            'body' => $email
        ];

        Mail::to($email)->send(new MyTestMail($details));

        return response()->json([
            'message' => 'Email has been sent.'
        ], Response::HTTP_OK);
    }
}
