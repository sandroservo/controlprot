<?php

	class sessionLister
	{
		var $diffSess;

		function sessionLister()
   		{
   		}

   		function getSessionsCount()
   		{
   			if (!$this->diffSess)
   				$this->readSessions();
   			return sizeof($this->diffSess);
   		}

   		function getSessions()
   		{
   			if (!$this->diffSess)
   				$this->readSessions();
   			return $this->diffSess;
   		}

   		//------------------ PRIVATE ------------------
   		function readSessions()
   		{
			$sessPath = get_cfg_var("session.save_path")."\\";
			$diffSess = array();

			$dh = @opendir($sessPath);
			while(($file = @readdir($dh)) !==false )
			{
				if($file != "." && $file != "..")
				{
					$fullpath = $sessPath.$file;
					if(!@is_dir($fullpath))
					{
						// "sess_7480686aac30b0a15f5bcb78df2a3918"
						$fA = explode("_", $file);
						// array("sess", "7480686aac30b0a15f5bcb78df2a3918")
						$sessValues = file_get_contents ( $fullpath );	// get raw session data
						// this raw data looks like serialize() result, but is is
                                    // not extactly this, so if you can process it...
                                    //le me know
						$this->diffSess[$fA[1]]["raw"] = $sessValues;
						$this->diffSess[$fA[1]]["age"] = time()-filectime( $fullpath );
						$this->diffSess[$fA[1]]["creation"] = filectime( $fullpath );
						$this->diffSess[$fA[1]]["modification"] = filemtime( $fullpath );
					}
				}
			}
			@closedir($dh);
   		}
	}



    // Um simples exemplo:
 echo $sl->getSessionsCount()." sessões existentes<br>";
 foreach( $sl->getSessions() as $sessName => $sessData )
 {
    echo "<hr>Sessão ".$sessName." :<br>";
    echo " Raw = ".$sessData["raw"]."<br>";
    echo " Criada em = ".date( "d/m/Y H:i:s",$sessData["creation"])."<br>";
    echo " Modificada em = ".date( "d/m/Y H:i:s",$sessData["modification"])."<br>";
    echo " Idade = ".round($sessData["age"]/3600/24,1)." days<br>";
 }

?>