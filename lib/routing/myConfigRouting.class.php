<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class myConfigRouting
{

  /**
   * Adds an sfDoctrineRouteCollection collection to manage users.
   *
   * @param sfEvent $event
   * @static
   */
  static public function addRouteForAdminConfig(sfEvent $event)
  {
    $event->getSubject()->prependRoute('config', new sfDoctrineRouteCollection(array(
      'name'                => 'config',
      'model'               => 'Config',
      'module'              => 'myConfigAdmin',
      'prefix_path'         => 'config',
      'with_wildcard_routes' => true,
      'collection_actions'  => array('filter' => 'post', 'batch' => 'post'),
      'requirements'        => array(),
    )));
  }

}