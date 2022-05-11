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
</head>

<body>

    <nav class="navbar navbar-dark" style="background-color:#2c3e50 ;">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand" href="#">
                <img src="https://www.rumahweb.com/assets/img/2021/logo-rumahweb.svg">
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modaltambah">
            Tambah Data
        </button>
        <div class="row">
            <?php

            foreach ($reqres['data'] as $dt) {
            ?>
                <div class="col-md-4">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $dt['avatar']  ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $dt['first_name'] . ' ' . $dt['last_name']  ?></h5>
                                    <p class="card-text"><?= $dt['email'] ?></p>
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit" onclick="edit()"><i class="bi bi-pencil-square"></i> </button>
                                        <button class="btn btn-danger" onclick="busek()"><i class="bi bi-trash3-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open(site_url("home/tambah")) ?>
                    <!-- Email  -->
                    <div class="form-group has-error mb-3">
                        <label for="email">Email</label>
                        <?php
                        $data = array(
                            'type'  => 'email',
                            'name'  => 'email',
                            'id'    => 'email',
                            'required' => TRUE,
                            'value' => set_value('email', ''),
                            'class' => form_error('email') ? 'form-control is-invalid' : 'form-control',
                            'placeholder' => 'email@rumahweb.co.id'
                        );
                        echo form_input($data);
                        echo form_error('email');
                        ?>
                    </div>

                    <!-- tanggal lahir  -->
                    <div class="form-group has-error mb-3">
                        <label class="form-label" for="bday">Tanggal Lahir</label>
                        <?php
                        $data = array(
                            'type'  => 'date',
                            'name'  => 'bday',
                            'id'    => 'bday',
                            'required' => TRUE,
                            'class' => form_error('bday') ? 'form-control is-invalid' : 'form-control',
                            'value' => set_value('bday', ''),
                            'placeholder' => 'bday'
                        );
                        echo form_input($data);
                        echo form_error('bday');
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn text-white" style="background-color: #d35400;">Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit">Modal edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open(site_url("home/tambah")) ?>
                    <!-- Email  -->
                    <div class="form-group has-error mb-3">
                        <label for="email">Email</label>
                        <?php
                        $data = array(
                            'type'  => 'email',
                            'name'  => 'email',
                            'id'    => 'email',
                            'required' => TRUE,
                            'value' => set_value('email', ''),
                            'class' => form_error('email') ? 'form-control is-invalid' : 'form-control',
                            'placeholder' => 'email@rumahweb.co.id'
                        );
                        echo form_input($data);
                        echo form_error('email');
                        ?>
                    </div>

                    <!-- tanggal lahir  -->
                    <div class="form-group has-error mb-3">
                        <label class="form-label" for="bday">Tanggal Lahir</label>
                        <?php
                        $data = array(
                            'type'  => 'date',
                            'name'  => 'bday',
                            'id'    => 'bday',
                            'required' => TRUE,
                            'class' => form_error('bday') ? 'form-control is-invalid' : 'form-control',
                            'value' => set_value('bday', ''),
                            'placeholder' => 'bday'
                        );
                        echo form_input($data);
                        echo form_error('bday');
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn text-white" style="background-color: #d35400;">Simpan</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function edit() {
            var email = document.getElementById('email');
            email.value("assasa")
        }

        function busek() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan menghpus data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("DELETE", "https://reqres.in/api/users/3?delay:3", true);
                    xhr.onload = function() {
                        console.log(xhr.responseText);
                    };
                    xhr.send();
                    let timerInterval
                    Swal.fire({
                        title: 'Pengahapusan dalam proses',
                        html: 'Sedang dihapus',
                        timer: 3000,
                        timerProgressBar: false,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                }
            })
        }
    </script>


</body>

</html>