<?php

/**
*
*  ___             _______________  
* |  |            |  _____________| 
* |  |            |  |               
* |  |            |  |               
* |  |            |  | 
* |  |            |  |____________ 
* |  |            |_____________  |
* |  |                         |  |
* |  |                         |  |
* |  |                         |  |
* |  |_________   _____________|  |  
* |____________| |________________| 
*
* Hearlov to discord "hearlov"
*/

namespace hearlov\vipkeys;

use pocketmine\{Server, player\Player, plugin\PluginBase, utils\Config};

use hearlov\vipkeys\command\vipkeyCommand;
use hearlov\vipkeys\command\reedemCommand;

Class VIPKeys extends PluginBase{

	//Param Config
	private $config;

	//Get YAML Keys
	private $keys;

	//Language Config
	public $lang;
	
	private static $instance = null;

	public function onEnable(): void{
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->keys = new Config($this->getDataFolder() . "keys.yml", Config::YAML);
		$langcnf = new Config($this->getDataFolder() . "lang.yml", Config::YAML);
		$this->lang = $langcnf->get($this->config->get("language"));
		$this->initCommands();
	}
	
	public function reloadPlugin(){
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->keys = new Config($this->getDataFolder() . "keys.yml", Config::YAML);
		$langcnf = new Config($this->getDataFolder() . "lang.yml", Config::YAML);
		$this->lang = $langcnf->get($this->config->get("language"));
	}

	public function onLoad(): void{
		self::$instance = $this;
	}
	
	public static function getInstance(): VIPKeys {
		return self::$instance;
	}
	
	public function getConfig(): Config{
		return $this->config;
	}

	public function setConfigVariant(Int $int){
		$this->config->set("code-length", $int);
		$this->config->save();
	}

	/*
	* Return (lang.yml) String
 	*/
	public function getLanguage($cont): String{
		return ($this->lang[$cont] ? $this->lang[$cont] : "NoLanguage");
	}

	/*
 	* Return randomized key code
	*/
	public function getCustomRCode(int $length = 12): string{
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 	ceil($length/strlen($x)) )),1,$length);
	}

	/*
	* Return true|false
 	*/
	public function in_key(string $key): bool{
		return in_array($key, array_keys($this->keys->getAll()));
	}
	
	/*
	* Return Array|null
	*/
	public function getKey(string $key){
		if($this->in_key($key)){
			return $this->keys->get($key);
		}
		return ["AA"];
	}
	
	public function getKeyAll(): Array{
		return $this->keys->getAll();
	}
	
	public function useKey($player, $key){
		if($this->in_key($key)){
			$info = $this->getKey($key);
			$this->keys->set($key, ["used" => true, "player" => $player->getName(), "group" => $info["group"]]);
			$this->keys->save();
		}
	}
	
	public function removeKey($key){
		if($this->in_key($key)){
			$this->keys->remove($key);
			$this->keys->save();
		}
	}

	public function generateKey($group): string{
		$keyleng = $this->config->get("code-length");
		$key = $this->getCustomRCode($keyleng);
		if(!$this->in_key($key)){
			$this->keys->set($key, ["used" => false, "player" => "none", "group" => $group]);
			$this->keys->save();
			return $key;
		}
		return "none";
	}

	private function initCommands(): void{
        $commands = [

			new vipkeyCommand(),
			new reedemCommand()
        ];

        $this->getServer()->getCommandMap()->registerAll("VIPKeys", $commands);
    }

}
