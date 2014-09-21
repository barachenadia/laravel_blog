<h2>Inscription au site : </h2>
<form action="http://127.0.0.1:8000/inscription" method="post">
    <?php echo $errors->first('nom', '<p>:message</p>'); ?>
  <label for="nom"><strong>Nom :</strong></label>
  <input type="text" name="nom" id="nom"/>
   <?php echo $errors->first('passe', '<p>:message</p>'); ?>
  <label for="pass"><strong>Mot de passe :</strong></label>
  <input type="text" name="passe" id="pass"/>
  <?php echo $errors->first('confirmepasse', '<p>:message</p>'); ?>
  <label for="confirmepasse"><strong>Confirmation du mot de passe :</strong></label>
  <input type="text" name="confirmepasse" id="confirmepasse"/>
  <input type="submit" value="S'inscrire"/>
</form>
