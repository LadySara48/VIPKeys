<?php

namespace hearlov\vipkeys;

use pocketmine\{Server, player\Player, plugin\PluginBase, utils\Config};

use hearlov\vipkeys\command\vipkeyCommand;
use hearlov\vipkeys\command\reedemCommand;

Class VIPKeys extends PluginBase{

	//Param Config
	private $config;

	//Get YAML Keys
	private $keys;
	
	public $lang;
	
	private static $instance = null;

	public function onEnable(): void{
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->keys = new Config($this->getDataFolder() . "keys.yml", Config::YAML);
		$this->lang = new Config($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml", Config::YAML);
		$this->initCommands();
	}
	
	public function reloadPlugin(){
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->keys = new Config($this->getDataFolder() . "keys.yml", Config::YAML);
		$this->lang = new Config($this->getDataFolder() . "languages/" . $this->config->get("language") . ".yml", Config::YAML);
	}
	
	public function onLoad(): void{
		self::$instance = $this;
	}
	
	public static function getInstance(): VIPKeys {
		return self::$instance;
	}
	
	public function getConfig(): Config{
		return $this->config;
	} //66675
	
	public function getLanguage($cont): String{
		return $this->lang->get($cont);
	}

	public function getCustomRCode(int $length = 12): string{
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 	ceil($length/strlen($x)) )),1,$length);
	}

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
		$key = $this->getCustomRCode();
		if(!$this->in_key($key)){
			$this->keys->set($key, ["used" => false, "player" => "none", "group" => $group]);
			$this->keys->save();
			return $key;
		}
		return "none";
	}

	private function initCommands(): void{
        $commands = [

			new vipkeyCommand($this),
			new reedemCommand($this)
        ];

        $this->getServer()->getCommandMap()->registerAll("HearlovVIPKeys", $commands);
    }

}