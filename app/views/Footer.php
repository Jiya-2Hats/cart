<?php
if (isset($data['js'])) {
    foreach ($data['js'] as $jsFile) : ?>
        <script src="<?= BASE_URL ?>/app/assets/js/<?= $jsFile ?>"></script>
<?php endforeach;
}
?>

</body>

</html>