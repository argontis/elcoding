<?php

namespace App\Http\Controllers;

use App\Models\PklCertificate;
use Illuminate\Http\Request;

class CertificateVerificationController extends Controller
{
    public function verify(Request $request, $code = null)
    {
        $searchCode = $code ?: $request->query('code');
        $certificate = null;
        $searched = false;

        if ($searchCode) {
            $searched = true;
            $certificate = PklCertificate::with(['profile.user', 'profile.program'])
                ->where('certificate_number', trim($searchCode))
                ->first();
        }

        return view('verifikasi-sertifikat', compact('certificate', 'searchCode', 'searched'));
    }
}
