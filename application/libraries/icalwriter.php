<?php
// Classes, to export data in the iCalender-Format
// The classes work together. Class iCalender is the base-class, that generates the calender.
// Class iCalEvent is a single Event
//
// Other items might be added later
// 
// See webpage: http://www.sebastiankleine.de/iCalWriter/
// or the sourceforge.net project page: http://sourceforge.net/projects/phpicalwriter

// Copyright 2008 by Sebastian Kleine

// This file is part of PHP iCalWriter.

//    PHP iCalWriter is free software: you can redistribute it and/or modify
//    it under the terms of the GNU Lesser General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    PHP iCalWriter is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU Lesser General Public License for more details.
//
//    You should have received a copy of the GNU Lesser General Public License
//    along with PHP iCalWriter.  If not, see <http://www.gnu.org/licenses/>.

// Load the iCalEvent-class
require_once("event.php");
// Load the iCalAlarm-class
require_once("alarm.php");
// Load the iCalRecurrence-class
require_once("recurrence.php");

class iCalWriter
{
	// Define all used variables
	var $iCalMethod; 		// Which Method to use
	var $iCalVersion; 		// Which Version
	var $outputMethod; 		// Output-Method:
							// "html" for HTML-Output; meant for test-purpose only
							// "file" for writing to a file in the server-file-system
							// "download" for direct download
	var $outputStarted;		// did output already start?
	var $version;			// which version of iCalWriter is used
	var $iCalCalScale;		// CALSCALE-value
	var $fileName;			// if outputMethod is "file", in which file to write the output
	var $file;				// the file-handle used
	var $replSpecialChars;	// Replace special chars like german umlaute
	
	// Constructor
	// Initialise basic values
	function iCalWriter()
	{
		$this->iCalMethod = "PUBLISH"; // set standard-method to PUBLISH
		$this->iCalVersion = "2.0"; // set standard-version
		$this->outputMethod = "html"; // set outputMethod to HTML
		$this->outputStarted = 0; // Output did not start
		$this->version = "0.8.1";	// iCalWriter-Version
		$this->iCalCalScale = "GREGORIAN";	// set standard CALSCALE
		$this->replSpecialChars = 0;
	}
	
	// Starts Output of iCalender
	// Depending on $outputMethod starts writing to the defined destination
	function start()
	{
		if ($this->outputStarted == 0)
		{
			$result = true;
			$iCalPRODID = "-//iCalWriter OpenSource Project//iCalWriter ".$this->version."//EN";
			
			if ($this->outputMethod == "file")
			{
				// open a file
				if (strlen($this->fileName)>0)
				{
					@$this->file = fopen($this->fileName, "w");
					if ($this->file == false)
					{
						$result = false;
					}
					else
					{
						// Write beginning to file
						fwrite($this->file, "BEGIN:VCALENDAR\r\n");
						fwrite($this->file, "CALSCALE:".$this->iCalCalScale."\r\n");
						fwrite($this->file, "METHOD:".$this->iCalMethod."\r\n");
						fwrite($this->file, "VERSION:".$this->iCalVersion."\r\n");
						fwrite($this->file, "PRODID:".$iCalPRODID."\r\n");
						$this->outputStarted = 1;
					}
				}
				else
				{
					$result = false;
				}
			}
			elseif ($this->outputMethod == "download")
			{
				// set headers for downloading
				header("Content-Type: application/octetstream");
				header("Content-Disposition: attachment; filename=".basename($this->fileName));
				header("Content-Transfer-Encoding: binary");
				header("Cache-Control: post-check=0, pre-check=0");
				
				// Beginn ausgeben
				echo("BEGIN:VCALENDAR\r\n");
				echo("CALSCALE:".$this->iCalCalScale."\r\n");
				echo("METHOD:".$this->iCalMethod."\r\n");
				echo("VERSION:".$this->iCalVersion."\r\n");
				echo("PRODID:".$iCalPRODID."\r\n");
				$this->outputStarted = 1;
			}
			elseif ($this->outputMethod == "html")
			{
				// Beginn ausgeben
				echo("BEGIN:VCALENDAR<br />");
				echo("CALSCALE:".$this->iCalCalScale."<br />");
				echo("METHOD:".$this->iCalMethod."<br />");
				echo("VERSION:".$this->iCalVersion."<br />");
				echo("PRODID:".$iCalPRODID."<br />");
				$this->outputStarted = 1;
			}

			return $result;
		}
		else
			return false;
	}
	
