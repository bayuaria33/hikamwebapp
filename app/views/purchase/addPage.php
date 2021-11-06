<div class="container">
    <h1>Tambah data Purchase</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Purchase">Kembali</a>


    <form action="<?= BASEURL; ?>/Purchase/tambah" method="post">

        <label for="purchase_number">Nomor Purchase</label>
        <input type="text" id="purchase_number" name="purchase_number" autocomplete="off" placeholder="Jika kosong akan terisi otomatis di halaman detail">

        <label for="product_avb">pilih Customer</label>
        <select name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true">

            <?php foreach ($data['cust'] as $cust) : ?>

                <option value="<?= $cust['customer_name']; ?>"> <?= $cust['customer_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="PO_date">Tanggal Purchase</label>
        <input type="date" id="PO_date" name="PO_date" autocomplete="off">

        <label for="other_expenses">Catatan Lain</label>
        <input type="text" id="other_expenses" name="other_expenses" autocomplete="off">

        <label for="status_pembayaran">Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" autocomplete="off">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
        </select>

        <label for="due_date">Tanggal Jatuh Tempo</label>
        <br><input type="date" id="due_date" name="due_date" autocomplete="off">

        <label for="ppn">PPN</label>
        <br><select name="ppn" id="ppn">
            <option value="10">10%</option>
            <option value="0">0%</option>
        </select>

        <label for="invoice_id">Invoice Number</label>
        <select name="invoice_id" id="invoice_id" class="selectpicker form-control" data-live-search="true">
            <option value="0" selected></option>
            <?php foreach ($data['invc'] as $invc) : ?>

                <option value="<?= $invc['invoice_id']; ?>"><?= $invc['invoice_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="DO_id">DO_id</label>
        <select name="DO_id" id="DO_id" class="selectpicker form-control" data-live-search="true">
            <option value="0" selected></option>
            <?php foreach ($data['DO'] as $DO) : ?>

                <option value="<?= $DO['DO_id']; ?>"><?= $DO['delivery_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit">
    </form>

</div>