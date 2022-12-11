<section class="content"> 
 <div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <!-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active"> -->
            <img class="d-block w-100" src="<?php echo base_url('/assets/gambar/gif.gif') ?>" alt="First slide">
          <!-- </div>
        </div>
      </div> -->
    </div>
  </div>
  <?php echo $this->session->flashdata('message'); ?>
  <div class="container-fluid">
    <form class="form-inline pl-2 mb-2" action="<?php echo base_url().'home/cari_barang'?>" method='post'>

      <div class="input-group input-group-l">
        <input class="form-control form-control bg-dark" type="search" placeholder="Cari Barang" name="cari" autocomplete="off">
        <div class="input-group-append">
          <button class="btn btn-dark" type="submit">
            <i class="fas fa-search"></i>
          </button>
          <a href="<?php echo base_url('home') ?>"><button class="btn text-muted" type="button">
            Reset
          </button></a>
        </div>
      </div>
    </form>

    <div class="row pl-3 ">
      <?php 
      if($produk != false):
        foreach ($produk as $prd):?>
        <div class="card mr-2 ml-1" style="width: 16rem;">
          <img class="card-img-top" src="<?php  echo base_url('/assets/gambar/upload/'). $prd->gambar?>" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?php echo $prd->nama_produk ?></h5>
            <br>
            Rp.<?php echo number_format($prd->harga,0,',','.') ?><br>
            <span class="badge badge-warning mb-2"> Stok | <?php echo $prd->stok ?></span>
            <br>
            <form action="<?php echo base_url().'home/tambah_ke_keranjang/'. $prd->id_produk ?>" method='post'>
              <input type="hidden" name="id_produk" value="<?php echo $prd->id_produk ?>">
              <div class="input-group">
                <input type="number" min="1" name="qty" value="1" class="form-control">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary btn-primary text-white" type="submit">+ Keranjang</button>
                </div>
              </div>
            </form> 
          </div>
        </div>
        <?php 
      endforeach; 
      else: ?>
      <div class="mx-auto pt-5" >
        <img style="width: 16rem;" src="<?php echo base_url('/assets/gambar/cari.png') ?>">
      </div>
    <?php endif; ?>
  </div>
</div>
</section>