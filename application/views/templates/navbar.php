<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <?php 
      if ($this->cart->total_items()> 99){
        $keranjang = '<nav class="text-white pr-4"><i class="text-green text-lg fas fa-shopping-cart"></i><span class="badge badge-danger navbar-badge text-sm mr-2">99+</span></nav>';
      }elseif ($this->cart->total_items() == 0){
        $keranjang = '<nav class="text-white pr-4"><i class="text-green text-lg fas fa-shopping-cart"></i></nav>';
      }
      else{
        $keranjang = '<nav class="text-white pr-4"><i class="text-green text-lg fas fa-shopping-cart"></i><span class="badge badge-danger navbar-badge text-sm mr-3">'.$this->cart->total_items().'</span></nav>';
      }
      ?>
      <?php echo anchor('home/detail_keranjang',$keranjang) ?>
    </li>
  </ul>
</nav>
