
<section>
    <div class="box">
        <div class="boxContainer">
            <div class="form">
                <h2>Registrasi</h2>
                <form class="user" method="post" action="<?php echo base_url('auth/registrasi'); ?>">
                    <div class="inputBox">
                        <input type="text" id="nama" name="nama" placeholder="Masukan Nama Lengkap" value="<?= set_value('nama'); ?>" autocomplete="off">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="inputBox">
                        <input type="text" id="email" name="email" placeholder="Masukan Email " value="<?= set_value('email'); ?>" autocomplete='off'>
                        <?= form_error('email', '<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password1" name="password1" placeholder="Masukan Password">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password2" name="password2" placeholder="Masukan Konfirmasi Password">
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Registrasi">
                    </div>
                    <p class="forget">Sudah Punya AKun? <a href="<?= base_url('auth'); ?>"> Login !</a></p>
                </form>
            </div>
        </div>
    </div>
</section>