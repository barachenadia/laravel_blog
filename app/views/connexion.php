<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<h2>Connexion au site : </h2>
<?php
    echo Form::open(array('url' => 'connexion'));
    echo '<strong>',Form::label('nom', 'Nom :'),'</strong>';
    echo Form::text('nom');
    echo '<strong>',Form::label('password', 'Mot de passe :'),'</strong>';
    echo Form::password('password');
    echo Form::submit('Se connecter');
    echo Form::close();
?>
</body>
</html>