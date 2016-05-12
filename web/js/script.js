function goBack() {
  this.preventDefault;
  window.history.back()
}

function info(selezione) {
  var text;
  switch(selezione){
    case 'mondo':
    text='Una selezione di tutte le bandiere dei paesi ufficialmente riconosciuti in tutto il mondo!';
    break;

    case 'africa':
    text="Una selezione di tutte le bandiere del continente nero!";
    break;

    case 'asia':
    text="Una selezione di bandiere provenienti dai paesi orientali!";
    break;

    case 'nordamerica':
    text="Una selezione dei paesi del nord e del centro america!";
    break;

    case 'sudamerica':
    text="Una selezione di bandiere provenienti dall'america latina!";
    break;

    case 'oceania':
    text="Queste baniere vengono dalle isole della lontana Oceania!"
    break;

    case 'supersfida':
    text="Una sfida per veri esperti: questa selezione comprende tutte le bandiere del mondo, anche quelle non ufficialmente riconosciute!"
    break;

    default:
    text="Scegli un set di bandiere con cui giocare!";
    break;
  }
  document.getElementById('info').innerHTML=text;
}
