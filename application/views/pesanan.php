<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3 class="m-0"><i class="nav-icon fa fa-truck mr-2"></i>Pesanan Saya</h3>
    </div>
    <?php echo $this->session->flashdata('info');?>
  </div>
  <div class="content">
    <div class="container-fluid">
      <?php if ($invoice != false): ?>
        <table class="table">
          <tr>
            <th class="table-dark">Nama Pemesan</th>
            <th class="table-dark">Alamat Pemesan</th>
            <th class="table-dark">No.Telepon</th>
            <th class="table-dark">Tanggal Pemesanan</th>
            <th class="table-dark">Status Pengiriman</th>
            <th class="table-dark">Status Pembayaran</th>
            <th class="table-dark" colspan="2"></th>
          </tr>
          <?php 
          foreach ($invoice as $inv):?>
          <tr>
            <td><?php echo $inv->nama_pemesan ?></td>
            <td><?php echo $inv->alamat ?></td>
            <td><?php echo $inv->no_tlp?></td>
            <td><?php echo $inv->tgl_pesan?></td>
            <td><?php echo $inv->keterangan ?></td>
            <td><?php echo $inv->status ?></td>
            <td><form action="<?php echo base_url('home/detail_pesanan')?>" method="post">
              <input type="hidden" name="id" value="<?php echo $inv->id_invoice ?>">
              <button class="btn  btn-sm btn-primary" type="submit">Detail</button>
            </form></td>
            <td>
              <?php if($inv->status == 'Belum Dibayar'): ?>
                <button class = 'btn btn-sm btn-success' data-toggle="modal" data-target="#bayar" >
                  Lakukan Pembayaran 
                </button>
              <?php elseif($inv->status == 'Sedang Diproses' or $inv->keterangan == 'Proses Pengiriman'): ?>
                <a href="https://wa.me/6288222999109" target="_blank">
                  <button class = 'btn btn-sm btn-success'>
                    Hubungi Admin
                  </button>
                </a>
              <?php elseif ($inv->keterangan == 'Barang Sampai') : ?>
                <a href="<?php echo base_url('home') ?>">
                  <button class = 'btn btn-sm btn-success'>
                    Beli Lagi
                  </button>
                </a>
              </td>
            <?php endif; ?>
          </tr>
          <?php 
        endforeach;
        else: echo $this->session->flashdata('pesanan');
          endif ;?>
        </table>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('home/bayar') ?>" method=post enctype="multipart/form-data">
            <div>
              Silahkan lakukan pembayaran untuk bisa kami proses selanjutnya dengan cara:
              <br>
              1. Lakukan pembayaran pada rekening :
              <br>
              <table>
                <tr>
                  <td>-</td>
                  <td width="50px" align="center">BCA</td>
                  <td>123901249421</td>
                  <td width="30px" align="center">a/n</td>
                  <td>PT.Matrialy</td>
                </tr>
                <tr>
                  <td>-</td>
                  <td width="50px" align="center">BRI</td>
                  <td>192890829809</td>
                  <td width="30px" align="center">a/n</td>
                  <td>PT.Matrialy</td>
                </tr>
                <tr>
                  <td>-</td>
                  <td width="50px" align="center">BNI</td>
                  <td>123901241241</td>
                  <td width="30px" align="center">a/n</td>
                  <td>PT.Matrialy</td>
                </tr>
              </table>
              <br>
              2. Sertakan keterangan dengan kode order : <strong><?php echo $inv->nama_pemesan ." - ". $inv->id_invoice ?></strong>
              <br><br>
              Total pembayaran bisa di lihat pada tombol <strong class="text-green"> Detail</strong>
              <br>
              Jika sudah silahkan kirimkan bukti transfer di bawah ini:
            </div>
            <div class="form-group">
              <input type="hidden" name="id_invoice" value="<?php echo $inv->id_invoice ?>">
              <input type="hidden" name="nama_pemesan" value="<?php echo $inv->nama_pemesan ?>">
              <input type="file" name="gambar" class="form-control-file btn btn-dark">  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>