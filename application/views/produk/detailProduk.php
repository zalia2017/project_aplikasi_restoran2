<?= $this->session->flashdata('pesan');?>

<div style="padding: 5px;">
  <div class="x_panel">
    <div class="x_content">
      <div class="row">

        <div class="col-12">
          <div style="text-align:center">
            <img src="<?= base_url('assets/img/upload/'.$produk['image_produk']);?>"
              style="max-width:100%;max-height: 100%;width: 280px">
            <div class="caption">
              <h5 style="min-height:30px">
                <?= $produk['nama_produk'] ;?>
              </h5>
                Harga : Rp.<?= $produk['harga_produk'] ;?>
              <p><?= $produk['desk_produk'];?></p>
              <p>Kategori : <?= $produk['nama_kategori'];?>
            </div>
            <?= form_open('home/tambahPesanan/'); ?> 
            <div class="form-group row">
              <input type="hidden" name="id" value="<?=$produk['id'];?>">
              <label class="col-2">Jumlah Pemesanan</label>
              <input type="number" name="jumlah" class="form-control col-10" min="1" value="1"/>
            </div>
            <div class="row">

            <button
                  class="btn btn-outline-primary fas fw fa-food mt-2 col-12">&nbsp; Pesan</button>
</form>
</div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>