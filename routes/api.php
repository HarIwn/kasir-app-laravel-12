<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProductController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::match(['get', 'post'], '/dataCustomer', function (Request $request) {
//     $barcodeData = $request->get('barcode_data') 
//         ?? $request->input('barcode_data') 
//         ?? $request->json('barcode_data');

//     $barcodeType = $request->get('barcode_type') 
//         ?? $request->input('barcode_type') 
//         ?? $request->json('barcode_type');

//     Log::info('📦 Request masuk:', [
//         'barcode_data' => $barcodeData,
//         'barcode_type' => $barcodeType
//     ]);

//     if (!$barcodeData || !$barcodeType) {
//         return response()->json([
//             'message' => 'Data barcode tidak lengkap',
//             'barcode_data' => $barcodeData,
//             'barcode_type' => $barcodeType
//         ], 400);
//     }

//     return response()->json([
//         'barcode_data' => $barcodeData,
//         'barcode_type' => $barcodeType,
//         'message' => 'Berhasil mendapatkan data barcode'
//     ], 200);
// });