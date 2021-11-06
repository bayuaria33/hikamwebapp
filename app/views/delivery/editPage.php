<div class="container">
    <h1>Edit data Delivery <?= $data['DO']['DO_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Delivery/Item/<?= $data['DO']['DO_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Delivery/edit/<?= $data['DO']['DO_id']; ?>" method="post">
        <label class="hidden" for="DO_id">Id Delivery</label>
        <input class="hidden" type="hidden" id="DO_id" name="DO_id" autocomplete="off" value="<?= $data['DO']['DO_id']; ?>">

        <label for="delivery_number">Nomor Delivery</label>
        <input type="text" id="delivery_number" name="delivery_number" autocomplete="off" placeholder="Jika kosong akan terisi otomatis di halaman detail">

        <label for="customer_name">pilih Customer</label>
        <select name="customer_name" id="customer_name" class="selectpicker form-control" data-live-search="true">
            <?php foreach ($data['cust'] as $cust) : ?>

                <option value="<?= $cust['customer_name']; ?>"> <?= $cust['customer_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="DO_date">Tanggal Delivery</label>
        <input type="date" id="DO_date" name="DO_date" autocomplete="off" value="<?= $data['DO']['DO_date']; ?>">

        <label for="other_expenses">Pengeluaran Lain</label>
        <input type="text" id="other_expenses" name="other_expenses" autocomplete="off" value="<?= $data['DO']['other_expenses']; ?>">

        <label for="status_pembayaran">Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" autocomplete="off">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
        </select>

        <label for="due_date">Tanggal Jatuh Tempo</label>
        <br><input type="date" id="due_date" name="due_date" autocomplete="off" value="<?= $data['DO']['due_date']; ?>">

        <label for="ppn">PPN</label>
        <br><select name="ppn" id="ppn">
            <option value="10">10%</option>
            <option value="0">0%</option>
        </select>

        <label for="PO_id">Purchase Order Number</label>
        <select name="PO_id" id="PO_id" class="selectpicker form-control" data-live-search="true">
            <option value="0" selected></option>
            <?php foreach ($data['PO'] as $PO) : ?>

                <option value="<?= $PO['PO_id']; ?>"><?= $PO['purchase_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="invoice_id">Invoice Number</label>
        <select name="invoice_id" id="invoice_id" class="selectpicker form-control" data-live-search="true">
            <option value="0" selected></option>
            <?php foreach ($data['invc'] as $invc) : ?>

                <option value="<?= $invc['invoice_id']; ?>"><?= $invc['invoice_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit">
    </form>

</div>