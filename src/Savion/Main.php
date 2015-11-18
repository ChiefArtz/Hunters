<?php
        /*   _       _________ _______  _______  _______ 
|\     /||\     /|( (    /|\__   __/(  ____ \(  ____ )(  ____ \
| )   ( || )   ( ||  \  ( |   ) (   | (    \/| (    )|| (    \/
| (___) || |   | ||   \ | |   | |   | (__    | (____)|| (_____ 
|  ___  || |   | || (\ \) |   | |   |  __)   |     __)(_____  )
| (   ) || |   | || | \   |   | |   | (      | (\ (         ) |
| )   ( || (___) || )  \  |   | |   | (____/\| ) \ \__/\____) |
|/     \|(_______)|/    )_)   )_(   (_______/|/   \__/\_______)
                                                               
                                                               */


namespace Savion;

use pocketmine\utils\Config;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\Listener;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;


use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\CallbackTask;

use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\math\Vector3;

use pocketmine\block\Block;

use pocketmine\tile\Sign;
use pocketmine\tile\Tile;

use pocketmine\level\Position;
use pocketmine\level\Level;

use pocketmine\event\player\PlayerInteractEvent;




class Main extends PluginBase implements Listener
{

public $setGame1 = array();
public $setGame2 = array();
public $setGame3 = array();
public $setGame4 = array();

public $setRoom1 = array();
public $setRoom2 = array();
public $setRoom3 = array();
public $setRoom4 = array();

public $Setter = array();

public $players1 = array(); //game1 players
public $players2 = array(); //game2 players
public $players3 = array(); //game3 players
public $players4 = array(); //game4 players

public $status1 = 0;
public $status2 = 0;
public $status3 = 0;
public $status4 = 0;

public $time1 = 0;
public $time2 = 0;
public $time3 = 0;
public $time4 = 0;


	       public function onEnable()
	       {
	    	@mkdir($this->getDataFolder());
		$this->config=new Config($this->getDataFolder() . "config.yml", Config::YAML, array("Test" => "Test"));
		$this->getServer()->getPluginManager()->registerEvents($this,$this);	
		$this->getServer()->getLogger()->info("[Hunters]Loaded!");
		}
		
		public function onCommand(CommandSender $sender, Command $command, $label, array $args)
	        {
		if(!isset($args[0])){
			unset($sender,$cmd,$label,$args);
			return false;
			
		};
		switch ($args[0])
		{
			case "setgame":
		//	$sender->sendMessage("test");
	if(!$this->config->exists("game1") && !$this->config->exists("game4") && !$this->config->exists("game2") && !$this->config->exists("game3")){
	
		 $this->set1($sender);
		$sender->sendMessage("Please tap a sign!");
		return true;
		}
		
		if(!$this->config->exists("game2") && $this->config->exists("game1")){
		$this->set2($sender);
		$sender->sendMessage("Please tap a sign!"); 
		return true;
		}
		
		if(!$this->config->exists("game3") && $this->config->exists("game2") && $this->config->exists("game1")){
		$this->set3($sender);
		$sender->sendMessage("Please tap a sign!"); 
		return true;
		}
		
		if(!$this->config->exists("game4") && $this->config->exists("game2") && $this->config->exists("game3") && $this->config->exists("game1")){
		$this->set4($sender);
		$sender->sendMessage("Please tap a sign!"); 
		return true;
		}
		
		if($this->config->exists("game4") && $this->config->exists("game2") && $this->config->exists("game3") && $this->config->exists("game1")){
			
   		$sender->sendMessage("Max game count has already been set!");
		return false;
		}
		break;
		//todo: command for setting rooms
		}
	        }
		
		//add gametask
		
