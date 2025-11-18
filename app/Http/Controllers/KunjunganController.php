<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KunjunganController extends Controller
{
        public function show($id)
    {

        // kalau tidak ditemukan, Anda tetap render page detail (JS sudah ada fallback ke sessionStorage)
       return view('kunjungan.detail-riwayat');
    }
}
