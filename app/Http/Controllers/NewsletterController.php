<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //
    public function saveEmail(Request $request)
    {

        $request->validate([
            "email" => "required|string|unique:newsletter,emails"
        ]);

        $newsletter = new Newsletter();
        $newsletter->emails = $request->input('email');
        $newsletter->save();

        return response(['message' => 'email subscription added'], 200);
    }

    public function getEmails()
    {
        $newsletters = Newsletter::all();
        return response()->json(['mailing list' => $newsletters], 200);
    }
}
