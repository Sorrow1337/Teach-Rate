<div class="comments">
  <div class="pages">
<!--    <a class="page" href="">&lt;</a>-->
    <a class="page active" href="">1</a>
<!--    <a class="page" href="">2</a>-->
  </div>

  <?php $sys->comments(); ?>

  <form method="post" id="commentform">
    <div><input type="text" name="name" value="Pseudo" size="20" /></div><br />
    <div><textarea  name="text">Votre message</textarea></div>
    <div align="center"><input class="submit" type="submit" value="Ajouter commentaire"></div>
  </form>

</div>