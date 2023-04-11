<div class="container">
  <center>
    <table>
      <tr>
        <td>
          <div class="table-responsive full-width">
            <table class="table-bordered tablestriped table-hover">
              <tr>
                <th>No.</th>
                <th>Buku</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Pilihan</th>
              </tr>
              <?php
                $no = 1;
                foreach ($temp as $t) : ?>
              <tr>
                <td><?= $no; ?></td>
                <td>
                  <img src="<?= base_url('assets/img/upload/'. $t['image']); ?>" class="rounded" alt="No Picture"
                    width="10%">
                </td>
                <td nowrap>
                  <?= $t['penulis'];?>
                </td>
                <td nowrap>
                  <?= $t['penerbit'];?>
                </td>
                <td nowrap>
                  <?= substr($t['tahun_terbit'], 0, 4); ?>
                </td>
                <td>
                  <a href="<?= base_url('booking/hapusbooking/'. $t['id_buku']); ?>"
                    onclick="return confirm('Yakin tidak jadi booking <?= $t['judul_buku'];?>')">
                    <i class="btn btn-sm btn-outline-danger fas fw fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php $no++;
                endforeach;
                ?>
            </table>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <hr>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <a class="btn btn-sm btn-outline-primary" href="<?=base_url();?>"><span
              class="fas fw fa-play"></span>Lanjutkan booking Buku</a>
          <a class="btn btn-sm btn-outline-success"
            href="<?= base_url() . 'booking/bookingSelesai/'. $this->session->userdata('id_user');?>"><span
              class="fas fw fa-stop"></span> Selesaikan Booking</a>
        </td>
      </tr>



      </tr>
    </table>
  </center>
</div>