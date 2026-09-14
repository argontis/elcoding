<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function learningModul()
    {
        $member = auth('member')->user();

        return view('member.learning-modul', [
            'member' => $member,
        ]);
    }

    public function asesmen()
    {
        $member = auth('member')->user();

        return view('member.asesmen', [
            'member' => $member,
        ]);
    }

    public function invoice()
    {
        $member = auth('member')->user();

        return view('member.invoice', [
            'member' => $member,
        ]);
    }
}
