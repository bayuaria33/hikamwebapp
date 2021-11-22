<div class="container">
    <br>
    <?php if (empty($_SESSION['user_id'])) : ?>
        <h1>Welcome Guest</h1>
    <?php else : ?>
        <h1>Welcome <?= $_SESSION['username']; ?></h1>
    <?php endif; ?>
    <br>
    <?php echo '<pre>', var_dump($_SESSION), '</pre>'; ?>
</div>