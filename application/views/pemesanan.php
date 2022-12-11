<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fas fa-shopping-cart mr-1"></i>Pemesanan</h3>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 ">
					<div class="card bg-dark mr-4">
						<div class="card-header bg-secondary">
							Input Alamat Pengiriman
						</div>
						<div class="card-body">
							<form action="<?php echo base_url()?>home/proses_pesanan" method="POST">
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap Anda" value="<?php echo $this->session->userdata('nama'); ?>" autocomplete="off">
								</div>
								<div class="form-group">
									<label>Alamat Lengkap</label>
									<textarea name="alamat" cols="30" rows="5" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label>No. Telepon </label>
									<input type="text" name="no_tlp" class="form-control" placeholder="No.Telepon Anda" autocomplete="off">
								</div>
								<div class="mb-1">
									Informasi Biaya Ongkos Kirim <a href="#informasi" data-toggle="modal">Klik Disini</a>
								</div>
								<button type="submit" class="btn btn-sm btn-primary mb-3">Pesan</button>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card bg-dark mb-3">
						<div class="card-header bg-secondary">
							Pesanan
						</div>
						<div class="card-body">
							<table class="table">
								<tr>
									<td>Produk</td>
									<td align="center">Junlah</td>
									<td align="center">Harga</td>
								</tr>
								<?php 
								foreach ($this->cart->contents() as $items ): ?>
								<tr>
									<td><?php echo $items['name'] ?></td>
									<td align="center"><?php echo $items['qty'] ?></td>
									<td align="right">Rp.<?php echo number_format($items['price'],0,',','.') ?></td>
								</tr>
								<tr>
									<td colspan="2">Subtotal</td>
									<td align="right">Rp.<?php echo number_format($items['subtotal'],0,',','.') ?></td>
								</tr>
								<?php 
								endforeach; ?>
								<tr>
									<td colspan="2">Total</td>
									<td align="right">Rp. <?php echo number_format($this->cart->total(),0,',','.')?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<!-- Modal -->
  <div class="modal fade" id="informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
      </div>
    </div>
</div>