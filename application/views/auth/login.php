<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Absen QRcode</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/ionicons-2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/gif">

    <style>
        .login-logo a,
        .register-logo a {
            color: #fbfbfb;
        }

        .scan-button {
            display: inline-block;
            padding: 15px 25px; /* Ruang dalam */
            font-size: 24px; /* Ukuran font */
            font-weight: bold; /* Tebal */
            color: white; /* Warna teks */
            background-color: green; /* Warna latar belakang */
            border-radius: 5px; /* Sudut melengkung */
            text-decoration: none; /* Menghilangkan garis bawah */
            margin-top: 20px; /* Spasi atas */
            border: 2px solid darkgreen; /* Border */
        }

        .scan-button:hover {
            background-color: darkgreen; /* Warna latar belakang saat hover */
            border: 2px solid green; /* Border saat hover */
        }

        .login-box {
            transition: background-color 0.3s ease; /* Transisi halus untuk perubahan warna */
        }

        .login-box.hovered {
            background-color: rgba(0, 0, 0, 0.1); /* Warna bayangan saat kursor mendekat */
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-box-body">
            <div class="text-center">
                <img src="<?php echo base_url('assets/'); ?>images/LogoTPQ.png">
            </div>
            <h3 class="text-center mt-0">
                <b>
                    <font color="black">Absensi Siswa Digital QRcode SMK SATRIA NUSANTARA</font>
            </h3>
            <a href="<?= base_url('scan'); ?>" target="_BLANK" class="scan-button">Klik untuk scan absensi!</a>
            <p class="login-box-msg"></p>
            <div id="infoMessage" class="text-center"><?php echo $message; ?></div>
            <?= form_open("auth/cek_login", array('id' => 'login')); ?>
            <div class="form-group has-feedback">
                <?= form_input($identity); ?>
                <span class="fa fa-envelope form-control-feedback"></span>
                <span class="help-block"></span>
            </div>
            <div class="form-group has-feedback">
                <?= form_input($password); ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="help-block"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <?= form_checkbox('remember', '', FALSE, 'id="remember"'); ?> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <?= form_submit('submit', lang('login_submit_btn'), array('id' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat')); ?>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
    <script src="<?= base_url() ?>assets/app/js/login.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });

            // Menambahkan efek bayangan saat kursor mendekat
            $('.login-box').hover(
                function() {
                    $(this).addClass('hovered');
                },
                function() {
                    $(this).removeClass('hovered');
                }
            );
        });
    </script>
</body>

<script type="text/javascript">
    let base_url = '<?= base_url(); ?>';
</script>

</html>
