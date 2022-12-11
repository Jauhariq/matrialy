<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3 class="m-0"><i class="fas fa-credit-card mr-2"></i>Invoice</h3>
    </div>
    <?php echo $this->session->flashdata('message'); ?>
  </div>
  <div class="content">
    <div class="container-fluid">
      <a href="<?php echo base_url('admin/invoice/') ?>">
        <button class = 'btn btn-sm btn-primary mb-2 mr-2' >Semua Transaksi</button>
      </a>
      <a href="<?php echo base_url('admin/invoice/menunggu_pembayaran') ?>">
        <button class = 'btn btn-sm btn-primary mb-2 mr-2' >Menunggu Pembayaran</button>
      </a>
      <a href="<?php echo base_url('admin/invoice/proses_pengiriman') ?>">
        <button class = 'btn btn-sm btn-primary mb-2 mr-2'>Proses Pengiriman</button>
      </a>
      <a href="<?php echo base_url('admin/invoice/sukses') ?>">
        <button class = 'btn btn-sm btn-primary mb-2 mr-2'>Transaksi Selesai</button>
      </a>
      <table class="table">
        <tr>
          <th class="table-dark">Id Invoice</th>
          <th class="table-dark">Nama Pemesan</th>
          <th class="table-dark">Alamat Pemesan</th>
          <th class="table-dark">No.Telepon</th>
          <th class="table-dark">Tanggal Pemesanan</th>
          <th class="table-dark">Keterangan</th>
          <th class="table-dark">Status</th>
          <th class="table-dark" colspan="2">Aksi</th>
        </tr> 
        <?php 
        foreach ($invoice as $inv):?>
        <tr>
          <td align="left"><?php echo $inv->id_invoice ?></td>
          <td><?php echo $inv->nama_pemesan ?></td>
          <td><?php echo $inv->alamat ?></td>
          <td>
            <a href="<?php echo 'https://wa.me/'.$inv->no_tlp ?>" target="_blank">
              <span class="text-white"><?php echo $inv->no_tlp?></span>
            </a>
          </td>
          <td><?php echo $inv->tgl_pesan?></td>
          <td><?php echo $inv->keterangan ?></td>
          <td><?php echo $inv->status ?></td>
          <td><?php echo anchor('admin/invoice/detail/'.$inv->id_invoice,'<div class="btn btn-sm btn-primary">Detail</div>')?></td>
        </tr>
        <?php 
        endforeach; ?>
      </table>
    </div>
  </div>
</div>