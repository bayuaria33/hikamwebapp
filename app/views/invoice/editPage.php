<div class="container">
    <h1>Edit data Invoice <?= $data['invc']['invoice_id']; ?></h1>
    <a class="editButton" href="<?= BASEURL; ?>/Invoice/Item/<?= $data['invc']['invoice_id']; ?>">Kembali</a>


    <form action="<?= BASEURL; ?>/Invoice/edit/<?= $data['invc']['invoice_id']; ?>" method="post">
        <label class="hidden" for="invoice_id">Id Invoice</label>
        <input class="hidden" type="hidden" id="invoice_id" name="invoice_id" autocomplete="off" value="<?= $data['invc']['invoice_id']; ?>">

        <label for="customer_name">pilih Customer</label>
        <select name="customer_name" id="customer_name">
            <?php foreach ($data['cust'] as $cust) : ?>

                <option value="<?= $cust['customer_name']; ?>"> <?= $cust['customer_name']; ?></option>

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

        <label for="due_date">Tanggal Jatuh Tempo</label>
        <br><input type="date" id="due_date" name="due_date" autocomplete="off" value="<?= $data['invc']['due_date']; ?>">

        <br><label for="PO_id">PO_id</label>
        <input type="text" id="PO_id" name="PO_id" autocomplete="off" value="<?= $data['invc']['PO_id']; ?>">

        <label for="DO_id">DO_id</label>
        <input type="text" id="DO_id" name="DO_id" autocomplete="off" value="<?= $data['invc']['DO_id']; ?>">

        <input type="submit" value="Submit">
    </form>

</div>