<?php

/**
 * myConfigPlugin configuration.
 * 
 * @package     myConfigPlugin
 * @subpackage  config
 * @author      228vit
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class myConfigPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (in_array('myConfigAdmin', sfConfig::get('sf_enabled_modules', array())))
    {
      $this->dispatcher->connect('routing.load_configuration', array('myConfigRouting', 'addRouteForAdminConfig'));
    }
  }
}
