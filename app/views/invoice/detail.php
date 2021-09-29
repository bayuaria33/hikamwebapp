<div class="container">
    <br>
    <h1>Detail Invoice</h1>
    <a href="<?= BASEURL; ?>/Invoice" class="editButton">Kembali</a>
    <br>

    <div class="card">

        <h2><?= $data['invoice_number']; ?></h2>

        <p><b>NAMA CUSTOMER: </b> <?= $data['invc']['customer_name']; ?></p>
        <p><b>TANGGAL INVOICE: </b><?= $data['invoice_date_format']; ?></p>
        <p><b>TANGGAL JATUH TEMPO: </b><?= $data['due_date_format']; ?></p>
        <p><b>PENGELUARAN LAIN: </b><?= $data['invc']['other_expenses']; ?></p>
        <p><b>STATUS PEMBAYARAN: </b><?= $data['invc']['status_pembayaran']; ?></p>
        <p><b>PO_ID: </b><?= $data['invc']['PO_id']; ?></p>
        <p><b>DO_ID: </b><?= $data['invc']['DO_id']; ?></p>
    </div>
</div>