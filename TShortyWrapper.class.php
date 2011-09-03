<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 16:31)
  *
  /***************************************************************************/
  class TShortyWrapper {
  // **************************************************************************

    /**
     *
     *
     * @var array
     */
    protected $aResolverMap = array();

    /**
     * 
     *
     * @var array
     */
    protected $aShortenerMap = array();

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return TShortyWrapper
     */
    public function __construct() {
    // ------------------------------------------------------------------------
      $this->aResolverMap = array(
        "http://is.gd"=>new TResolverISGD(),
        "http://bit.ly"=>new TResolverBITLY("http://bit.ly"),
        "http://j.mp"=>new TResolverBITLY("http://j.mp"),
        "http://goo.gl"=>new TResolverGOOGL()
      );
      $this->aShortenerMap = array(
        "http://is.gd"=>new TShortenerISGD(),
        "http://bit.ly"=>new TShortenerBITLY("http://bit.ly"),
        "http://j.mp"=>new TShortenerBITLY("http://j.mp"),
        "http://goo.gl"=>new TShortenerGOOGL()
      );
    }
    // ------------------------------------------------------------------------
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sName
     * @return mixed|TShortener
     */
    public function GetShortenerByName($sName) {
    // ------------------------------------------------------------------------
      try { 
        $oShortener = $this->aShortenerMap[$sName];
      } catch (Exception $e) {
        $oShortener = null;
        throw new InvalidArgumentException("unknown shortener: ".$sName);
      }
 
      return $oShortener;
    }
    // ------------------------------------------------------------------------
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sName
     * @return mixed|TResolver
     */
    public function GetResolverByName($sName) {
    // ------------------------------------------------------------------------
      try {
        $oResolver = $this->aResolverMap[$sName];
      } catch (Exception $e) {
        $oResolver = null;
        throw new InvalidArgumentException("unknown resolver: ".$sName);
      }
 
      return $oResolver;
    }
    // ------------------------------------------------------------------------
 
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sURL
     * @return mixed|TResolver
     */
    public function GetResolverByURL($sURL) {
    // ------------------------------------------------------------------------
      if (substr($sURL, 0, 7) != 'http://') {
        throw new Exception('wrong URL');
      } else {
        $sName = substr($sURL, 0, strpos($sURL, '/', 7));
      }
 
      return $this->GetResolverByName($sName);
    }
    // ------------------------------------------------------------------------
 
 
  }
  // **************************************************************************