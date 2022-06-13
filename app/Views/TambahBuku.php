<?= $this->extend('layout/BaseView') ?>

<?= $this->section('content') ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Perpustakaan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url() ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#menu-buku"
                    aria-expanded="true" aria-controls="menu-buku">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Buku</span>
                </a>
                <div id="menu-buku" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url().'/Buku' ?>">List Buku</a>
                        <?php if (session()->dataUser->jabatan_petugas == 'Admin') { ?>
                            <a class="collapse-item" href="<?php echo base_url().'/Buku/Tambah' ?>">Tambah Buku</a>
                        <?php } ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#menu-user"
                    aria-expanded="true" aria-controls="menu-user">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Mahasiswa</span>
                </a>
                <div id="menu-user" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url().'/User' ?>">List</a>
                        <?php if (session()->dataUser->jabatan_petugas == 'Admin') { ?>
                            <a class="collapse-item" href="<?php echo base_url().'/User/Tambah' ?>">Tambah</a>
                        <?php } ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#menu-anggota"
                    aria-expanded="true" aria-controls="menu-anggota">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Anggota</span>
                </a>
                <div id="menu-anggota" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url().'/Anggota' ?>">List Anggota</a>
                        <?php if (session()->dataUser->jabatan_petugas == 'Admin') { ?>
                            <a class="collapse-item" href="<?php echo base_url().'/Anggota/Tambah' ?>">Tambah Anggota</a>
                        <?php } ?>
                    </div>
                </div>
            </li>

           <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#menu-pinjaman-buku"
                    aria-expanded="true" aria-controls="menu-pinjaman-buku">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>Peminjaman Buku</span>
                </a>
                <div id="menu-pinjaman-buku" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url().'/PeminjamanBuku' ?>">List Peminjaman</a>
                        <?php if (session()->dataUser->jabatan_petugas == 'Admin') { ?>
                            <a class="collapse-item" href="<?php echo base_url().'/PeminjamanBuku/Pinjam' ?>">Peminjaman Buku</a>
                        <?php } ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url().'/Pengembalian' ?>">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Pengembalian Buku</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?= $this->include('layout/topBar') ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Buku</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Buku</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo $action ?>" method="POST">
                                <input name="id_buku" type="hidden" class="form-control" id="inputEmail4" value="<?php echo $dataBuku->id_buku ?>">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="inputEmail4">Kode Buku</label>
                                    <input name="kode_buku" type="text" class="form-control" id="inputEmail4" value="<?php echo $dataBuku->kode_buku ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="inputPassword4">Judul Buku</label>
                                    <input name="judul_buku" type="text" class="form-control" id="inputPassword4" value="<?php echo $dataBuku->judul_buku ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="penulis-buku">Penulis Buku</label>
                                    <input name="penulis_buku" type="text" class="form-control" id="penulis-buku" value="<?php echo $dataBuku->penulis_buku ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="penerbit-buku">Penerbit Buku</label>
                                    <input name="penerbit_buku" type="text" class="form-control" id="penerbit-buku" value="<?php echo $dataBuku->penerbit_buku ?>" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                    <label for="tahun-penerbit">Tahun Penerbitan</label>
                                    <input name="tahun_penerbit" type="number" min="1900" max="2099" step="1" class="form-control" id="tahun-penerbit" value="<?php echo $dataBuku->tahun_penerbit ?: date('Y') ?>" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="rak">Rak</label>
                                    <select id="rak" class="form-control" name="id_rak" required>
                                        <?php foreach($dataRak as $value) { ?>
                                            <option value="<?php echo $value->id_rak ?>" <?php echo $value->id_rak == $dataBuku->id_rak || $value->id_rak == 1 ? 'selected' : '' ?>><?php echo $value->nama_rak ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="harga_per_hari">Harga Perhari (Rp)</label>
                                        <input name="harga_per_hari" type="number" step="1000" class="form-control" id="harga_per_hari" value="<?php echo $dataBuku->harga_per_hari ?: 1000 ?>" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="stok">Stok</label>
                                        <input name="stok" type="number" step="1" class="form-control" id="stok" value="<?php echo isset($dataBuku->stok) ? $dataBuku->stok : 1 ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url().'/login' ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
