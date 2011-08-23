<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 8/12/11 9:31 PM)
  *
  /***************************************************************************/
  class TAutoLoader {
  // **************************************************************************

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sClassName
     * @return string
     */
    public static function LoadClass($sClassName) {
    // ------------------------------------------------------------------------
      $sClassPath = dirname(__FILE__).'/';
      if (stristr($sClassName, 'Shortener')) $sClassPath .= 'shortener/';
      elseif (stristr($sClassName, 'Resolver')) $sClassPath .= 'resolver/';

      require_once($sClassPath.$sClassName.'.class.php');
    }
    // ------------------------------------------------------------------------

  }
  // **************************************************************************