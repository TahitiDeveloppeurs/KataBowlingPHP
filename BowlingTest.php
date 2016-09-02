<?php

require_once 'JeuDuBowling.php';

class BowlingTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var JeuDuBowling
	 */
	private $jeu;

	function setUp()
	{
		$this->jeu = new JeuDuBowling();
	}

	function testPeutCréerLeJeuDuBowling()
	{
		$this->assertNotNull( $this->jeu );
		$this->assertTrue( $this->jeu instanceof JeuDuBowling );
	}

	function testUnLancerDe2Quilles_donneUnScoreDeDeux()
	{

		$this->jeu->lancer( 2 );

		$this->assertEquals( 2, $this->jeu->score() );
	}

	function testDeuxLancerDe1Quilles_donneUnScoreDe2()
	{
		$this->jeu->lancer( 1 );
		$this->jeu->lancer( 1 );

		$this->assertEquals( 2, $this->jeu->score() );
	}

	function testSpare()
	{
		$this->jeu->lancer( 6 );
		$this->jeu->lancer( 4 );

		$this->assertEquals( "/", $this->jeu->score() );
	}

	function testNonSpareAuTroisiemeLancer()
	{
		$this->jeu->lancer( 6 );
		$this->jeu->lancer( 2 );
		$this->jeu->lancer( 2 );

		$this->assertEquals( 10, $this->jeu->score() );
	}

	function testSpareDeuxiemeFrame_ScoreSpare()
	{
		$this->jeu->lancer( 6 );
		$this->jeu->lancer( 2 );
		$this->jeu->lancer( 2 );
		$this->jeu->lancer( 8 );

		$this->assertEquals( '/', $this->jeu->score() );
	}

//	function testStrikeSimple()
//	{
//		$this->jeu->lancer( 10 );
//
//		$this->assertEquals( 'X', $this->jeu->score() );
//
//	}
}