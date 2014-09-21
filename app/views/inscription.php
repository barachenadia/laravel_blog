<h2>Inscription au site : </h2>
<form action="http://127.0.0.1:8000/inscription" method="post">
    <?php echo $errors->first('nom', '<p>:message</p>'); ?>
  <label for="username"><strong>username :</strong></label>
  <input type="text" name="username" id="username"/>

   <label for="email"><strong>email :</strong></label>
  <input type="text" name="email" id="email"/>

   <?php echo $errors->first('passe', '<p>:message</p>'); ?>
  <label for="password"><strong>Mot de passe :</strong></label>
  <input type="password" name="password" id="password"/>

  <input type="submit" value="S'inscrire"/>
</form>
