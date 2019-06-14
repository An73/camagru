<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href= <?php echo '/public/css/'.$css.'.css';?> >
</head>
<body>
    <?php require 'application/views/'.$contentView.'.php'; ?>
</body>
</html>