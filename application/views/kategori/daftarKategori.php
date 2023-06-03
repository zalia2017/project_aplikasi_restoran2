<?= $this->session->flashdata('pesan');?>

<div style="padding: 25px;">
  <div class="x_panel">
    <div class="x_content">
      <div class="row">
        <?php foreach($kategori as $kategori) : ?>
        <div class="col-md-2 col-md-3">
          <div class="thumbnail" style="height: 370px;">
          <a class="nav-item nav-link" href="<?= base_url('produk/kategori/'.$kategori->id);?>">
            <img src="<?= base_url('assets/img/upload/').$kategori->image_kategori;?>"
              style="max-width:100%;max-height: 100%; height: 200px; width: 180px">
        </a>
            <div class="caption">
              <h5 style="min-height:30px">
                <?= $kategori->nama_kategori ;?>
              </h5>
              <h5>
                <?= $kategori->image_kategori ;?>
              </h5>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>