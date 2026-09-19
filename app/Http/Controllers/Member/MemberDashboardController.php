<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $member = auth('member')->user() ?? auth('web')->user();

        return view('member.dashboard', [
            'member' => $member,
        ]);
    }
}
