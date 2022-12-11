<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<h3 class="m-0"><i class="fas fa-edit"></i>Edit Data Barang</h3>
		</div>
		<?php echo $this->session->flashdata('message'); ?>
	</div>
	<div class="content">
		<div class="container-fluid">
			<?php foreach($produk as $prd) :?>
				<div>
					<label>Gambar Produk</label>
					<div><img class="mb-1" src="<?php  echo base_url().'/assets/gambar/upload/'. $prd->gambar?>" style='width:16rem;'></div>
					<button class = 'btn btn-sm btn-primary mb-2 mt-2' style="width:16rem;" data-toggle="modal" data-target="#editgambar" >Edit Gambar</button>
				</div>

				<form method="post" action="<?php echo base_url().'admin/data_produk/update' ?>" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="hidden" name="id_produk" class="form-control" value="<?php echo $prd->id_produk ?>">
						<input type="text" name="nama_produk" class="form-control" autocomplete="off" value="<?php echo $prd->nama_produk ?>">
					</div>
					<div class="form-group">
						<label>Kategori Sebelumnya  : <span class="badge bg-dark text-dark"><?php echo $prd->kategori ?></span></label>
						<select name=kategori  class="form-control">
							<option value="<?php echo $prd->kategori ?>">Pilih Kategori Baru</option>
							<option value="peralatan">Peralatan</option>
							<option value="cat">Cat</option>
							<option value="lainnya">Lainnya</option>
						</select>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<input type="text" name="harga" class="form-control" autocomplete="off" value="<?php echo $prd->harga ?>">
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input type="text" name="stok" class="form-control" autocomplete="off" value="<?php echo $prd->stok ?>">
					</div>
					<div>
						<?php echo anchor('admin/data_produk/index','<button type="button" class="btn btn-danger mr-1" >Batal</button>') ?>
						<button type="submit" class="btn btn-primary">Perbarui data</button>
					</div> 
				</form>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="modal fade" id="editgambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Gambar Produk</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php foreach($produk as $prd) :?>
					<form action="<?php echo base_url().'admin/data_produk/edit_gambar' ?>" method=post enctype="multipart/form-data">

						<div class="form-group">
							<label>Gambar  Baru Produk</label>
							<input type="hidden" name="id_produk" class="form-control" value="<?php echo $prd->id_produk ?>">
							<input type="file" name="gambar" class="form-control-file btn btn-dark">	
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Perbarui Gambar</button>
						</div>
					</form>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>