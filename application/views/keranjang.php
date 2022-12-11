<div class="content-wrapper">
	<div class="content-header mb-2">
		<div class="container-fluid">

			<h3 class="m-0"><i class="fas fa-shopping-cart mr-2"></i>Keranjang</h3>
		</div>
	</div>
	<?php echo $this->session->flashdata('message'); ?>
	<div class="content">
		<table class="table table-stripped">
			<tr>
				<td>No.</td>
				<td>Nama Produk</td>
				<td align="left">Jumlah Pembelian</td>
				<td align="right">Harga</td>
				<td align="right">Sub-total</td>
				<td></td>
			</tr>
			<?php
			$no=1;
			foreach ($this->cart->contents() as $items): ?>
			<tr>
				<td><?php echo $no++ ?></td>
				<td><img class="img-thumbnail border-dark bg-dark mr-2" style="width:5rem;" src="<?php  echo base_url('/assets/gambar/upload/'. $items['gambar'])?>"><?php echo $items['name'] ?></td>
				<td align="left">
					<form action="<?= base_url('home/update_keranjang/') ?>" method="POST" style="width: 8rem;">
						<input type="hidden" name="stok" value="<?php echo $items['stok'] ?>">
						<input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
						<div class="input-group">
							<?php 
							if ($items['qty'] > $items['stok']){
								
								$items['qty']=$items['stok'];
								$qty = $items['qty'];
								$this->cart->update(array('rowid'=>$items['rowid'],'qty'=>$items['qty']));

							}else{
								$qty = $items['qty'];
							}?>
							<input type="number" min="0" name="qty" class="form-control text-center" value="<?php echo $qty; ?>">
							<div class="input-group-append">
								<button type="submit" class="btn btn-secondary btn-sm">Ubah</button>
							</div>
						</div>
					</form>
				</td>
				<td align="right">Rp.<?php echo number_format($items['price'],0,',','.') ?></td>
				<td align="right">Rp.<?php echo number_format($items['subtotal'],0,',','.') ?></td>
				<td align="right"><?php echo anchor('home/hapus_item_keranjang/'. $items['rowid'], '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>' ) ?></td>
			</tr>
		<?php endforeach ; ?>
		<tr>
			<td colspan="4" ></td>
			<td align="right">Rp. <?php echo number_format($this->cart->total(),0,',','.')?></td>
			<td></td>
		</tr>
	</table>
	<div align="right">



	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<?php 
		if ($this->cart->total() != 0 ): ?>
		<div class="col-md-3">
			<a href="<?php echo base_url('home/hapus_keranjang') ?>" class="btn btn-sm btn-block btn-danger ">Hapus keranjang</a>
		</div>
		<div class="col-md-6 ">
			<a href="<?php echo base_url('home/index') ?>" class="btn btn-sm btn-block btn-primary">Lanjutkan Belanja</a>
		</div>
		<div class="col-md-3">
			<a href="<?php echo base_url('home/pemesanan') ?>" class="btn btn-sm btn-block btn-success">Buat Pesanan</a>
		</div>
		<?php 
		else: ?>
		<div class="col-md-3">
			<a href="<?php echo base_url('home/hapus_keranjang') ?>" class="btn btn-sm btn-block btn-danger disabled" tabindex="-1" aria-disabled="true">Hapus keranjang</a>
		</div>
		<div class="col-md-6 ">
			<a href="<?php echo base_url('home/index') ?>" class="btn btn-sm btn-block btn-primary">Lanjutkan Belanja</a>
		</div>
		<div class="col-md-3">
			<a href="<?php echo base_url('home/pemesanan') ?>" class="btn btn-sm btn-block btn-success disabled" tabindex="-1" aria-disabled="true">Buat Pesanan</a>
		</div>
		<?php 
		endif; ?>
	</div>
</div>
