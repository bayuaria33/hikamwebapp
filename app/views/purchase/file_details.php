<?php
function formatBytes($bytes, $precision = 2)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>
<div class="container">
    <div>
        <br>
        <?php Flasher::flash() ?>
        <h1><?= $data['judul']; ?></h1>
        <br>

        <!-- <label class="editButton">
            <input formaction="<?= BASEURL; ?>/upload.php" type="file" accept="application/pdf, application/vnd.ms-excel" />
            Upload File
        </label> -->
        <a class="editButton" href="<?= BASEURL; ?>/Purchase/uploadPage/<?= $data['PO']['PO_id']; ?>">Upload file </a>

        <table id="tabledetail">
            <thead>
                <tr>
                    <th>Nama File</th>
                    <th>Size File</th>
                    <th class="actionbuttons">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['file_PO'] as $PO => $value) : ?>
                    <tr>
                        <td>
                            <?= $value['file_name']; ?>
                        </td>
                        <td>
                            <?= formatBytes($value['file_size']) ?>
                        </td>
                        <td>
                            <a href="<?= BASEURL; ?>/Purchase/hapusFile/<?= $value['pc_file_id']; ?>" class="redButton" style="float:right" onclick="return confirm('Anda yakin akan hapus data ini?')">Delete</a>
                            <a href="<?= BASEURL; ?>/terupload/<?= $value["file_name"]; ?>" class="editButton" style="float:right" download="<?= $value['file_name']; ?>">Download</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <!-- ------------------------------------------------------------- -->

        </table>

    </div>