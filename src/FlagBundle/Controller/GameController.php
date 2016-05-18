<?php

namespace FlagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FlagBundle\Entity\Country;

class GameController extends Controller
{

  public function nameToFlagAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    //controlliamo quale set ha selezionato l'utente
    $selectedSet=$request->get('set');
    //filtriamo i paesi in base alla scelta dell'utente
    if ($selectedSet==='mondo'){
        $countrySet=$em->getRepository('FlagBundle:Country')->findAllRecognizedCountries();
    }
    elseif ($selectedSet==='supersfida') {
        $countrySet=$em->getRepository('FlagBundle:Country')->findAll();
    }
    else {
      $countrySet=$em->getRepository('FlagBundle:Country')->findByFlagSet($selectedSet);
    }

    //RANDOMIZZAZIONE
    do{
        $c1=rand(0,(count($countrySet)-1));
        $c2=rand(0,(count($countrySet)-1));
        $c3=rand(0,(count($countrySet)-1));
        $c4=rand(0,(count($countrySet)-1));
    } while($c1===$c2 || $c1===$c3 || $c1===$c4 || $c2===$c3 || $c2===$c4 || $c3===$c4);
    $sorteggiate=[$countrySet[$c1],$countrySet[$c2],$countrySet[$c3],$countrySet[$c4]];
    $mescolate=shuffle($sorteggiate);
    $flag=$countrySet[$c1];

    //controllo se sta giocando
    if($request->get('answer')){
      $rispostaCorretta=$request->get('answer');
      $rispostaUtente=$request->get('guess');
      $punti=$request->get('points')*1;
      $errors=$request->get('errors')*1;
      $rispostaUtente === $rispostaCorretta ? $punti++ : $punti--;
      if ($rispostaUtente !== $rispostaCorretta) $errors--;
      $display= $errors<0 ? 'display:block;' : 'display:none;';
    } else {
        $punti=0;
        $errors=3;
        $display="display:none;";
    }

    return $this->render ('FlagBundle:Game:nametoflag.html.twig', [
        'flags'=>$sorteggiate,
        'country'=>$flag,
        'points'=>$punti,
        'errors'=>$errors,
        'setScelto'=>$selectedSet,
        'display'=>$display
    ]);
  }

    public function flagToNameAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      //controlliamo quale set ha selezionato l'utente
      $selectedSet=$request->get('set');
      //filtriamo i paesi in base alla scelta dell'utente
      if ($selectedSet==='mondo'){
          $countrySet=$em->getRepository('FlagBundle:Country')->findAllRecognizedCountries();
      }
      elseif ($selectedSet==='supersfida') {
          $countrySet=$em->getRepository('FlagBundle:Country')->findAll();
      }
      else {
        $countrySet=$em->getRepository('FlagBundle:Country')->findByFlagSet($selectedSet);
      }

      //RANDOMIZZAZIONE
      do{
          $c1=rand(0,(count($countrySet)-1));
          $c2=rand(0,(count($countrySet)-1));
          $c3=rand(0,(count($countrySet)-1));
          $c4=rand(0,(count($countrySet)-1));
      } while($c1===$c2 || $c1===$c3 || $c1===$c4 || $c2===$c3 || $c2===$c4 || $c3===$c4);
      $sorteggiate=[$countrySet[$c1],$countrySet[$c2],$countrySet[$c3],$countrySet[$c4]];
      $mescolate=shuffle($sorteggiate);
      $flag=$countrySet[$c1];

      //controllo se sta giocando
      if($request->get('answer')){
        $rispostaCorretta=$request->get('answer');
        $rispostaUtente=$request->get('guess');
        $punti=$request->get('points')*1;
        $errors=$request->get('errors')*1;
        $rispostaUtente === $rispostaCorretta ? $punti++ : $punti--;
        if ($rispostaUtente !== $rispostaCorretta) $errors--;
        $display= $errors<0 ? 'display:block;' : 'display:none;';
      } else {
          $punti=0;
          $errors=3;
          $display="display:none;";
      }


      return $this->render ('FlagBundle:Game:flagtoname.html.twig', [
          'countries'=>$sorteggiate,
          'flag'=>$flag,
          'points'=>$punti,
          'setScelto'=>$selectedSet,
          'errors'=>$errors,
          'display'=>$display
      ]);
    }
}
