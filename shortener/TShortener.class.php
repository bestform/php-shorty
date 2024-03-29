<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 18:11)
  *
  /***************************************************************************/
  class TShortener {
  // **************************************************************************

    /**
     *
     *
     * @var string
     */
    protected $sName = '';

    /**
     * 
     *
     * @var string
     */
    protected $sAPI = '';
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return TShortener
     */
    public function __construct() {
    // ------------------------------------------------------------------------
      throw new Exception("Abstract Shortener cannot be initialized.");
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
      $sEncodedURL = urlencode($sURL);
      $sShortenedURL = file_get_contents(trim($this->sAPI.$sEncodedURL));
 
      return $sShortenedURL;
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sName
     * @return void
     */
    public function SetName($sName) {
    // ------------------------------------------------------------------------
      $this->sName = $sName;
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return string
     */
    public function GetName() {
    // ------------------------------------------------------------------------
      return $this->sName;
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sAPI
     * @return void
     */
    public function SetAPI($sAPI) {
    // ------------------------------------------------------------------------
      $this->sAPI = $sAPI;
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return string
     */
    public function GetAPI() {
    // ------------------------------------------------------------------------
      return $this->sAPI;
    }
    // ------------------------------------------------------------------------
 
  }
  // **************************************************************************