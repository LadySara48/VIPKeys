<?php

namespace hearlov\vipkeys\event;

use pocketmine\event\plugin\PluginEvent;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use hearlov\vipkeys\VIPKeys;
use pocketmine\player\Player;

//ErvaAblaPro22

Class KeyDeletionEvent extends PluginEvent implements Cancellable{
    use CancellableTrait;

	private $player;
	private $key;
	
	public function __construct(
	VIPKeys $plugin,
	Player $player,
	String $key
	){
		parent::__construct($plugin);
		$this->player = $player;
		$this->key = $key;
	} 

	/*
 	* return Player
	*/
	public function getPlayer(): Player{
		return $this->player;
	}

	/*
 	* return String
  	* key code
	*/
	public function getKey(){
		return $this->key;
	} 

}
