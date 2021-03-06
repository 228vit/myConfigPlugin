<?php

class myConfig extends sfConfig
{

  /**
   * Retrieves a config parameter from array prepared by myConfigFilter,
   * and check if this parameter does not exists in Config table
   *
   * @param string $name    A config parameter name
   * @param mixed  $default A default config parameter value
   *
   * @return mixed A config parameter value, if the config parameter exists, otherwise null
   */
  public static function get($name, $default = null, $description = null)
  {
    if (!sfConfig::get($name))
    {
      $res = Doctrine_Query::create()
              ->from('Config c')
              ->where('c.name = ?', $name)
              ->fetchOne();
      if (!$res)
      {
        $c = new Config();
        $c->setName($name);
        $c->setValue($default);
        $c->setDescription($description);
        $c->save();
      }
    }

    return (isSet(self::$config[$name]) ? self::$config[$name] : $default);
  }

  /**
   * Saves a config parameter to DB
   *
   * @param string $name    A config parameter name
   * @param mixed  $default A default config parameter value
   *
   * @return string (updated|created)
   */
  public static function set($name, $default = null, $description = null)
  {
      $c = Doctrine::getTable('Config')->findOneByName($name);
      if (!$c)
      {
        $c = new Config();
        $c->setName($name);
        $c->setValue($default);
        $c->setDescription($description);
        $c->save();
        return 'created';
      }
      else
      {
        $c->setName($name);
        $c->setValue($default);
        $c->setDescription($description);
        $c->save();
        return 'updated';
      }

  }

}

