<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 18:22)
  *
  /***************************************************************************/
  class TShortenerGOOGL extends TShortener {
  // **************************************************************************
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return TShortenerGOOGL
     */
    public function __construct() {
    // ------------------------------------------------------------------------
      $this->SetName("http://goo.gl");

      $this->SetAPI("https://www.googleapis.com/urlshortener/v1/url");
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sURL
     * @return string
     */
    public function Shorten($sURL) {
    // ------------------------------------------------------------------------
      $rCurl = curl_init('https://www.googleapis.com/urlshortener/v1/url');

      curl_setopt($rCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      curl_setopt($rCurl, CURLOPT_POSTFIELDS, json_encode(array('longUrl'=>$sURL)));
      curl_setopt($rCurl, CURLOPT_RETURNTRANSFER, true);

      $foo = curl_exec($rCurl);

      $foo = json_decode($foo);
      $sShortenedURL = $foo->id;

      return $sShortenedURL;
    }
    // ------------------------------------------------------------------------
    
  }
  // **************************************************************************