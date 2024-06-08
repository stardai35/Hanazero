    <footer>
        <div class="jumbotron text-center pt-3 pb-1 mt-5 mb-0 ">
            <p>Hanazero &copy; <?= date('Y') ?></p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        const numberWithCommas = (x) => {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        $(document).ready(function() {
            $('#tabel').DataTable();
        });
        $('#konfirmasi, #transaksi').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('id')
            var total = button.data('total') || 0
            var modal = $(this)
            modal.find('input[name=id]').val(recipient)
            modal.find('input[name=total]').val(total)
            modal.find('h4').text('Total Bayar : Rp.' + numberWithCommas(total))

            $('input[name=jml_uang]').keyup(function() {
                var sisa = parseInt($(this).val()) - parseInt(total);
                if (sisa > 0) {
                    $('input[name=kembalian]').val(sisa);
                }else {
                    $('input[name=kembalian]').val(0);
                }
            })
            $('#bayar').submit(function(){
                if (parseInt($('input[name=jml_uang]').val())  < total) {
                    alert('Jumlah uang kurang dari total bayar!');
                    return false;
                }
            })
        })
        
    </script>
</body>

</html>