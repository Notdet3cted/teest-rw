<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Rumah Web - Tes Online</title>

    <style>
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            content: "✔";
        }

        /* Tambahkan warna teks merah dan "x" jika persyaratannya salah*/
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            content: "✖";
        }
    </style>

</head>

<body>

    <div class="container-fluid vh-100 mt-5">
        <div class="rounded d-flex justify-content-center">
            <div class="col-md-4 col-sm-12 shadow-lg p-5 text-white" style="border-radius: 20px; background-color: #2c3e50;">
                <div class="text-center">

                    <?php
                    $flash = $this->session->flashdata('flash');
                    if (isset($flash)) { ?>
                        <div class="alert alert-info" id="alert" role="alert">
                            <?= $flash ?>
                        </div>
                    <?php
                        $this->session->unset_userdata('flash');
                    }
                    ?>

                    <img src="https://www.rumahweb.com/assets/img/2021/logo-rumahweb.svg" />
                    <h3 class="mt-4">Login</h3>
                </div>

                <?php
                echo form_open("auth/proses_login")
                ?>
                <!-- Email  -->
                <div class="form-group has-error mb-3">
                    <label for="">Email</label>
                    <?php
                    $data = array(
                        'type'  => 'email',
                        'name'  => 'email',
                        'id'    => 'email',
                        'value' => set_value('email', ''),
                        'class' => form_error('email') ? 'form-control is-invalid' : 'form-control',
                        'placeholder' => 'email@rumahweb.co.id'
                    );
                    echo form_input($data);
                    echo form_error('email');
                    ?>
                </div>

                <!-- password  -->
                <div class="form-group has-error mb-3">
                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="button" class="btn" style="color: white;" onclick="show()"><i id="icon" class="bi bi-eye-fill"></i></button>
                        </div>
                    </div>
                    <?php
                    $data = array(
                        'type'  => 'password',
                        'name'  => 'password',
                        'id'    => 'password',
                        'class' => form_error('password') ? 'form-control is-invalid' : 'form-control',
                        'placeholder' => 'password'
                    );
                    echo form_input($data);
                    echo form_error('password');
                    ?>

                </div>

                <div class="card mb-3" style="border: none; display: none;" id="message">
                    <label id="angka" class="invalid"> Password Harus Berisi Angka</label><br>
                    <label id="huruf" class="invalid"> Password Harus Berisi Huruf Besar dan Kecil</label><br>
                    <label id="char" class="invalid"> Password Harus Berisi Karakter non-alfabet</label><br>
                    <label id="pjg" class="invalid"> Password Harus terdiri minimal 12 karakter </label><br>
                </div>

                <!-- Submit button -->
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg mb-4 text-white" style="background-color: #d35400;">Login</button>
                </div>
                </form>

                <div class="text-center">
                    <p class="mt-4">Belum Punya Akun? <a style="color:#d35400;" href="<?= site_url('auth/register') ?>">Register</a></p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        var password = document.getElementById("password");
        var angka = document.getElementById("angka");
        var huruf = document.getElementById("huruf");
        var char = document.getElementById("char");
        var pjg = document.getElementById("pjg");
        var showpwd = document.getElementById("showpwd")
        var icon = document.getElementById("icon")

        password.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        password.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        function show() {
            if (password.type === "password") {
                icon.classList.remove('bi-eye-fill')
                icon.classList.add('bi-eye-slash-fill')
                password.type = "text"
            } else {
                icon.classList.add('bi-eye-fill')
                icon.classList.remove('bi-eye-slash-fill')
                password.type = "password"
            }
        }

        // Saat pengguna mulai mengetik sesuatu di dalam field password
        password.onkeyup = function() {
            // Validasi huruf kecil(lowercase)
            var hurufkecil = /[a-z]/g
            var hurufbesar = /[A-Z]/g
            var nomor = /[0-9]/g
            var regex = /[^'"a-zA-Z0-9]/g


            if (password.value.match(hurufkecil) && password.value.match(hurufbesar)) {
                huruf.classList.remove("invalid");
                huruf.classList.add("valid");
            } else {
                huruf.classList.remove("valid");
                huruf.classList.add("invalid");
            }

            if (password.value.match(nomor)) {
                angka.classList.remove("invalid");
                angka.classList.add("valid");
            } else {
                angka.classList.remove("valid");
                angka.classList.add("invalid");
            }

            if (password.value.length >= 12) {
                pjg.classList.remove("invalid");
                pjg.classList.add("valid");
            } else {
                pjg.classList.remove("valid");
                pjg.classList.add("invalid");
            }

            if (password.value.match(regex) != null) {
                if (password.value.match(regex).length < 2) {
                    char.classList.remove("valid");
                    char.classList.add("invalid");
                } else {
                    char.classList.remove("invalid");
                    char.classList.add("valid");
                }
            }
        }
    </script>

</body>

</html>