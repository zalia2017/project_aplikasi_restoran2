<?= $this->session->flashdata('pesan');?>

<div style="padding: 25px;">
  <div class="x_panel">
    <div class="x_content">
      <div class="row">
        <?php foreach($buku as $buku) : ?>
        <div class="col-md-2 col-md-3">
          <div class="thumbnail" style="height: 370px;">
            <img src="<?= base_url('assets/img/upload/').$buku->image;?>"
              style="max-width:100%;max-height: 100%; height: 200px; width: 180px">
            <div class="caption">
              <h5 style="min-height:30px">
                <?= $buku->pengarang ;?>
              </h5>
              <h5>
                <?= $buku->penerbit ;?>
              </h5>
              <h5>
                <?= substr($buku->tahun_terbit, 0, 4) ;?>
              </h5>
              <p>
                <?php if($buku->stok < 1):?>
                <i class="btn btn-outline-primary fas fw fa-shopping-cart">Booking &nbsp; &nbsp; 0</i>
                <?php else: ?>
                <a href="<?= base_url('booking/tambahBooking/').$buku->id;?>"
                  class="btn btn-outline-primary fas fw fa-shopping-cart">Booking</a>
                <?php endif;?>
                <a href="<?= base_url('home/detailBuku/').$buku->id;?>"
                  class="btn btn-outline-warning fas fw fa-search">
                  Detail</a>
              </p>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>