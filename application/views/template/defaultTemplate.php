<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href= <?php echo '/public/css/'.$css.'.css';?> >
</head>
<body>
    <?php require 'application/views/'.$contentView.'.php'; ?>
</body>
<script src='/public/js/function.js'></script>
<script src= <?php echo '/public/js/'.$js.'.js';?> ></script>
</html>