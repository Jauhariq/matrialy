<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0">Menu Kontrol Data Produk</h3>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<section class="content">
		<div class="container-fluid">
			<button class = 'btn btn-sm btn-primary mb-2' data-toggle="modal" data-target="#tambah_produk" >
				<i class='fas fa-plus fa-sm'></i> Tambah Produk	
			</button>
			<?php echo $this->session->flashdata('message'); ?>
			<?php echo $this->session->flashdata('gambar'); ?>
			<table class="table">
				<tr>
					<td class="table-dark" scope="col">No</td>
					<td class="table-dark" scope="col">Nama Produk</td>
					<td class="table-dark" scope="col">Kategori</td>
					<td align="left" class="table-dark" scope="col">Harga</td>
					<td align="center" class="table-dark" scope="col">Stok</td>
					<td align="center" class="table-dark" colspan="2" scope="col">Aksi</td>
				</tr>
				<?php 
				$no = 1;
				foreach($produk as $prd) : ?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><img class="mr-2" style=" width: 3rem;" src="<?php echo base_url('/assets/gambar/upload/'). $prd->gambar ?>"><?php echo  $prd->nama_produk ?></td>
					<td><?php echo $prd->kategori?></td>
					<td align="left">Rp.<?php echo number_format($prd->harga,0,',','.') ?></td>
					<td align="center"><?php echo $prd->stok ?></td>
					<td align="right">
						<?php echo anchor('admin/data_produk/edit/'.$prd->id_produk,'<div class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></div>')  ?>


					</td>
					<td>
						<?php echo anchor('admin/data_produk/hapus/'.$prd->id_produk,'<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>')  ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>

</section>
</div>



<!-- Modal -->
<div class="modal fade" id="tambah_produk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url().'admin/data_produk/tambah' ?>" method=post enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" name="nama_produk" class="form-control" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select name=kategori  class="form-control" >
							<option value="">Pilih Kategori</option>
							<option value="peralatan">Peralatan</option>
							<option value="cat">Cat</option>
							<option value="lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type="text" name="harga" class="form-control" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input type="number" name="stok" class="form-control" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Gambar Produk</label>
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