<div class="container">
    <h1>Edit data Purchase <?= $data['PO']['PO_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Purchase/Item/<?= $data['PO']['PO_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Purchase/edit/<?= $data['PO']['PO_id']; ?>" method="post">
        <label class="hidden" for="PO_id">Id Purchase</label>
        <input class="hidden" type="hidden" id="PO_id" name="PO_id" autocomplete="off" value="<?= $data['PO']['PO_id']; ?>">

        <label for="customer_name">pilih Customer</label>
        <select name="customer_name" id="customer_name">
            <?php foreach ($data['cust'] as $cust) : ?>

                <option value="<?= $cust['customer_name']; ?>"> <?= $cust['customer_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="PO_date">Tanggal Purchase</label>
        <input type="date" id="PO_date" name="PO_date" autocomplete="off" value="<?= $data['PO']['PO_date']; ?>">

        <label for="other_expenses">Pengeluaran Lain</label>
        <input type="text" id="other_expenses" name="other_expenses" autocomplete="off" value="<?= $data['PO']['other_expenses']; ?>">

        <label for="status_pembayaran">Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" autocomplete="off">
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
        </select>

        <label for="due_date">Tanggal Jatuh Tempo</label>
        <br><input type="date" id="due_date" name="due_date" autocomplete="off" value="<?= $data['PO']['due_date']; ?>">

        <label for="ppn">PPN</label>
        <br><select name="ppn" id="ppn">
            <option value="10">10%</option>
            <option value="0">0%</option>
        </select>

        <label for="invoice_id">Invoice Number</label>
        <select name="invoice_id" id="invoice_id">
            <option value="0" selected></option>
            <?php foreach ($data['invc'] as $invc) : ?>

                <option value="<?= $invc['invoice_id']; ?>"><?= $invc['invoice_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="DO_id">DO_id</label>
        <select name="DO_id" id="DO_id">
            <option value="0" selected></option>
            <?php foreach ($data['DO'] as $DO) : ?>

                <option value="<?= $DO['DO_id']; ?>"><?= $DO['delivery_number']; ?></option>

            <?php endforeach; ?>
        </select>

        <input type="submit" value="Submit">
    </form>

</div>