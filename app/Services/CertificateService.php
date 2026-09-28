<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CertificateService
{
    public static function generatePdf($profile, $certificate)
    {
        $pdf = Pdf::loadView('pdf.certificate', compact('profile', 'certificate'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download("Sertifikat_{$profile->user->name}.pdf");
    }

    public static function generateImage($profile, $certificate)
    {
        // Image generation using Intervention Image v3
        $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $img = $manager->createImage(1123, 794)->fill('#f8fafc');
        
        // Border using lines
        $img->drawLine(function($line) { $line->from(50, 50)->to(1073, 50)->color('#e2e8f0')->width(2); }); // Top
        $img->drawLine(function($line) { $line->from(50, 744)->to(1073, 744)->color('#e2e8f0')->width(2); }); // Bottom
        $img->drawLine(function($line) { $line->from(50, 50)->to(50, 744)->color('#e2e8f0')->width(2); }); // Left
        $img->drawLine(function($line) { $line->from(1073, 50)->to(1073, 744)->color('#e2e8f0')->width(2); }); // Right

        // Add Logo if exists
        $logoPath = public_path('gambar/aset/logo.png');
        if (file_exists($logoPath)) {
            $logo = $manager->decode($logoPath)->scale(120);
            $img->insert($logo, 501, 80); // 561 - 60
        }

        $fontBold = public_path('assets/wp-content/uploads/2024/02/PlusJakartaSans-Bold.ttf');
        $fontRegular = public_path('assets/wp-content/uploads/2024/02/PlusJakartaSans-Regular.ttf');
        
        if (!file_exists($fontBold)) {
            $fontBold = 5;
            $fontRegular = 3;
        }

        // Title
        $img->text('SERTIFIKAT KELULUSAN MAGANG / PKL', 561, 190, function($font) use ($fontBold) {
            $font->filename($fontBold);
            $font->size(20);
            $font->color('#d97706');
            $font->align('center');
        });

        // Subtitle
        $img->text('No. Reg: ' . $certificate->certificate_number, 561, 230, function($font) use ($fontRegular) {
            $font->filename($fontRegular);
            $font->size(16);
            $font->color('#64748b');
            $font->align('center');
        });

        $img->drawLine(function($line) {
            $line->from(161, 270);
            $line->to(961, 270);
            $line->color('#e2e8f0');
            $line->width(1);
        });

        // Presented to
        $img->text('Diberikan secara resmi kepada:', 561, 310, function($font) use ($fontRegular) {
            $font->filename($fontRegular);
            $font->size(16);
            $font->color('#64748b');
            $font->align('center');
        });

        // Name
        $img->text($profile->user->name, 561, 370, function($font) use ($fontBold) {
            $font->filename($fontBold);
            $font->size(46);
            $font->color('#0f172a');
            $font->align('center');
        });

        // Institution
        $img->text($profile->institution . ' — ' . $profile->major, 561, 420, function($font) use ($fontBold) {
            $font->filename($fontBold);
            $font->size(20);
            $font->color('#475569');
            $font->align('center');
        });

        // Description
        $img->text('Telah menyelesaikan seluruh rangkaian Praktik Kerja Lapangan (PKL) / Magang di elc.my.id', 561, 460, function($font) use ($fontRegular) {
            $font->filename($fontRegular);
            $font->size(16);
            $font->color('#64748b');
            $font->align('center');
        });
        
        $img->text('pada divisi ' . ($profile->division ?? 'IT & Development') . ' dengan hasil akhir predikat:', 561, 490, function($font) use ($fontRegular) {
            $font->filename($fontRegular);
            $font->size(16);
            $font->color('#64748b');
            $font->align('center');
        });

        // Predicate Background
        $img->drawLine(function($line) {
            $line->from(361, 545)->to(761, 545)->color('#f59e0b')->width(50);
        });

        // Predicate
        $img->text('PREDIKAT: ' . strtoupper($certificate->predicate), 561, 553, function($font) use ($fontBold) {
            $font->filename($fontBold);
            $font->size(22);
            $font->color('#020617');
            $font->align('center');
        });

        // Date (Below Predicate)
        $img->drawLine(function($line) {
            $line->from(486, 610);
            $line->to(636, 610);
            $line->color('#cbd5e1');
            $line->width(1);
        });

        $img->text('Diterbitkan Tanggal', 561, 635, function($font) use ($fontRegular) {
            $font->filename($fontRegular);
            $font->size(14);
            $font->color('#64748b');
            $font->align('center');
        });

        $date = $certificate->issue_date ? $certificate->issue_date->format('d F Y') : date('d F Y');
        $img->text($date, 561, 665, function($font) use ($fontBold) {
            $font->filename($fontBold);
            $font->size(18);
            $font->color('#0f172a');
            $font->align('center');
        });

        // Signature (Right Side)
        $img->text('Pimpinan / Direktur', 900, 610, function($font) use ($fontRegular) {
            $font->filename($fontRegular);
            $font->size(14);
            $font->color('#64748b');
            $font->align('center');
        });
        
        $barcodePath = public_path('gambar/aset/ttd_barcode.png');
        if (file_exists($barcodePath)) {
            $barcode = $manager->decode($barcodePath)->scaleDown(width: 80);
            $img->insert($barcode, 860, 615); // 900 - 40
        }

        $img->drawLine(function($line) {
            $line->from(810, 705);
            $line->to(990, 705);
            $line->color('#cbd5e1');
            $line->width(1);
        });

        $img->text('Zaky Afrizal', 900, 730, function($font) use ($fontBold) {
            $font->filename($fontBold);
            $font->size(18);
            $font->color('#0f172a');
            $font->align('center');
        });

        return response($img->encodeUsingMediaType('image/jpeg', 90))
               ->header('Content-Type', 'image/jpeg')
               ->header('Content-Disposition', 'attachment; filename="Sertifikat_'.$profile->user->name.'.jpg"');
    }
}
