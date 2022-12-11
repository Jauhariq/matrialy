<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fas fa-credit-card mr-2"></i>Detail Pesanan <div class="btn btn-sm btn-success">No. Invoice : <?php echo $invoice->id_invoice ?></div></h3>
		</div>
	</div>
	<div class="content">
		<div class="container-fluid">
			<table class="table">
				<tr>
					<td>Id Produk</td>
					<td>Nama Produk</td>
					<td align="center">Jumlah Pesanan</td>
					<td align="right">Harga Satuan</td>
					<td align="right">Sub-Total</td>
				</tr>
				<?php 
				$total = 0;
				foreach ($pesanan as $psn):
					$subtotal = $psn->jumlah * $psn->harga;
					$total += $subtotal; ?>
					<tr>
						<td><?php echo $psn->id_produk ?></td>
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
				<a href="<?php echo base_url('admin/invoice/') ?>"><div class="btn btn-primary">Kembali</div></a>
				<?php if($invoice->status == 'Sedang Diproses') :?>
				<a href="<?php echo base_url('admin/invoice/konfirmasi/'. $invoice->id_invoice) ?>"><div class="btn btn-info ml-2">Konfirmasi Pembayaran</div></a>
				<?php elseif($invoice->keterangan == 'Proses Pengiriman'): ?>
					<a href="<?php echo base_url('admin/invoice/selesai/'. $invoice->id_invoice) ?>"><div class="btn btn-success ml-2">Transaksi Selesai</div></a>
			<?php endif; ?>
			</div>
		</div>
		<h3 class="pl-3 mt-2">Bukti Pembayaran :</h3>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<?php 
					if ($bukti != false):
						foreach ($bukti as $bkt): ?>
						<div class="card ml-2 mr-2 mt-3" style="width: 49%;">
							<img class="card-img-top" src="<?php  echo base_url().'/assets/gambar/bayar/'. $bkt->gambar?>" class="card-img-top" alt="...">
						</div>
					<?php endforeach;
					else: echo '<h5 class="text-red pl-2">Pesanan Belum Dibayar</h5>';
						endif; ?>
					</div>
				</div>
			</div>
		</div>