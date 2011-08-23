<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 18:11)
  *
  /***************************************************************************/
  class TResolver {
  // **************************************************************************
 
    protected $sName = '';
 
    protected $sAPI = '';
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return TResolver
     */
    public function __construct() {
    // ------------------------------------------------------------------------
      throw new Exception("Abstract Resolver cannot be initialized.");
    }
    // ------------------------------------------------------------------------
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sURL
     * @return void
     */
    public function TestURL($sURL) {
    // ------------------------------------------------------------------------
      if (substr($sURL, 0, strlen($this->sName)) == $this->sName) {
        if (strrpos($sURL, '/') < 7) {
          throw new Exception("Can't parse URL");
        }
      } else {
        throw new Exception('Not a correct URL');
      }
    }
    // ------------------------------------------------------------------------
 
    // ------------------------------------------------------------------------
    /**
     *
     *
     * @param string $sURL
     * @return string
     */
    public function GetHandle($sURL) {
    // ------------------------------------------------------------------------
      return substr($sURL, strrpos($sURL, '/')+1);
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
      $this->TestURL($sURL);
      $sReturn = str_replace("\n", "", file_get_contents(trim($this->sAPI.$this->GetHandle($sURL))));
      
      return $sReturn;
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