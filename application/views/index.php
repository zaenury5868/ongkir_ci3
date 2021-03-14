<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Rajaongkir Dan Midtrans</title>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <h3>Periksa ongkos kirim dengan cepat di sini</h3>
            <form action="#" method="POST">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Kota asal pengiriman" id="kotaasal"
                            name="kotaasal">
                        <input type="hidden" id="kotaasalrajaongkir" value="" name="kotaasalrajaongkir">
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Kota tujuan pengiriman" id="kotatujuan"
                            name="kotatujuan">
                        <input type="hidden" id="kotatujuanrajaongkir" value="" name="kotatujuanrajaongkir">
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control" id="beratkirim" placeholder="Berat pengiriman"
                                name="beratkirim">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Kg</div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" type="submit">Periksa ongkir</button>
                    </div>
                </div>
            </form>
        </div>
        <hr />
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script>
    $(function() {
        $("#kotaasal").autocomplete({
            source: '<?= base_url('home/getDataKabupaten') ?>',
            select: function(event, data) {
                $('#kotaasalrajaongkir').val(data.item.kabupaten)
            }
        });
        $("#kotatujuan").autocomplete({
            source: '<?= base_url('home/getDataKabupaten') ?>',
            select: function(event, data) {
                $('#kotatujuanrajaongkir').val(data.item.kabupaten)
            }
        });
    });
    </script>

</body>

</html>