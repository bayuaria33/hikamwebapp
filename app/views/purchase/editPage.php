<div class="container">
    <h1>Edit data Purchase <?= $data['PO']['PO_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Purchase/Item/<?= $data['PO']['PO_id']; ?>">Kembali</a>

    <form action="<?= BASEURL; ?>/Purchase/edit/<?= $data['PO']['PO_id']; ?>" method="post">
        <label class="hidden" for="PO_id">Id Purchase</label>
        <input class="hidden" type="hidden" id="PO_id" name="PO_id" autocomplete="off" value="<?= $data['PO']['PO_id']; ?>">

        <label for="purchase_number">Nomor Purchase</label>
        <input type="text" id="purchase_number" name="purchase_number" autocomplete="off" placeholder="Jika kosong akan terisi otomatis di halaman detail" value="<?= $data['PO']['purchase_number']; ?>">

        <?php
        if ($data['jenis'] == 'Supplier') { ?>

            <label for="supplier_name">pilih Supplier</label>
            <select name="supplier_name" id="supplier_name" class="selectpicker form-control" data-live-search="true">
                <?php foreach ($data['supp'] as $supp) : ?>
                    <option value="<?= $supp['supplier_name']; ?>" <?php if ($supp['supplier_name'] == $data['PO']['supplier_name']) echo " selected" ?>> <?= $supp['supplier_name']; ?></option>
                <?php endforeach; ?>
            </select>

        <?php  } else { ?>

            <label for="customer_name">pilih Customer</label>
            <select name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true">
                <?php foreach ($data['cust'] as $cust) : ?>
                    <option value="<?= $cust['customer_name']; ?>" <?php if ($cust['customer_name'] == $data['PO']['customer_name']) echo " selected" ?>> <?= $cust['customer_name']; ?></option>
                <?php endforeach; ?>
            </select>

        <?php } ?>

        <label for="PO_date">Tanggal Purchase</label>
        <input type="date" id="PO_date" name="PO_date" autocomplete="off" value="<?= $data['PO']['PO_date']; ?>">

        <label for="other_expenses">Pengeluaran Lain</label>
        <input type="text" id="other_expenses" name="other_expenses" autocomplete="off" value="<?= $data['PO']['other_expenses']; ?>">

        <label for="status_pembayaran">Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" autocomplete="off">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
        </select>

        <label for="payment_option">Payment Option</label>
        <select name="payment_option" id="payment_option" autocomplete="off" onchange="paySelectCheck(this);">
            <option value="CBD">CBD</option>
            <option value="COD">COD</option>
            <option value="After Invoice">Setelah Invoice Diterima</option>
            <option value="Term of Payment" id="top">Term of Payment</option>
        </select>

        <label id="due_date_label" for="due_date" style="display: none;">Tanggal Jatuh Tempo</label>
        <input type="date" id="due_date" name="due_date" autocomplete="off" style="display:none" value="<?= $data['PO']['due_date']; ?>">

        <label for="ppn">PPN</label>
        <br><select name="ppn" id="ppn">
            <option value="10">10%</option>
            <option value="0">0%</option>
        </select>

        <?php
        if ($data['jenis'] == 'Supplier') { ?>
            <!-- Kosong if supplier -->
        <?php  } else { ?>

            <label for="invoice_id">Invoice Number</label>
            <select name="invoice_id" id="invoice_id" class="selectpicker form-control" data-live-search="true">
                <option value="0" selected></option>
                <?php foreach ($data['invc'] as $invc) : ?>
                    <option value="<?= $invc['invoice_id']; ?>" <?php if ($invc['invoice_id'] == $data['PO']['invoice_id']) echo " selected" ?>><?= $invc['invoice_number']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="DO_id">DO_id</label>
            <select name="DO_id" id="DO_id" class="selectpicker form-control" data-live-search="true">
                <option value="0" selected></option>
                <?php foreach ($data['DO'] as $DO) : ?>

                    <option value="<?= $DO['DO_id']; ?>" <?php if ($DO['DO_id'] == $data['PO']['DO_id']) echo " selected" ?>><?= $DO['delivery_number']; ?></option>

                <?php endforeach; ?>
            </select>
        <?php } ?>

        <input type="submit" value="Submit">
    </form>

</div>