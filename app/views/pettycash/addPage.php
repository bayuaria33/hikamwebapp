<div class="container">
    <h1>Tambah data PettyCash</h1>
    <a class="editButton" href="<?= BASEURL; ?>/PettyCash">Kembali</a>


    <form action="<?= BASEURL; ?>/PettyCash/tambah" method="post">
        <label for="name">Penggunaan</label>
        <input type="text" id="name" name="name" autocomplete="off" required>

        <label for="petty_date">tanggal</label>
        <input type="date" id="petty_date" name="petty_date" autocomplete="off" required>

        <label for="price">Biaya</label>
        <input type="number" id="price" name="price" autocomplete="off" required>
        
        <input type="submit" value="Submit">
    </form>

</div>