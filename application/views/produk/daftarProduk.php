<?= $this->session->flashdata('pesan');?>

<div style="padding: 25px;">
  <div class="x_panel">
    <div class="x_content">
      <div class="row">
        <?php if($produk == null){ ?>
          <span>Belum ada produk terdaftar pada kategori ini</span>
        
        <?php }else{
            foreach($produk as $produk) : ?>
        <div class="col-md-2 col-md-3">
          <div class="thumbnail" style="height: 370px;">
          <a class="nav-item nav-link" href="<?= base_url('produk/'.$produk['id']);?>">
            <img src="<?= base_url('assets/img/upload/'.$produk['image_produk']);?>"
              style="max-width:100%;max-height: 100%; height: 200px; width: 180px">
        </a>
            <div class="caption">
              <h5 style="min-height:30px">
                <?= $produk['nama_produk'] ;?>
              </h5>
              <h5>
                <?= $produk['harga_produk'] ;?>
              </h5>
            </div>
          </div>
        </div>
        <?php endforeach;
        } ?>
      </div>
    </div>
  </div>
</div>