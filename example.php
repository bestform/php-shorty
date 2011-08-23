<?php
  require_once(dirname(__FILE__).'/TAutoLoader.class.php');
  spl_autoload_register(array('TAutoLoader', 'LoadClass'));
  require_once(dirname(__FILE__).'/config.inc.php');

  $sInput = "http://tonstube.de";
  $sShortenerToUse = "http://is.gd";

  echo 'used shortener: '.$sShortenerToUse.'<br />';
  echo 'input: '.$sInput.'<br /><br />';

  echo 'shortening url...<br /><br />';


  $oShorty = new TShortyWrapper();
  /** @var $oShortener TShortenerISGD */
  $oShortener = $oShorty->GetShortenerByName($sShortenerToUse);
  $sShortenedURL = $oShortener->Shorten($sInput);

  echo 'shortened url: '.$sShortenedURL.' - used shortener class: '.get_class($oShortener).'<br /><br />';

  echo 'resolving shortened url...<br /> <br />';

  /** @var $oResolver TResolverISGD */
  $oResolver = $oShorty->GetResolverByURL($sShortenedURL);
  $sFullURL = $oResolver->Resolve($sShortenedURL);

  echo 'resolved url: '.$sFullURL.' - used resolver class: '.get_class($oResolver).'<br />';
