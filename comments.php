<?
$reg = get_option('tcf_config');
?>
<!-- Script que adiciona Comentários do Facebook -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?= $reg['comments_beforeHTML']; ?>
<!-- Script de Comentários do Facebook -->
<div id="fb-root"></div>
<script  src="http://connect.facebook.net/en_BR/all.js#fml=1"></script>
<fb:comments href="<?php the_permalink(); ?>" width="<?= $reg['comments_width']; ?>"> </fb:comments>
<?= $reg['comments_afterHTML']; ?>
