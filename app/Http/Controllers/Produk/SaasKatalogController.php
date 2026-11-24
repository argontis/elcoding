<?php

namespace App\Http\Controllers\Produk;

use App\Http\Controllers\Controller;
use App\Models\SaasProduct;
use Illuminate\Http\Request;

class SaasKatalogController extends Controller
{
    /**
     * Tampilkan katalog produk SaaS Elcoding.
     */
    public function index()
    {
        $products = SaasProduct::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('produk.saas', compact('products'));
    }
}
