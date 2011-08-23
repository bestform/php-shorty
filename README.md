About
=====

a php port of bestform shorty python library (can be found on https://github.com/bestform/shorty)

it's not a one-to-one port - so i changed the variable names to how i'd write them and made more than one class file for all that classes - because thats also my coding style

to avoid class loading issues i wrote a simple autoloader that can find the class files for unknown classnames

To use the library with bit.ly, you have to create a (free) account to get an API key.
Just copy the file `settings.py.empty` to `settings.py` and insert your login and key.

Unit Tests
==========

You can run the unit tests by if you have installed phpunit with the following command

    phpunit --colors test.php

Example usage
=============

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

TODO
=============

getting stuck in the test of exceptions - phpunit seems to be eixting after (correct) exception was thrown ...
and say "hey its all okay i made x assertions" - wtf? but maybe i'm only a little bit ... stupid?

write a cli script that does something like the example.php but for command line

write a bootstrap file for phpunit instead of using config files and setting up autoloader 
