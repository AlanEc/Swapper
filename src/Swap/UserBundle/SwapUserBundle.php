<?php

namespace Swap\UserBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;


class SwapUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }

}