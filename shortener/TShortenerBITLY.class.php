<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 18:22)
  *
  /***************************************************************************/
  class TShortenerBITLY extends TShortener {
  // **************************************************************************
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sName
     * @return TShortenerBITLY
     */
    public function __construct($sName) {
    // ------------------------------------------------------------------------
      $this->SetName($sName);

      $this->SetAPI("http://api.bitly.com/v3/shorten?login=".BITLY_LOGIN."&apiKey=".BITLY_API_KEY."&format=txt&domain=".substr($sName, 7)."&longUrl=");
    }
    // ------------------------------------------------------------------------
 
  }
  // **************************************************************************