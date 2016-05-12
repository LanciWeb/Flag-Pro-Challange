<?php

namespace FlagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    public function flagToNameAction(Request $request)
    {
      $setCountries=$request->get('set');


      return $this->render ('FlagBundle:Default:flagtoname.html.twig', [

      ]);
    }

    public function nameToFlagAction(Request $request)
    {
      $setCountries=$request->get('set');

      return $this->render ('FlagBundle:Default:nametoflag.html.twig', [

      ]);
    }

}
