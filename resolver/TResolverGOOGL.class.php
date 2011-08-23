<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 18:23)
  *
  /***************************************************************************/
  class TResolverGOOGL extends TResolver {
  // **************************************************************************
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return TResolverGOOGL
     */
    public function __construct() {
    // ------------------------------------------------------------------------
      $this->SetName("http://goo.gl");

      $this->SetAPI("https://www.googleapis.com/urlshortener/v1/url?shortUrl=http://goo.gl/");
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sURL
     * @return string
     */
    public function Resolve($sURL) {
    // ------------------------------------------------------------------------
      $sResult = parent::Resolve($sURL);
      $oResult = json_decode($sResult);
      $sReturn = $oResult->longUrl;

      return $sReturn;
    }
    // ------------------------------------------------------------------------
 
  }
  // **************************************************************************