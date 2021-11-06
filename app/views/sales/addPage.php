<div class="container">
    <h1>Tambah data Sales</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Sales">Kembali</a>

    <form action="<?= BASEURL; ?>/Sales/tambah" method="post">

        <label for="customer_id">Customer</label>
        <select name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true">
            <?php foreach ($data['cust'] as $cust) : ?>
                <option value="<?= $cust['customer_id']; ?>"> <?= $cust['customer_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">

            <?php foreach ($data['prod'] as $prod) : ?>

                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>

            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off" value="<?= $prod['quantity']; ?>">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off">

        <label for="sales_date">Tanggal Sales</label>
        <input type="date" id="sales_date" name="sales_date" autocomplete="off">

        <input type="submit" value="Submit">
    </form>

</div>