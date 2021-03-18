<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Data Cart</title>
</head>

<body>

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal"
                    data-target="#exampleModal">Beli Barang</button>
                <?= $this->session->flashdata('pesan');?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">sub total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
						$total = 0;
						foreach($datacart as $keranjang): ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $keranjang['produk']; ?> - <?= $keranjang['jumlah'];?></td>
                            <td><?= $keranjang['harga']; ?></td>
                            <td><?= $keranjang['harga'] * $keranjang['jumlah']; ?></td>
                        </tr>
                        <?php 
						$total += $keranjang['harga'] * $keranjang['jumlah'];
						endforeach; ?>
                        <tr>
                            <td colspan="3">Total Belanja</td>
                            <td>Rp. <?= $total; ?></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-sm btn-primary float-right" id="tombol-bayar"
                    data-amount="<?= $total; ?>">Bayar</button>
            </div>
        </div>
    </div>
    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <h3>Data Transaksi</h3>
                <form action="<?= base_url('midtrans/cekstatus') ?>" method="POST">
                    <div class="row my-2">
                        <div class="col-4">
                            <input type="text" class="form-control" name="order_id" placeholder="cek status pembayaran">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">cari</button>
                        </div>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Bank</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Total Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($semuatransaksi as $transaksi): ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= strtoupper($transaksi['bank']); ?></td>
                            <td><?= $transaksi['order_id']; ?></td>
                            <td><?= $transaksi['gross_amount']; ?></td>
                            <td><?= $transaksi['transaction_status']; ?></td>
                            <td><?= date('d-F-Y H:i:s', $transaksi['date_modified']); ?></td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog">
            <form action="<?= base_url('midtrans/simpan')?>" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">tambah baarang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="produk">produk</label>
                            <select name="produk" id="produk" class="form-control">
                                <?php foreach($semuaproduk as $produk): ?>
                                <option value="<?= $produk['id']; ?>"><?= $produk['produk']; ?> -
                                    <?= $produk['harga']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-group mt-2">
                                <label for="jumlah">jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah"
                                    placeholder="masukkan jumlah barang" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <form id="payment-form" method="post" action="<?= base_url()?>/snap/finish">
        <input type="hidden" name="result_type" id="result-type" value=""></div>
        <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form>
    <!-- Optional JavaScript; choose one of the two! -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="<SB-Mid-client-divUuBu0PrB3gWxR>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <script>
    $('#tombol-bayar').click(function(event) {
        var grossamount = $(this).data('amount');
        event.preventDefault();
        $(this).attr("disabled", "disabled");

        $.ajax({
            url: '<?= base_url() ?>/snap/token',
            cache: false,
            data: {
                grossamount: grossamount
            },

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
    </script>
</body>



</html>