<?php


class JeuDuBowling
{
	private $_score = 0;
	private $_scoreFrame;
	private $_nbLancer = 0;
	private $_premierLancer = false;


	public function lancer( $nbQuilles )
	{
		if($this->_premierLancer)
		{
			$this->_scoreFrame = $nbQuilles;
		}
		else
		{
			$this->_scoreFrame += $nbQuilles;
		}
		$this->_score += $this->_scoreFrame;

		$this->_premierLancer = !$this->_premierLancer;
	}

	public function score()
	{
		if( $this->isSpare() )
		{
			return ( "/" );
		}
		elseif( $this->isStrike() )
		{
			return ( "X" );
		}
		return $this->_score;
	}

	/**
	 * @return bool
	 */
	private function isSpare()
	{
		return $this->_scoreFrame == 10;
	}

	private function isStrike()
	{
		return $this->_scoreFrame == 10;
	}

}