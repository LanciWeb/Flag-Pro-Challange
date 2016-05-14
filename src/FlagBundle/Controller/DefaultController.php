<?php

namespace FlagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FlagBundle\Entity\Record;

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

    public function recordChoiceAction()
    {
      return $this->render ('FlagBundle:Default:recordset.html.twig');
    }

    public function recordsPageAction(Request $request)
    {
      $em=$this->getDoctrine()->getManager();
      $set=$request->get('set');

      $record_ftn=$em->getRepository('FlagBundle:Record')->FindFtNByChosenSet($set);
      $record_ntf=$em->getRepository('FlagBundle:Record')->FindNtFByChosenSet($set);
      return $this->render ('FlagBundle:Default:recordspage.html.twig',[
        'record_ftn'=>$record_ftn,
        'record_ntf'=>$record_ntf,
        'modalita'=>strtoupper($set)
      ]);
    }

}