	// Ends Output of iCalender
	// Depending on $outputMethod ends the writing to the defined destination
	function end()
	{
		if ($this->outputStarted == 1)
		{
			if ($this->outputMethod == "file")
			{
				// close the file
				fwrite($this->file, "END:VCALENDAR\r\n");
				@fclose($this->file);
			}
			elseif ($this->outputMethod == "download")
			{
				// Ende ausgeben
				echo("END:VCALENDAR\r\n");
			}
			elseif ($this->outputMethod == "html")
			{
				// Ende ausgeben
				echo("END:VCALENDAR<br />");
			}
		
			$this->outputStarted = 0;
			return true;
		}
		else
			return false;
	}
	
	// Writes a specific item to the output-Destination
	// It calls the output-Method of the item
	// Depending of outputMethod it might need to translate a few things (line-breaks, ...)
	// Then the output of the item is written to the destination
	function add($item)
	{
		// Only output, if it already started
		if ($this->outputStarted == 1)
		{
			$erg = $item->output();
			
			// replace special chars if wanted
			// some programs don't seem to be able to read the file, if it includes special chars
			if ($this->replSpecialChars)
			{
				$erg = str_replace ("ä", "ae", $erg );
				$erg = str_replace ("ö", "oe", $erg );
				$erg = str_replace ("ü", "ue", $erg );
				$erg = str_replace ("Ä", "Ae", $erg );
				$erg = str_replace ("Ö", "Oe", $erg );
				$erg = str_replace ("Ü", "Ue", $erg );
				$erg = str_replace ("ß", "ss", $erg );
			}
			if ($this->outputMethod == "html")
			{
				// HTML-Output
				$erg = nl2br($erg);
				$erg = html_entity_decode($erg);
				echo($erg);
			}
			elseif ($this->outputMethod == "file")
			{
				// Write to file
				@fwrite($this->file, utf8_encode($erg));
			}
			elseif ($this->outputMethod == "download")
			{
				// Send as download
				echo($erg);
			}
			return true;
		}
		else
			return false; 
	}
	
	// Which outputMethod is currently used
	function getOutputMethod()
	{
		return $this->outputMethod;
	}
	
	// Did output start
	function isOutputStarted()
	{
		return $this->outputStarted;
	}
	
	// Set HTML output
	// Only if output is not started
	function setHTMLOutput()
	{
		if ($this->outputStarted == 0)
		{
			$this->outputMethod = "html";
			return true;
		}
		else
			return false;
	}

	// Set File output
	// Only if output is not started
	function setFileOutput()
	{
		if ($this->outputStarted == 0)
		{
			$this->outputMethod = "file";
			return true;
		}
		else
			return false;
	}

	// Set Download output
	// Only if output is not started
	function setDownloadOutput()
	{
		if ($this->outputStarted == 0)
		{
			$this->outputMethod = "download";
			return true;
		}
		else
			return false;
	}
	
	// Set iCalMethod
	function setiCalMethod($method)
	{
		if ($this->outputStarted == 0)
		{
			$this->iCalMethod = $method;
			return true;
		}
		else
			return false;
	}
	// Get iCalMethod
	function getiCalMethod()
	{
		return $this->iCalMethod;
	}

	// Set iCalVersion
	// $version must be a string
	function setiCalVersion($version)
	{
		if ($this->outputStarted == 0)
		{
			$this->iCalVersion = $version;
			return true;
		}
		else
			return false;
	}
	// Get iCalVersion
	function getiCalVersion()
	{
		return $this->iCalVersion;
	}

	// Set iCalCalScale
	function setiCalCalScale($scale)
	{
		if ($this->outputStarted == 0)
		{
			$this->iCalCalScale = $scale;
			return true;
		}
		else
			return false;
	}
	// Get iCalCalScale
	function getiCalCalScale()
	{
		return $this->iCalCalScale;
	}

	
	// Get iCalWriter-Version
	function getVersion()
	{
		return $this->version;
	}
	
	// Set fileName
	function setFileName($file)
	{
		if ($this->outputStarted == 0)
		{
			$this->fileName = $file;
			return true;
		}
		else
			return false;
	}
	
	// Should special chars be replaced
	// Value could be 0/false for no or 1/true for yes
	function replaceSpecialChars($value)
	{
		$this->replSpecialChars = $value;
	}
}

?>
