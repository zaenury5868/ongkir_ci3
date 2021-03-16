<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Rajaongkir Dan Midtrans</title>
</head>

<body>
    <div class="container mt-4 mb-4">
        <div class="row mt-2">
            <a href="<?= base_url(); ?>" class="btn btn-danger ml-3">Kembali</a>
            <div class="col-12 mt-2">


                <div class="card">
                    <div class="card-body">
                        Pengiriman dari <h5>
                            <?= $this->input->post('kotaasalrajaongkir');?>
                        </h5> dan Tujuan ke
                        <h5>
                            <?= $this->input->post('kotatujuanrajaongkir');?>
                        </h5> @ <h5><?= $this->input->post('beratkirim');?>Kg</h5>

                    </div>
                </div>
                <hr>
                <div class="col-12 mt-2">
                    <div class="row">
                        <div class="col-3">
                            <h5>KURIR</h5>
                        </div>
                        <div class="col-3">
                            <h5>JENIS LAYANAN</h5>
                        </div>
                        <div class="col-3">
                            <h5>TARIF</h5>
                        </div>
                        <div class="col-3">
                            <h5>ESTIMASI</h5>
                        </div>
                    </div>
                    <hr>
                </div>
                <?php foreach($hasil as $kurir): 
					$semuakurir = $kurir->rajaongkir->results;
					foreach($semuakurir as $layanankurir) :
					$kodekurir = strtoupper($layanankurir->code);
					$namakurir = strtoupper($layanankurir->name);	
					$ambildatacost = $layanankurir->costs;
					
					foreach($ambildatacost as $costs) :
						$biaya = $costs->cost;
						foreach($biaya as $ongkir):
                ?>

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <h4>
                                    <?= $kodekurir; ?>
                                </h4>
                                <p><?= $namakurir; ?></p>
                            </div>
                            <div class="col-3">
                                <h4><?= $costs->service; ?></h4>
                                <p><?= $costs->description; ?></p>
                            </div>
                            <div class="col-3">
                                <h3 class="text-primary">RP <?= $ongkir->value; ?></h3>
                            </div>
                            <div class="col-3">
                                <h3 class="text-danger"><?= $ongkir->etd; ?></h3>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <!--jika diisi field -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>


</body>

</html>