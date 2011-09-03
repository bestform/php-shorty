<?php
  /****************************************************************************
  * 2011 Philipp Holz, Freiburg, Germany (P. Holz - 25.06.11 18:11)
  *
  /***************************************************************************/
  class TestURLFuntions extends PHPUnit_Framework_TestCase {
  // **************************************************************************

    /**
     *
     *
     * @var TShortyWrapper
     */
    protected $oShorty = null;

    /**
     *
     *
     * @var array
     */
    protected $aResolverPacks = array();

    /**
     *
     *
     * @var array
     */
    protected $aShortenerPacks = array();

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return void
     */
    protected function setUp() {
    // ------------------------------------------------------------------------
      require_once(dirname(__FILE__).'/TAutoLoader.class.php');
      spl_autoload_register(array('TAutoLoader', 'LoadClass'));
      require_once(dirname(__FILE__).'/config.inc.php');

      $this->oShorty = new TShortyWrapper();

      $this->aResolverPacks = array(
        array(
          "sName"=>"http://is.gd",
          "sURL"=>"http://tonstube.de",
          "sShortURL"=>"http://is.gd/T9vnnv",
          "sHandle"=>"T9vnnv"
        ),
        array(
          "sName"=>"http://bit.ly",
          "sURL"=>"http://tonstube.de/",
          "sShortURL"=>"http://bit.ly/neXRRS",
          "sHandle"=>"neXRRS"
        ),
        array(
          "sName"=>"http://j.mp",
          "sURL"=>"http://tonstube.de/",
          "sShortURL"=>"http://j.mp/neXRRS",
          "sHandle"=>"neXRRS"
        ),
        array(
          "sName"=>"http://goo.gl",
          "sURL"=>"http://tonstube.de/",
          "sShortURL"=>"http://goo.gl/ezv5G",
          "sHandle"=>"ezv5G"
        )
      );

      $this->aShortenerPacks = array(
        array(
          "sName"=>"http://is.gd",
          "sURL"=>"http://tonstube.de"
        ),
        array(
         "sName"=>"http://bit.ly",
         "sURL"=>"http://tonstube.de/"
        ),
        array(
          "sName"=>"http://j.mp",
          "sURL"=>"http://tonstube.de/"
        ),
        array(
          "sName"=>"http://goo.gl",
          "sURL"=>"http://tonstube.de/"
        )
      );
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return void
     * @expectedException InvalidArgumentException
     */
    public function testUnknowResolver() {
    // ------------------------------------------------------------------------
      $this->oShorty->GetResolverByName('foo');
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     * 
     * @return void
     */
    public function testResolvers() {
    // ------------------------------------------------------------------------
      //die(print_r($this->aResolverPacks, true));

      foreach ($this->aResolverPacks AS $aResolver) {
        $oResolver = $this->oShorty->GetResolverByURL($aResolver['sShortURL']);
        $this->assertEquals($oResolver->GetName(), $aResolver['sName']);

        $expectedException = null;
        $e = null;
        $bThrownAsExpected = false;
        try{
          $oResolver->Resolve("unknown");
        } catch (InvalidArgumentException $expectedException){
            $bThrownAsExpected = true;
        } catch (Exception $e) {
            // pass
        }
        if(!$bThrownAsExpected){
            $this->fail("resolver didn't throw expected Exception when provided with a wrong url");
        }
        $bThrownAsExpected = false;
        try{
          $oResolver->Resolve($aResolver["sName"]);
        } catch (InvalidArgumentException $expectedException){
            $bThrownAsExpected = true;
        } catch (Exception $e) {
            // pass
        }
        if(!$bThrownAsExpected){
            $this->fail("resolver didn't throw expected Exception when provided with a wrong formatted url");
        }

        $this->assertEquals($oResolver->GetHandle($aResolver["sShortURL"]), $aResolver["sHandle"]);
        $this->assertEquals($oResolver->Resolve($aResolver["sShortURL"]), $aResolver["sURL"]);
      }
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return void
     */
    public function testUnknownShortener() {
    // ------------------------------------------------------------------------
      $this->setExpectedException('Exception', 'unknown shortener: foo');
      $this->oShorty->GetShortenerByName('foo');
    }
    // ------------------------------------------------------------------------

    // ------------------------------------------------------------------------
    /**
     *
     *
     * @return void
     */
    public function testShorteners() {
    // ------------------------------------------------------------------------
      foreach ($this->aShortenerPacks AS $aShortener) {
        $oShortener = $this->oShorty->GetShortenerByName($aShortener["sName"]);
        $this->assertEquals($oShortener->GetName(), $aShortener["sName"]);
        $sShortURL = $oShortener->Shorten($aShortener["sURL"]);
        $oResolver = $this->oShorty->GetResolverByURL($sShortURL);
        $sLongURL = $oResolver->Resolve($sShortURL);
        $this->assertEquals($aShortener["sURL"], $sLongURL);
      }
    }
    // ------------------------------------------------------------------------

  }
  // **************************************************************************
