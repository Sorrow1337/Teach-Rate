  <?php $sys->details($_GET['id']); ?>
</div>

<script type="text/javascript">
$(function()
{
  $(".use_tooltip").tooltip( { position: 'bottom center', predelay: 500 } ).dynamic();
  $(".use_tooltip_top").tooltip( { position: 'top center', predelay: 500 } ).dynamic();
});
</script>
<?php echo $_COOKIE['rate']; ?>