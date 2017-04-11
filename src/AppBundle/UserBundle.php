<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle;

/**
 * Description of UserBundle
 *
 * @author y
 */
use Symfony\Component\HttpKernel\Bundle\Bundle;
class UserBundle extends Bundle{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
