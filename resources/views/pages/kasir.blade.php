@include('templates.header')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kasir</h6>
            <small>V0.1</small>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-2 gap-4">

                <!-- Kolom Kiri: Nama Produk dan Detail Produk -->
                <div>
                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label class="block text-sm font-semibold space-mono-bold" for="product-name">ID
                            PRODUK</label>
                        <input class="form-control shadow-none mt-1 p-2 w-full border border-gray-300 rounded-md"
                            type="text" name="product-name" id="product-name" value="123341235112">
                    </div>

                    <!-- Detail Produk -->
                    <div>
                        <table class="table-auto w-full text-sm">
                            <div class="w-full border-t"></div>
                            <thead>
                                <tr class="text-left font-semibold space-mono-bold border-b">
                                    <th class="py-2">PRODUK</th>
                                    <th class="py-2 text-center">QTY</th>
                                    <th class="py-2 text-right">HARGA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="overflow-y-auto max-h-48">
                                    <tr>
                                        <td class="py-2 pr-2">{{ $barcodeData ?? '' }}</td>
                                        <td class="py-2 pr-2"></td>
                                        <td class="py-2 text-center">
                                            <input type="number" min="1" value="1"
                                                class="w-16 outline-0 px-2 py-1 border border-gray-300 rounded-md text-center">
                                        </td>
                                        <td class="py-2 text-right">Rp</td>

                                    </tr>
                                </div>
                            </tbody>

                        </table>
                    </div>
                </div>

                <!-- Kolom Kanan: Kode Promo dan Total -->
                <div>
                    <!-- Kode Promo -->
                    <div class="mb-3">
                        <p class="text-sm font-semibold space-mono-bold">KODE PROMO</p>
                        <div class="flex justify-between items-center">
                            <p class="text-sm">:</p>
                            <input type="text" class="border-b outline-0">
                        </div>
                    </div>

                    <!-- Total -->
                    <div>
                        <p class="text-sm font-semibold space-mono-bold">TOTAL BAYAR</p>
                        <div class="flex justify-between items-center">
                            <div class="flex-col">
                                <p class="text-sm">TOTAL</p>
                                <p class="text-sm">DISKON</p>
                            </div>
                            <div class="flex-col">
                                <p class="text-sm">Rp 100.000</p>
                                <p class="text-sm">- Rp 5.000</p>
                            </div>
                        </div>
                        <div class="border-t"></div>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-sm font-semibold space-mono-bold">SUB TOTAL</p>
                            <p class="text-sm font-semibold space-mono-bold">Rp 95.000</p>
                        </div>
                    </div>
                    <!-- Tombol & Tempat Hasil Receipt -->
                    <div class="mt-4">
                        <button id="buatReceipt"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Cetak Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @include('templates.footer')