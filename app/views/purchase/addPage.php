<div class="container">
    <h1><?= $data['judul']; ?> <?= $data['jenis']; ?></h1>
    <a class="editButton" href="javascript:window.history.back();">Kembali</a>

    <form action="<?= BASEURL; ?>/Purchase/tambah" method="post">

        <label for="purchase_number">Nomor Purchase</label>
        <input type="text" id="purchase_number" name="purchase_number" autocomplete="off" placeholder="Jika kosong akan terisi otomatis di halaman detail">

        <?php
        if ($data['jenis'] == 'Supplier') { ?>

            <label for="supplier_name">pilih Supplier</label>
            <select name="supplier_name" id="supplier_name" class="selectpicker form-control" data-live-search="true">
                <?php foreach ($data['supp'] as $supp) : ?>
                    <option value="<?= $supp['supplier_name']; ?>"> <?= $supp['supplier_name']; ?></option>
                <?php endforeach; ?>
            </select>

        <?php  } else { ?>

            <label for="customer_name">pilih Customer</label>
            <select name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true">
                <?php foreach ($data['cust'] as $cust) : ?>
                    <option value="<?= $cust['customer_name']; ?>"> <?= $cust['customer_name']; ?></option>
                <?php endforeach; ?>
            </select>

        <?php } ?>

        <label for="PO_date">Tanggal Purchase</label>
        <input type="date" id="PO_date" name="PO_date" autocomplete="off" required>

        <label for="other_expenses">Catatan Lain</label>
        <input type="text" id="other_expenses" name="other_expenses" autocomplete="off">

        <label for="status_pembayaran">Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" autocomplete="off">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
        </select>

        <label for="payment_option">Payment Option</label>
        <select name="payment_option" id="payment_option" autocomplete="off" onchange="paySelectCheck(this);">
            <option value="CBD">CBD</option>
            <option value="COD">COD</option>
            <option value="Term of Payment" id="top">Term of Payment</option>
        </select>

        <label id="due_date_label" for="due_date" style="display: none;">Tanggal Jatuh Tempo</label>
        <input type="date" id="due_date" name="due_date" autocomplete="off" style="display:none">

        <label for="ppn">PPN</label>
        <br><select name="ppn" id="ppn">
            <option value="10">10%</option>
            <option value="0">0%</option>
        </select>

        <?php
        if ($data['jenis'] == 'Supplier') { ?>
            <label style="display:none" for="invoice_id">Invoice Number</label>
            <select style="display:none" name="invoice_id" id="invoice_id">
                <option value="0" selected></option>
                <?php foreach ($data['invc'] as $invc) : ?>
                    <option value="<?= $invc['invoice_id']; ?>"><?= $invc['invoice_number']; ?></option>
                <?php endforeach; ?>
            </select>

            <label style="display:none" for="DO_id">DO_id</label>
            <select style="display:none" name="DO_id" id="DO_id">
                <option value="0" selected></option>
                <?php foreach ($data['DO'] as $DO) : ?>
                    <option value="<?= $DO['DO_id']; ?>"><?= $DO['delivery_number']; ?></option>
                <?php endforeach; ?>
            </select>
        <?php  } else { ?>

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
        <?php } ?>

        <input type="submit" value="Submit">
    </form>

</div>