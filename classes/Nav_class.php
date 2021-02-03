<?php
//require_once("main.inc.php");
class Navigation
	{
//    var $menu;
//	var $submenu;
//	var $curpos;
	var $history = array();
//	var $Menu_history = array();
	var $position = array();
//	var $start;
    function GetPos()
		{
		return $this->position;
		}	
    function SetPos($curPosition, $history)
		{
/*		if($history)
			$this->SetCurURI();*/
		$this->position = $curPosition;
/*		$this->curpos['menu'] = $pos_menu;
		$this->curpos['submenu'] = $pos_submenu;
		$this->Menu_history[$pos_menu] = $pos_submenu;*/
		}
    function SetCurPos($pos_menu, $pos_submenu)
		{
//		$this->SetCurURI();
/*		$this->curpos['menu'] = $pos_menu;
		$this->curpos['submenu'] = $pos_submenu;
		$this->Menu_history[$pos_menu] = $pos_submenu;*/
		}
    function Navigation (/*$val*/)
    	{
		$this->SetCurPos(0, 0);
		$this->position[] = 0;

        }
    function SetCurURI() /*added 16_05*/
		{
		$item = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$hisCnt = count($this->history);
		$hisLimit = 5;
		if ($this->history[count($this->history)-1] != $item)
			{
			if($hisCnt>=$hisLimit)
				{
				$tmp = array_shift ($this->history);
				}
			$this->history[] = $item; 
			}
		}
    function GetHistoryItem($val) /*12_05_2007 возвращает адрес из истории со смещением назад равным $val*/
		{
/*		echo 'history - ';
		print_r($this->history); */
		if($this->history[count($this->history)-$val])
			$ret = $this->history[count($this->history)-$val];
		else
			$ret = $_SERVER['SERVER_NAME'];
//		return $this->history[count($this->history)-1]; 
		return $ret;
		}
    function GetPrewURI() /*added 16_05*/
		{
/*		echo 'history - ';
		print_r($this->history); */
		if($this->history[count($this->history)-1])
			$ret = $this->history[count($this->history)-1];
		else
			$ret = $_SERVER['SERVER_NAME'];
//		return $this->history[count($this->history)-1]; 
		return $ret;
		}
	function GetCurPos ($menu, $m)
		{
		if ($menu == 1)
			$ret_val = $this->curpos['menu'];
		else
			{
//			echo $this->curpos['submenu'].' - s<br>'.$this->curpos['menu'].' - m<br>';	
			$ret_val = $this->Menu_history[$m];
//			print_r($this->Menu_history);
			
			}
		return $ret_val;
		}

	}
/*if(!isset($_SESSION['NAV']))
	{*/
/*session_register($tmp);
session_unregister($tmp);
*/
/*
if(!session_is_registered('NAV'))	
	{
	$NAV = new Navigation (5);
	session_register('NAV');
	}
*/	
//	}
?>