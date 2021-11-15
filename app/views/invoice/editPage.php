<div class="container">
    <h1>Edit data Invoice <?= $data['invc']['invoice_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Invoice/Item/<?= $data['invc']['invoice_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Invoice/edit/<?= $data['invc']['invoice_id']; ?>" method="post">
        <label class="hidden" for="invoice_id">Id Invoice</label>
        <input class="hidden" type="hidden" id="invoice_id" name="invoice_id" autocomplete="off" value="<?= $data['invc']['invoice_id']; ?>">

        <label for="invoice_number">Nomor Invoice</label>
        <input type="text" id="invoice_number" name="invoice_number" autocomplete="off" placeholder="Jika kosong akan terisi otomatis di halaman detail" value="<?= $data['invc']['invoice_number']; ?>">

        <label for="customer_name">pilih Customer</label>
        <select name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true">
            <?php foreach ($data['cust'] as $cust) : ?>
                <option value="<?= $cust['customer_name']; ?>" <?php if ($cust['customer_name'] == $data['invc']['customer_name']) echo " selected" ?>> <?= $cust['customer_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="invoice_date">Tanggal Invoice</label>
        <input type="date" id="invoice_date" name="invoice_date" autocomplete="off" value="<?= $data['invc']['invoice_date']; ?>">

        <label for="other_expenses">Pengeluaran Lain</label>
        <input type="text" id="other_expenses" name="other_expenses" autocomplete="off" value="<?= $data['invc']['other_expenses']; ?>">

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
        <input type="date" id="due_date" name="due_date" autocomplete="off" style="display:none" value="<?= $data['invc']['due_date']; ?>">

        <label for="ppn">PPN</label>
        <br><select name="ppn" id="ppn">
            <option value="10">10%</option>
            <option value="0">0%</option>
        </select>

        <label for="biaya_kirim">Biaya Kirim</label>
        <input type="text" id="biaya_kirim" name="biaya_kirim" autocomplete="off" value="<?= $data['invc']['biaya_kirim']; ?>">

        <label for="PO_id">Purchase Order Number</label>
        <select name="PO_id" id="PO_id" class="selectpicker form-control" data-live-search="true">
            <option value="0" selected></option>
            <?php foreach ($data['PO'] as $PO) : ?>
                <option value="<?= $PO['PO_id']; ?>" <?php if ($PO['PO_id'] == $data['invc']['PO_id']) echo " selected" ?>><?= $PO['purchase_number']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="DO_id">Delivery Order Number</label>
        <select name="DO_id" id="DO_id" class="selectpicker form-control" data-live-search="true">
            <option value="0" selected></option>
            <?php foreach ($data['DO'] as $DO) : ?>

                <option value="<?= $DO['DO_id']; ?>" <?php if ($DO['DO_id'] == $data['invc']['DO_id']) echo " selected" ?>><?= $DO['delivery_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit">
    </form>

</div>