@include('templates.header')

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-primary">Produk Terdaftar</h6>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control mr-3" name="search" id="search" placeholder="Cari Produk...">
                <button type="button" class="btn btn-primary text-nowrap" data-toggle="modal"
                    data-target="#TambahProdukModal">
                    <i class="fas fa-plus-circle"></i> <span>Produk</span>
                </button>
            </div>
        </div>

        <div class="card-body">
            <!-- Tabel Data Produk -->
            <table class="table table-bordered" id="table-list-produk">
                <thead class="thead-light">
                    <tr>
                        <th>NAMA PRODUK</th>
                        <th>HARGA PRODUK</th>
                        <th>STOK PRODUK</th>
                        <th>NO BARCODE</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>
                                <div class="d-flex justify-content-around">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Hapus"><i
                                                class="fas fa-trash"></i></button>
                                    </form>

                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#TambahStokProduk" title="Tambah Stok">
                                        <i class="fas fa-cube"></i>
                                    </button>

                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#editProdukModal" title="Edit Produk">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <!-- Pesan jika tidak ada produk yang ditemukan -->
                    <tr id="noProdukMsg" style="display: none;">
                        <td colspan="5" class="text-center">Nama produk '<span id="searchQuery"></span>' tidak
                            ditemukan!</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="TambahProdukModal" tabindex="-1" role="dialog" aria-labelledby="modalTambahProduk"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="mb-2">Nama Produk</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Produk..." required>

                    <label class="my-2">Harga Produk</label>
                    <input type="number" class="form-control" name="price" placeholder="Masukkan Harga Produk..."
                        required>

                    <label class="my-2">Stok Produk</label>
                    <input type="number" class="form-control" name="stock" placeholder="Masukkan Stok Produk..."
                        required>

                    <label class="my-2">SKU | Barcode</label>
                    <input type="text" class="form-control" name="sku" placeholder="Masukkan SKU..." required>

                    <button type="button" class="btn btn-primary mt-3"><i class="fas fa-barcode"></i> Scan
                        Produk</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Produk (masih dummy) -->
<div class="modal fade" id="editProdukModal" tabindex="-1" role="dialog" aria-labelledby="modalEditProduk"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="mb-2">Nama Produk</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Produk...">

                    <label class="my-2">Harga Produk</label>
                    <input type="number" class="form-control" name="price" placeholder="Masukkan Harga Produk...">

                    <label class="my-2">Stok Produk</label>
                    <input type="number" class="form-control" name="stock" placeholder="Masukkan Stok Produk...">

                    <label class="my-2">SKU | Barcode</label>
                    <input type="text" class="form-control" name="sku" placeholder="Masukkan SKU...">

                    <button type="button" class="btn btn-primary mt-3"><i class="fas fa-barcode"></i> Scan
                        Produk</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Stok Produk -->
<div class="modal fade" id="TambahStokProduk" tabindex="-1" role="dialog" aria-labelledby="modalTambahStokProduk"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Stok Produk</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="mb-2">Nama Produk</label>
                    <input type="text" class="form-control" placeholder="Nama Produk" readonly>

                    <label class="my-2">Jumlah Tambahan Stok</label>
                    <input type="number" class="form-control" placeholder="Masukkan Tambahan Stok...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('templates.footer')