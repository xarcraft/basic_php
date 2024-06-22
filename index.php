<?php
require_once 'consts.php';
require_once 'function.php';
$data = get_data(API_URL);
$until_message = get_until_message($data["days_until"]);

?>

<!DOCTYPE html>
<html lang="es">

<?php render_template('head', $data); ?>

<body>
    <?php render_template('main', array_merge($data, ["until_message" => $until_message])); ?>
</body>

</html>


<?php render_template('styles'); ?>

<!-- Video 50:43 -->