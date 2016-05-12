<?php

namespace FlagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FlagBundle:Default:index.html.twig');
    }

    public function selectModeAction()
    {
      return $this->render('FlagBundle:Default:selectMode.html.twig');
    }

    public function selectSetAction(Request $request)
    {
      $mode=$request->get('mode');

      return $this->render ('FlagBundle:Default:selectset.html.twig', [
        'mode'=>$mode
      ]);
    }

}
