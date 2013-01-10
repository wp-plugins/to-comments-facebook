<?php
/*
Plugin Name: To Comments Facebook
Plugin URI: 
Description: Tira o sistema de comentário nativo do WordPress e adiciona o formato de comentários utilizando o Facebook.
Author: Nova Brazil Agência Interativa
Version: 1.0.1
Author URI: http://www.novabrazil.art.br
*/

/* Carrega Idioma */
load_plugin_textdomain('tcf', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

/* Intalação  do Plugin */
// Registamos a função para correr na ativação do plugin
register_activation_hook( __FILE__, 'ToCommentsFacebook_install' );

function ToCommentsFacebook_install(){
  //Valores padrões do plugin
  $reg['comments_width']      = 500;
  $reg['comments_beforeHTML'] = __('<h3>Coment&aacute;rios no Facebook</h3>', 'tcf');
  $reg['comments_afterHTML']  = '';
  update_option('tcf_config', $reg);
}

/* Carrega Dados */
$reg = get_option('tcf_config');


/* ADMIN */

//Adiciona Página no Admin
add_action('admin_menu', 'ToCommentsFacebook_config_page');

function ToCommentsFacebook_config_page() {
  add_submenu_page('options-general.php', 
	                 'To Comments Facebook',
	                 'To Comments Facebook', 
	                 'manage_options', 
	                 'ToCommentsFacebook', 
	                 'ToCommentsFacebook_conf'
	                 );
}


/* Cadastro */
$msg = null;

//Verifica se é um post e atualiza registro..
if( (!empty($_POST['comments_width'])) || (!empty($_POST['comments_beforeHTML']))){

  $reg  = array();
  $reg['comments_width'] = $_POST['comments_width'];
  $reg['comments_beforeHTML'] = $_POST['comments_beforeHTML'];
  $reg['comments_afterHTML'] = $_POST['comments_afterHTML'];
  
  update_option('tcf_config', $reg);
  $msg = __('Cadastro atualizado com êxito.', 'tcf');

}
function ToCommentsFacebook_conf() {
  global $reg, $msg;
?>

<div class="wrap">
  <img src="<?= plugins_url( 'nbrazil.png', __FILE__ ); ?>" width="36" height="36" style="float:left; margin:7px">
  <h2>To Comments Facebook</h2>

  <?
  //mensagem
  if(!empty($msg)){
    echo('<div id="setting-error-settings_updated" class="updated settings-error">' . "\n");
    echo('<p>' . "\n");
    echo('<strong>' . $msg . '</strong>' . "\n");
    echo('</p>' . "\n");
    echo('</div>' . "\n");
  }
  ?>  
  <form action="" method="post" id="">
    <p><?= __('Preencha abaixo a configuração necessária para o funcionamento do Comentário do Facebook.', 'tcf'); ?></p>
    
    
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row">
        <label for="blogname"><b><?= __('Largura do Bloco', 'tcf'); ?></b></label>
      </th>
      <td>
        <input id="comments_width" class="small-text" type="text" value="<?= $reg['comments_width']; ?>" name="comments_width"> pixels
      </td>
    </tr>

    <tr valign="top">
      <th scope="row">
        <label for="blogname"><b><?= __('Código HTML exibido ANTES', 'tcf'); ?></b></label>
        <p><?= __('Digite o código HTML que será exibido antes do Bloco de Comentário do Facebook.', 'tcf'); ?></p>
      </th>
      <td>
        <textarea id="comments_beforeHTML" class="large-text code" rows="3" name="comments_beforeHTML"><?= $reg['comments_beforeHTML']; ?></textarea>
      </td>
    </tr>   
    
    <tr valign="top">
      <th scope="row">
        <label for="blogname"><b><?= __('Código HTML exibido DEPOIS', 'tcf'); ?></b></label>
        <p><?= __('Digite o código HTML que será exibido depois do Bloco de Comentário do Facebook.', 'tcf'); ?></p>
      </th>
      <td>
        <textarea id="comments_afterHTML" class="large-text code" rows="3" name="comments_afterHTML"><?= $reg['comments_afterHTML']; ?></textarea>
      </td>
    </tr>   
     
  </tbody>
</table>

    <p class="submit">
     <input id="submit" class="button button-primary" type="submit" value="<?= __('Salvar alterações', 'tcf'); ?>" name="submit">
    </p>
  </form>
  
  <div><?= __('Este plugin é desenvolvido por', 'tcf'); ?> <a href="http://www.novabrazil.art.br" target="_blank" title="<?= __('Nova Brazil Agência Interativa', 'tcf'); ?>"><?= __('Nova Brazil Agência Interativa', 'tcf'); ?></a>.</div>
   
</div>
<?php
}



/* AÇÕES E FILTROS */

//Retira o comentário nativo e coloca o do Facebook
add_filter('comments_template', 'no_comments_on_page');
function no_comments_on_page( $file )
{
  $file = dirname( __FILE__ ) . '/comments.php';
  return $file;
}

?>