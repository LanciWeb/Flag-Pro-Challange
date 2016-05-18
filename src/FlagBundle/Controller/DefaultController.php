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

      $visibility='none'; //do per scontato che non vengo da una partita perciò non devo mostrare il popup
      $top10=false;
      //se arrivo dalla fine di una partita...
      $verifica = 'niente';
      if($request->get('mode')){
        $visibility='block';
        //prendo ciò che mi serve dal form
        $player=$request->get('playerName');
        $points=$request->get('points')*1;
        $mode=$request->get('mode');


        //se ho giocato da bandiera a nome...
        if ($mode=='ftn'){
          //controllo se ci sono almeno 10 partite
            if (count($record_ftn)>=10)// se ci sono già 10 giocatori in lista devo controllare che il punteggio rientri nella top 10
            {
              $puntiDecimo=$em->getRepository('FlagBundle:Record')->FindLastFtNPosition($set);
              if($points>=$puntiDecimo[1]){
                  $decimo=$em->getRepository('FlagBundle:Record')->findTenthFtNPosition($set, $puntiDecimo[1]);
                  $em->remove($decimo);
                  $em->flush();
                  $top10=true;
              }

            }
            else $top10=true; // se non ci sono ancora 10 giocatori si entra di diritto in top 10
            if($top10===true){ // se entrato in top 10 registro
              $punteggio=new Record(); //aggiungo il nuovo record
              $punteggio->setName($player);
              $punteggio->setPoints($points);
              $punteggio->setMode($mode);
              $punteggio->setFlagset($set);
              $em->persist($punteggio);
              $em->flush();
              //e aggiorno la classifica
              $record_ftn=$em->getRepository('FlagBundle:Record')->FindFtNByChosenSet($set);
            }
        }
        //se ho giocato da nome a bandiera...
        else{

          //controllo se ci sono almeno 10 partite
            if (count($record_ntf)>=10)// se ci sono già 10 giocatori in lista devo controllare che il punteggio rientri nella top 10
            {
              $puntiDecimo=$em->getRepository('FlagBundle:Record')->FindLastNtFPosition($set);
              if($points>=$puntiDecimo[1]){
                  $decimo=$em->getRepository('FlagBundle:Record')->findTenthNtFPosition($set, $puntiDecimo[1]);
                  $em->remove($decimo);
                  $em->flush();
                  $top10=true;
              }
            }
            else $top10=true; // se non ci sono ancora 10 giocatori si entra di diritto in top 10
            if($top10===true){ // se entrato in top 10 registro
              //inserisco il nuovo record
              $punteggio=new Record();
              $punteggio->setName($player);
              $punteggio->setPoints($points);
              $punteggio->setMode($mode);
              $punteggio->setFlagset($set);
              $em->persist($punteggio);
              $em->flush();
              //e aggiorno la classifica
              $record_ntf=$em->getRepository('FlagBundle:Record')->FindNtFByChosenSet($set);
            }
        }
      }
      $congrats= $top10 ? "Congratulazioni!" : "Spiacenti...";
      $messaggio= $top10 ?  "Sei entrato nella top 10 del livello $set!" :
        "questa volta non hai raggiunto la top 10...";

      return $this->render ('FlagBundle:Default:recordspage.html.twig',[
        'record_ftn'=>$record_ftn,
        'record_ntf'=>$record_ntf,
        'modalita'=>strtoupper($set),
        'visibility'=>$visibility, //mi serve per decidere se mostrare il modale o meno
        'congrats'=>$congrats,
        'messaggio'=>$messaggio
      ]);
    }

}
