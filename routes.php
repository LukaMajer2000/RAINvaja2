<?php
/*
  Usmerjevalnik (router) skrbi za obravnavo HTTP zahtev. Glede na zahtevo, 
  pokliče ustrezno akcijo v zahtevanem controllerju.
*/

// Funkcija, ki kliče kontrolerje in hkrati vključuje njihovo kodo in kodo modela
function call($Controller, $action)
{
  // Vključimo kodo controllerja in modela (pazimo na poimenovanje datotek)
  require_once('controllers/' . $Controller . '_Controller.php');
  require_once('models/' . $Controller . '.php');

  // Ustvarimo kontroler
  $o = $Controller . "_Controller"; //generiramo ime razreda controllerja
  $Controller = new $o; //ustvarimo instanco razreda (ime razreda je string spremenljivka)

  //pokličemo akcijo na kontrolerju (ime funkcije je string spremenljivka)
  $Controller->{$action}();
}

// Seznam vseh dovoljenih controllerjev in njihovih akcij. Z njegovo pomočjo bi 
// lahko definirali tudi pravice (ustrezno zmanjšali nabor akcij pod določenimi pogoji)
$Controllers = array(
  'pages' => ['home', 'error'],
  'users' => ['add', 'delete', 'edit', 'editConfirm', 'save', 'clean', 'index', 'display']
);

// Preverimo, če zahteva kliče controller in akcijo iz zgornjega seznama
if ( array_key_exists($Controller, $Controllers) && in_array($action, $Controllers[$Controller])) {
  // Pokličemo akcijo
  call($Controller, $action);
} else {
  // Izpišemo stran z napako
  call('pages', 'error');
}
