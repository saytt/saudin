<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of PhraseFrançais
 *
 * @author y
 */
/**
 * Class PhraseFrancais
 * @package AppBundle\Entity
 * @ORM\Entity
 * 
 * @ORM\Table(name="PhraseFrancais")
 * 
 * 
 * 
 * 
 */
class PhraseFrancais {
    //put your code here
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="veuillez entrer un mot ou un phrase")
     */
    private $phrase;
    /**
     *
     * @var string
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $phraseJap;
    
    
    
   public function setId($id){
       $this->id=$id;
   }
      /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set phrase
     *
     * @param string $phrase
     *
     * @return PhraseFrancais
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;

        return $this;
    }

    /**
     * Get phrase
     *
     * @return string
     */
    public function getPhrase()
    {
        return $this->phrase;
    }
    /**
     * Set phraseJap
     *
     * @param string $phraseJap
     *
     * @return PhraseFrancais
     */
   public function setPhraseJap($phraseJap){
       $this->phraseJap=$phraseJap;
   }
   /**
     * Get phraseJap
     *
     * @return string
     */
    public function getPhraseJap()
    {
        return $this->phraseJap;
    }
    
    
    
}
