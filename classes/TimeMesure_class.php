<?
class TimeMesure
	{
    var $tstart;
    var $fp;
    function TimeMesure ($file)
    	{
		$this->fp = fopen($file, "w+");
        $mtime = microtime();
        $mtime = explode(" ",$mtime);
        $mtime = $mtime[1] + $mtime[0];
        $this->tstart = $mtime;
        }
	function TimeCalc($point)
	    {
	    $mtime = microtime();
	    $mtime = explode(" ",$mtime);
	    $mtime = $mtime[1] + $mtime[0];
	    $tend = $mtime;
	    $totaltime = ($tend - $this->tstart);
	    $totaltime =  sprintf("%1.3f", $totaltime);
	    $cnt_det = fwrite($this->fp,$tend."\t:\t".$totaltime."\t\t - point ".$point."\n");
	    }
    function TimeEnd()
    	{
        fclose($this->fp);
        }
    function GetTime()
    	{
	    $mtime = microtime();
	    $mtime = explode(" ",$mtime);
	    $mtime = $mtime[1] + $mtime[0];
	    $tend = $mtime;
	    $totaltime = ($tend - $this->tstart);
	    $totaltime =  sprintf("%1.3f", $totaltime);
        return $totaltime;
        }
	}
?>