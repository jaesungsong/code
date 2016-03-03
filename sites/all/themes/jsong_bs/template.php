<?php

/**
 * @file
 * template.php
 */


/**
 * Implement hook_form_user_login_block_alter
 * @description: To insert the icon font.
 */
function jsong_bs_form_user_login_block_alter(&$form, &$form_state){
    //debug($form['links']['#markup']);
    $form['links']['#markup'] = '<ul><li class="first"><a href="/user/register" title="Create a new user account."><i class="icon fontello icon-user-add" aria-hidden="true"></i></a></li> | <li class="last"><a href="/user/password" title="Request new password via e-mail."><i class="icon fontello icon-key" aria-hidden="true"></i></a></li></ul>';
}

/**
 * Implement hook_preprocess_node
 * @description: To redirect unauthorized user to front page
 */
function jsong_bs_preprocess_node(&$variables) {
	
	global $user;
	
	if(isset($variables['field_tags'][0]) && $variables['field_tags'][0]['tid'] == '23' && $user->uid == 0){
	 
		drupal_set_message(t('Please login to view any funny content ;)'), 'error');
		drupal_goto();
	 
	}
	
	//dsm($variables['field_tags']);
 
}

/**
 * Implement hook_preprocess_views_exposed_form
 * @description: To modify view's exposed form field
 */
function jsong_bs_preprocess_views_exposed_form(&$vars, $hook) {

  // Specify the Form ID
  if (isset($vars['form']['field_postal_address_administrative_area'])) {
	  
	$vars['form']['field_postal_address_administrative_area']['#size'] = 4;
	$vars['form']['field_postal_address_administrative_area']['#maxlength'] = 2;
	
	// Rebuild the rendered version
	unset($vars['form']['field_postal_address_administrative_area']['#printed']);
	$vars['widgets']['filter-field_postal_address_administrative_area']->widget = drupal_render($vars['form']['field_postal_address_administrative_area']);
	
	//dsm($vars);

  }
}

/*********************************************************************************************************
 * Implements hook_views_post_render(). added by jsong
 * @description: to display page row count and total count of item row
 *
function jsong_bs_views_post_render(&$view, &$output, &$cache) {
  // When using full pager, disable any time-based caching if there are less
  // then 10 results.
  if ($view->query->pager instanceof views_plugin_pager_full && $cache->options['type'] == 'time' && count($view->result) < 10) {
    $cache['options']['results_lifespan'] = 0;
    $cache['options']['output_lifespan'] = 0;
  }
  
  if(!empty($view->result))
  {
	  $rowCount = count($view->result);
	  $totalCount = $view->total_rows;
	  $totalCount = $totalCount == null ? $rowCount : $totalCount;
	  $countDisplay = '<div class="totalcount-jsong" style="position:absolute; right:0;">Displaying <b>'.$rowCount.'</b> of <b>'.$totalCount.'</b></div>';
	  $output = $countDisplay.$output;
  }
  
  //dsm($countDisplay);
  //dsm($output);
}
/*********************************************************************************************************/