<?php
/*
* Plugin Name: _ Content Kit Base
* Description: Block based design system with additional styles and patterns
* Author: uptimizt
* GitHub Plugin URI: https://github.com/uptimizt/content-kit-base
* Version: 0.220510
*/

namespace ContentKitBase;

// add_filter('lzb/block_render/include_template', __NAMESPACE__ . '\\' . 'chg_template_path', 10, 4);
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\' . 'commone_style');
add_action('plugins_loaded', function(){
  require_once __DIR__ . '/styles/loader.php';
  require_once __DIR__ . '/blocks/loader.php';
});



/**
 * add_style(
    'no-gap-vertical',
    array(
      'label'  => _x( 'No vertical gap', 'Block style label.', 'additional-block-styles' ),
      'blocks' => array(
        'core/column',
        'core/columns',
        'core/cover',
        'core/gallery',
        'core/group',
        'core/heading',
        'core/image',
        'core/latest-posts',
        'core/media-text',
        'core/paragraph',
      ),
    )
  );
*/

function add_style($style_name = '', $args){
  
  if(empty($args['blocks'])){
    return false;
  }

  foreach($args['blocks'] as $block_name){
    register_block_style(
      $block_name,
      array(
          'name'         => $style_name,
          'label'        => $args['label'],
          'is_default'   => false,
          'style_handle' => $args['style_handle'] ?? null,
          'inline_style' => $args['inline_style'] ?? null,
      )
    );
  
  }

}


function commone_style()
{
  $path = 'utilities/utilities.css';
  $url = plugins_url($path, __FILE__);
  $path = __DIR__ . '/' . $path;
  if (file_exists($path)) {
    wp_enqueue_style(
      'ckb-utilities',
      $url,
      $dep = [],
      $var = filemtime($path)
    );
  }
}