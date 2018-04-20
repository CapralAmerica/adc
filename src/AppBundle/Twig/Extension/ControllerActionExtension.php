<?php

namespace AppBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Abonnement;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * A TWIG Extension which allows to show Controller and Action name in a TWIG view.
 * 
 * The Controller/Action name will be shown in lowercase. For example: 'default' or 'index'
 * 
 */
class ControllerActionExtension extends \Twig_Extension
{

    
    /**
     * @var Request 
     */
    protected $request;

    protected $requestStack;
    protected $em;
    public function __construct(RequestStack $requestStack,EntityManager $em)
    {
        $this->requestStack = $requestStack;
        $this->request = $this->requestStack->getCurrentRequest();
        $this->em = $em;
    }

    



   /**
    * @var \Twig_Environment
    */
    protected $environment;

   
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'get_controller_name' => new \Twig_Function_Method($this, 'getControllerName'),
            'get_action_name' => new \Twig_Function_Method($this, 'getActionName'),
            'active_class' => new \Twig_Function_Method($this, 'getActiveClass'),

        );
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('my_yes_no', array($this, 'yesOrNo')),

        );
    }

    public function yesOrNo($val=null){
        if($val!==null){
            if ($val==0) {
                return "Non";
            }
            if ($val==1) {
                return "Oui";
            }

        }
    }

    /**
    * Get current controller name
    */
    public function getControllerName()
    {

        if(null !== $this->request)
        {
            $pattern = "#Controller\\\([a-zA-Z]*)Controller#";
            $matches = array();
            preg_match($pattern, $this->request->get('_controller'), $matches);
            
            return strtolower($matches[1]);
        }

    }

    /**
    * Get current controller name
    */
    public function getActiveClass($tag)
    {

        if(null !== $this->request)
        {
            $pattern = "#Controller\\\([a-zA-Z]*)Controller#";
            $matches = array();
            preg_match($pattern, $this->request->get('_controller'), $matches);
            
            if(strtolower($matches[1])==$tag){
                return 'class=active';
            }
        }

    }

    /**
    * Get current action name
    */
    public function getActionName()
    {
        if(null !== $this->request)
        {
            $pattern = "#::([a-zA-Z]*)Action#";
            $matches = array();
            preg_match($pattern, $this->request->get('_controller'), $matches);

            return $matches[1];
        }
    }

    public function getName()
    {
        return 'my_controller_action_twig_extension';
    }
}