<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('produk/ubahProduk/'.$produk['id']); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Id Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" value="<?= $produk['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="produk" name="produk" value="<?= $produk['nama_produk']; ?>">
                    <?= form_error('produk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Satuan produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="satuan" name="satuan" value="<?= $produk['satuan_produk']; ?>">
                    <?= form_error('satuan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Harga produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" value="<?= $produk['harga_produk']; ?>">
                    <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Deskripsi produk</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?=$produk['desk_produk'];?></textarea>
                    <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Kategori produk</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kategori" name="kategori">
                        <?php foreach($kategori as $kategori){
                            if($produk['id_kategori'] == $kategori['id']){ ?>
                                <option value="<?= $kategori['id'];?>" selected><?=$kategori['nama_kategori'];?></option>
                            <?php }else{ ?>
                                <option value="<?= $kategori['id'];?>"><?=$kategori['nama_kategori'];?></option>
                        <?php  }
                        } ?>
</select>
                    <?= form_error('kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Gambar</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/upload/') . $produk['image_produk']; ?>" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Pilih file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-dark" onclick="window.history.go(-1)"> Kembali</button>
                </div>
            </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->