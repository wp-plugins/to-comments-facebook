<?php
 
// Vamos garantir que � o WordPress que chama este ficheiro
// e que realmente est� a desistalar o plugin.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
  die();
 
// Vamos remover as op��es que cri�mos na instala��o
delete_option('tcf_config');
 
?>