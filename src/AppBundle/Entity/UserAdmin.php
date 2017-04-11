<?php
namespace AppBundle\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use FOS\UserBundle\Model\User as BaseUser ;
use Doctrine\ORM\Mapping as ORM;
/**
 * Description of UserAdmin
 *
 * @author y
 *
 */
/**
 * Class UserAdmin
 * 
 * @package AppBundle\Entity
 * 
 * @ORM\Entity
 * @ORM\Table(name="user_admin4")
 * 
 */
class UserAdmin extends BaseUser 
{
    //put your code here
    
    /**
     *
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *  
     * 
     */
    
    
    protected $id;
    
    public function __construct()
            {
        
        parent::__construct();
        
        $this->roles = array('ROLE8_ADMIN');
    }
    
}
