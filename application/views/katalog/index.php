<div class="container-fluid py-4">
    <h2 class="mb-4" style="color: #1a3353; font-weight: 600;">Katalog</h2>

    <div class="row g-4">
        <!-- Produk Card -->
        <div class="col-md-4">
            <a href="<?= base_url() ?>product" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s ease; cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="bi bi-box" style="font-size: 2.5rem; color: #1a3353;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-2" style="color: #1a3353; font-weight: 600;">Produk</h5>
                                <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">
                                    Kelola produk master, bundle, dan arsip.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Harga Card -->
        <div class="col-md-4">
            <a href="<?= base_url() ?>katalog/harga" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s ease; cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="bi bi-tag" style="font-size: 2.5rem; color: #1a3353;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-2" style="color: #1a3353; font-weight: 600;">Harga</h5>
                                <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">
                                    Atur harga default dan harga grosir.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Laporan Card -->
        <div class="col-md-4">
            <a href="<?= base_url() ?>katalog/laporan" class="text-decoration-none">
                <div class="card h-100 border-0 shadow-sm" style="transition: all 0.3s ease; cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <i class="bi bi-file-text" style="font-size: 2.5rem; color: #1a3353;"></i>
                            </div>
                            <div>
                                <h5 class="card-title mb-2" style="color: #1a3353; font-weight: 600;">Laporan</h5>
                                <p class="card-text text-muted mb-0" style="font-size: 0.9rem;">
                                    Lihat laporan daftar produk, harga, dan aktivitas barang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
