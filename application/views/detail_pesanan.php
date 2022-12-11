<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fa fa-truck mr-2"></i>Detail Pesanan</h3>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<table class="table">
				<tr>
					<td>No.</td>
					<td>Nama Produk</td>
					<td align="center">Jumlah Pesanan</td>
					<td align="right">Harga Satuan</td>
					<td align="right">Sub-Total</td>
				</tr>
				<?php 
				$nomor =1;
				$total = 0;
				foreach ($pesanan as $psn):
					$subtotal = $psn->jumlah * $psn->harga;
					$total += $subtotal; ?>
					<tr>
						<td><?php echo $nomor++ ?></td>
						<td><img class="img-thumbnail border-dark bg-dark mr-2" style="width:5rem;" src="<?php  echo base_url('/assets/gambar/upload/'. $psn->gambar)?>"><?php echo $psn->nama_produk ?></td>
						<td align="center"><?php echo $psn->jumlah ?></td>
						<td align="right">Rp. <?php echo number_format($psn->harga,0,',','.') ?></td>
						<td align="right">Rp.<?php echo number_format($subtotal,0,',','.')?></td>
					</tr>
					<?php 
					endforeach; ?>
					<tr>
						<td colspan="4" align="right">Total Bayar</td>
						<td align="right">Rp. <?php echo number_format($total,0,',','.');?></td>
					</tr>
				</table>
				<a href="<?php echo base_url('home/pesanan_saya/') ?>"><div class="btn btn-primary">Kembali</div></a>
			</div>
		</div>
	</div>