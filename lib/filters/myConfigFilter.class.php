<?php
class myConfigFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    // Code to execute before the action execution
    $configs = Doctrine_Core::getTable('Config')->findAll();
    foreach ($configs as $config)
    {
      sfConfig::set($config->getName(), $config->getValue());
    }
    // Execute next filter in the chain
    $filterChain->execute();

    // Code to execute after the action execution, before the rendering
  }
}
