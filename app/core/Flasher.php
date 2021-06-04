<?php
class Flasher
{
    public static function setFlash($pesan, $aksi)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi
        ];
    }

    public static function flash()
    {
        $test = "this.parentElement.style.display='none';";
        if (isset($_SESSION['flash'])) {
            echo '
            <div class="alert">   
                <span class="closebtn" onclick="' . $test . '">&times;</span>
                Data <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '.
            </div>
            ';
            unset($_SESSION['flash']);
        }
    }
}
