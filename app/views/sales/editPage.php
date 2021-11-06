<div class="container">
    <h1>Edit data Sales</h1>
    <a class="editButton" href="<?= BASEURL; ?>/Sales">Kembali</a>
    <!-- <?php echo '<pre>', var_dump($data), '</pre>'; ?> -->

    <form action="<?= BASEURL; ?>/Sales/edit/<?= $data['sales']['sales_id']; ?>" method="post">
        <label class="hidden" for="sales_id">Id Sales</label>
        <input class="hidden" type="hidden" id="sales_id" name="sales_id" autocomplete="off" value="<?= $data['sales']['sales_id']; ?>">

        <label for="customer_id">Customer</label>
        <select name="customer_id" id="customer_id" class="selectpicker form-control" data-live-search="true">
            <option value="<?= $data['customer_id']; ?>" disabled style="color: red;"><?= $data['sales']['customer_name']; ?></option>
            <?php foreach ($data['cust'] as $cust) : ?>
                <option value="<?= $cust['customer_id']; ?>"> <?= $cust['customer_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="product_id">Product</label>
        <select name="product_id" id="product_id" class="selectpicker form-control" data-live-search="true">
            <option value="<?= $data['product_id']; ?>" disabled style="color: red;"><?= $data['sales']['product_name']; ?></option>
            <?php foreach ($data['prod'] as $prod) : ?>
                <option value="<?= $prod['product_id']; ?>"><?= $prod['product_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" autocomplete="off" value="<?= $data['sales']['quantity']; ?>">

        <label for="price">Price</label>
        <input type="text" id="price" name="price" autocomplete="off" value="<?= $data['sales']['price']; ?>">

        <label for="sales_date">Tanggal Sales</label>
        <input type="date" id="sales_date" name="sales_date" autocomplete="off" value="<?= $data['sales']['date']; ?>">


        <input type="submit" value="Submit">
    </form>

</div>