		public function room1(PlayerInteractEvent $ev){
		$p = $ev->getPlayer();
		$block = $ev->getBlock();
		$levelname = $p->getLevel()->getName();
		if(isset($this->setRoom1[$p->getName()]) && $p->isOp() === true){
		switch($this->Setter[$p->getName()]){
		case 0:
		
			if($ev->getBlock()->getID() != 152){
				$p->sendMessage("please tap a REDSTONE BLOCK!"); 
					return;
				}
				
					$this->waitroom=array(
					"x" =>$block->getX(),
					"y" =>$block->getY(),
					"z" =>$block->getZ(),
					"level" =>$levelname,
					"waitroom");
						unset($this->Setter[$p->getName()]);
				unset($this->setRoom1[$p->getName()]);
				$this->config->set("[game1]wairoom",$this->waitroom);
				$this->config->save();
				$p->sendMessage("waitroom created!");
				break;
		}
	}
}
		public function setGame1(PlayerInteractEvent $ev){
         	$p = $ev->getPlayer();
		$block = $ev->getBlock();
		$levelname = $p->getLevel()->getName();
		if(isset($this->setGame1[$p->getName()]) && $p->isOp() === true){
		switch($this->Setter[$p->getName()]){
		case 0:
		
			if($ev->getBlock()->getID() != 63 && $ev->getBlock()->getID() != 68){
				$p->sendMessage("please tap a SIGN!"); 
					return;
				}
				
	                	$this->sign=array(
					"x" =>$block->getX(),
					"y" =>$block->getY(),
					"z" =>$block->getZ(),
					"level" =>$levelname,
					"sign");
					$this->Setter[$p->getName()]++;
				$this->config->set("[game1]sign",$this->sign);
				$this->config->save();
				$p->sendMessage("sign created!");
				break;
				
				/*Hunters spot*/ case 1:
				$this->pos1=array(
					"x" =>$block->x,
					"y" =>$block->y, 
					"z" =>$block->z,
					"level" =>$levelname,
					"pos1");
					$this->Setter[$p->getName()]++;
				$this->config->set("pos1",$this->pos1);
				$this->config->save();
				$p->sendMessage("pos1 created!");
				break;
				
				/*Hunters spot*/case 2:
				$this->pos2=array(
					"x" =>$block->x,
					"y" =>$block->y,
					"z" =>$block->z,
					"level" =>$levelname,
					"pos2"); 
				$this->config->set("[game1]pos2",$this->pos2);
				$this->config->set("game1","true");
				unset($this->pos1);
				unset($this->pos2);
				unset($this->Setter[$p->getName()]);
				unset($this->setGame1[$p->getName()]);
				$this->config->save();
				$p->sendMessage("pos2 created! everything setup(reminder: remember todo /h setroom to set the waitroom");
				break;
				
				
		
		}
		
		}else{
			
		$sign = $p->getLevel()->getTile($block);
/* will this work? */if($sign->getX() === $this->config->get("[game1]sign")["x"] && $sign->getY() === $this->config->get("[game1]sign")["y"] && $sign->getZ() === $this->config->get("[game1]sign")["z"] && $sign instanceof Sign && $p->getLevel()->getName() === $this->config->get("[game1]sign")["level"] && $this->config->exists("game1") && !isset($this->players1[$p->getName()])){
		$this->addGamePlayer1($p);
		if(!$this->config->exists("[game1]waitroom")){
		$p->sendMessage("Waitroom isnt setup!");
		$ev->setCancelled();
		return;
		}
		
		$p->setLevel($this->getServer()->getLevelByName($this->config->get("[game1]waitroom")["level"]));
		$p->teleport($this->config->get("[game1]waitroom"));
		
		foreach($this->players1 as $pl){
		$pl->sendMessage($p->getName()." Joined the match!");
		
		}
		//more todo
		}
		}
		
		}
		
		//add kills?
		public function setRoom1(Player $p){ 
				unset($this->Setter[$p->getName()]);
				unset($this->setRoom1[$p->getName()]);
	        $this->setRoom1[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}
		
		public function setRoom2(Player $p){ 
				unset($this->Setter[$p->getName()]);
				unset($this->setRoom2[$p->getName()]);
	        $this->setRoom2[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}
		
		public function setRoom3(Player $p){ 
				unset($this->Setter[$p->getName()]);
				unset($this->setRoom3[$p->getName()]);
	        $this->setRoom3[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}
		
		public function setRoom4(Player $p){ 
				unset($this->Setter[$p->getName()]);
				unset($this->setRoom4[$p->getName()]);
	        $this->setRoom4[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}
		
		public function set1(Player $p){ 
	        $this->setGame1[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}
		
		public function set2(Player $p){
        	$this->setGame2[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}
		
		public function set3(Player $p){
		$this->setGame3[$p->getName()] = array("Player" => $p->getName());	
		$this->Setter[$p->getName()] = 0;
		}
		
		public function set4(Player $p){
		$this->setGame4[$p->getName()] = array("Player" => $p->getName());
		$this->Setter[$p->getName()] = 0;
		}	
		
	public function addGamePlayer1(Player $p){
		$this->players1[$p->getName()] = array("Player" => $p->getName());
	}
	
	public function addGamePlayer2(Player $p){
		$this->players2[$p->getName()] = array("Player" => $p->getName());
	}
	
	public function addGamePlayer3(Player $p){
		$this->players3[$p->getName()] = array("Player" => $p->getName());
	}
	
	public function addGamePlayer4(Player $p){
		$this->players4[$p->getName()] = array("Player" => $p->getName());
	}
	
		
}
