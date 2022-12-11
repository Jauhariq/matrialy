<section>
    <div class="box">
        <div class="boxContainer">
            <div class="form">
                <h2>Login</h2>
                <?= $this->session->flashdata('message'); ?>
                <form class="user" method="post" action="<?php base_url('auth'); ?>">
                    <div class="inputBox">
                        <input type="text" id="email" name="email" placeholder="Masukan Email " value="<?= set_value('email'); ?>" autocomplete="off">
                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password" name="password" placeholder="Masukan Password ">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Login">
                    </div>
                    <p class="forget">Belum Punya Akun? <a href="<?= base_url('auth/registrasi'); ?>">Registrasi Disini</a>
                        <br>
                    Lupa Password? <a href="https://api.whatsapp.com/send?phone=6288222999109&text=Saya%20ingin%20mengajukan%20reset%20Password" target="_blank">Hubungi Admin!</a></p>
                </form>
            </div>
        </div>
    </div>
</section>