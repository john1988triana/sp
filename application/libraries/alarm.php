<?php
// This file includes the alarm-classes for PHPiCalWriter
// Use this classes, to add alarms to events and to-do items
//
// The base class is iCalAlarm. This class should never be used.
// Instead use the classes iCalAudioAlarm, iCalDisplayAlarm, iCalEmailAlarm or iCalProcedureAlarm which inherit iCalAlarm.
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

// The base alarm class - NEVER USE DIRECTLY
// Includes features, that are common to all alarm-objects
// Never use this class directly, instead use one of its children
class iCalAlarm
{
	// These properties are common to all alarm-objects
	var $action;			// type of alarm, must be set by the child
	var $trigger;			// when should the alarm be triggered
	var $duration;			// delay period after which the alarm should be triggered again
	var $repeat;			// how many times should the alarm be repeated (this does not include the initial alarm)
	var $xProp;				// Non standard properties	
	var $additional;		// Additional properties that must conform to the RFC 2445
	var $version;			// Version of iCalAlarm-child-class, must be set by the child
	
	// constructor
	// sets basic stuff
	function iCalAlarm()
	{
		
	}
	
	// returns the resulting output in iCalender-Format
	// Every child needs to inherit this funtion and calls the parent-class with specific output
	// given in the $sOutput-parameter
	function output($sOutput)
	{
		$myOutput = "BEGIN:VALARM\r\n";
		
		$myOutput .= $this->action."\r\n";
		$myOutput .= $this->trigger."\r\n";
		if (!empty($this->duration))
			$myOutput .= $this->duration."\r\n";
		if (!empty($this->repeat))
			$myOutput .= $this->repeat."\r\n";
		if (!empty($this->xProp))
			$myOutput .= $this->xProp."\r\n";
		if (!empty($this->additional))
			$myOutput .= $this->additional."\r\n";
		$myOutput .= $sOutput;
		$myOutput .= "END:VALARM\r\n";
		
		return $myOutput;	
	}
	
	// clears all values, so the object could be reused
	// each child needs to override this
	// when this method is invoked in a child it needs to call the parants clear() method
	function clear()
	{
		$this->xProp = "";
		$this->additional = "";
		// $this->action = "";    // do not change action
		$this->trigger = "";
		$this->duration = "";
		$this->repeat = "";
	}
	
	// Get iCalAlarm-Version
	function getVersion()
	{
		return $this->version;
	}

	// adds a non standard property (x-prop)
	// each alarm can have multiple x-props
	// use clearxProp() to remove all non standard properties
	// $name gives the name of the x-prop. A "X-" will be added at the beginning of the name!
	// $text gives the text for the x-prop
	// $parameter is optional and gives additional parameters 
	function addxProp($name, $text, $parameter = "")
	{
		$newProp = "X-".$name;
		if ($parameter == "")
			$newProp .= ":".$text;
		else
			$newProp .= ";".$parameter.":".$text;
		if (empty($this->xProp))
		{
			$this->xProp = $newProp;
		} 
		else
		{
			$this->xProp = $this->xProp . "\r\n" . $newProp;
		}
	}
	
	// removes all non standard properties (x-props)
	function clearxProp()
	{
		$this->xProp = "";	
	} 

	// adds additional properties - use ONLY, if you know what you are doing!
	// each alarm can have multiple of them
	// use clearAdditional() to remove all of them
	// lines must give one line that conformes to RFC 2445 (one property)
	// Use this to use features of RFC 2445 that are not yet implemented or
	// not implemented for reasons of easy using. 
	function addAdditional($line)
	{
		if (empty($this->additional))
		{
			$this->additional = $line;
		} 
		else
		{
			$this->additional = $this->additional . "\r\n" . $line;
		}
	}
	
	// removes all additional properties
	function clearAdditional()
	{
		$this->additional = "";	
	}
	
	// sets the trigger (when the alarm should start) to a defined date and time
	// $year, $month, $day, $hour, $minute and $second must be 2-digit string values (except year, which must have 4 digits)
	// $isUTC - is this date in UTC-time? 	0 for no
	//										1 for yes 
	function setAlarmDateTime($year, $month, $day, $hour, $minute, $second, $isUTC)
	{
		$this->trigger = "TRIGGER;VALUE=DATE-TIME:".$year.$month.$day."T".$hour.$minute.$second;
		if ($isUTC == 1)
		{
			$this->trigger .= "Z";
		}
	}
	
	// sets the alarm to sound a certain amount of days, minutes or hours 
	// BEFORE the start of the corresponding object (a start-value must be given there)
	// give ONLY ONE of the tree values (as a number) and set the other two to zero
	// example: setAlarmBeforeStart(0, 0, 15); - sets alarm 15 minutes before the start
	function setAlarmBeforeStart($day, $hour, $minute)
	{
		if ($day > 0)
		{
			$this->trigger = "TRIGGER:-P".$day."D";
		}
		elseif ($hour > 0)
		{
			$this->trigger = "TRIGGER:-PT".$hour."H";
		}
		elseif ($minute > 0)
		{
			$this->trigger = "TRIGGER:-PT".$minute."M";
		}
	}

	// sets the alarm to sound a certain amount of days, minutes or hours 
	// AFTER the start of the corresponding object (a start-value must be given there)
	// give ONLY ONE of the tree values (as a number) and set the other two to zero
	// example: setAlarmAfterStart(0, 0, 15); - sets alarm 15 minutes after the start
	function setAlarmAfterStart($day, $hour, $minute)
	{
		if ($day > 0)
		{
			$this->trigger = "TRIGGER:P".$day."D";
		}
		elseif ($hour > 0)
		{
			$this->trigger = "TRIGGER:PT".$hour."H";
		}
		elseif ($minute > 0)
		{
			$this->trigger = "TRIGGER:PT".$minute."M";
		}
	}

	// sets the alarm to sound a certain amount of days, minutes or hours 
	// BEFORE the end of the corresponding object (a end-value (or start and duration) must be given there)
	// give ONLY ONE of the tree values (as a number) and set the other two to zero
	// example: setAlarmBeforeEnd(0, 0, 15); - sets alarm 15 minutes before the end
	function setAlarmBeforeEnd($day, $hour, $minute)
	{
		if ($day > 0)
		{
			$this->trigger = "TRIGGER;RELATED=END:-P".$day."D";
		}
		elseif ($hour > 0)
		{
			$this->trigger = "TRIGGER;RELATED=END:-PT".$hour."H";
		}
		elseif ($minute > 0)
		{
			$this->trigger = "TRIGGER;RELATED=END:-PT".$minute."M";
		}
	}
	 	
	// sets the alarm to sound a certain amount of days, minutes or hours 
	// AFTER the end of the corresponding object (a end-value (or start and duration) must be given there)
	// give ONLY ONE of the tree values (as a number) and set the other two to zero
	// example: setAlarmAfterEnd(0, 0, 15); - sets alarm 15 minutes after the end
	function setAlarmAfterEnd($day, $hour, $minute)
	{
		if ($day > 0)
		{
			$this->trigger = "TRIGGER;RELATED=END:P".$day."D";
		}
		elseif ($hour > 0)
		{
			$this->trigger = "TRIGGER;RELATED=END:PT".$hour."H";
		}
		elseif ($minute > 0)
		{
			$this->trigger = "TRIGGER;RELATED=END:PT".$minute."M";
		}
	}

	// sets the alarm to be repeated after the initial trigger
	// all values are numbers
	// $number is the number of times the alarm should be triggered again (excluding the initial trigger)
	// $day, $minute and $hour gives the time delay between triggering
	// use only one value of the three and set the others to zero
	// example: setAlarmRepeat(3, 0, 1, 0); - alarm is repeated 3 times with a one hour delay
	function setAlarmRepeat($number, $day, $hour, $minute)
	{
		$this->repeat = "REPEAT:".$number;
		if ($day > 0)
		{
			$this->duration = "DURATION:P".$day."D";
		}
		elseif ($hour > 0)
		{
			$this->duration = "DURATION:PT".$hour."H";
		}
		elseif ($minute > 0)
		{
			$this->duration = "DURATION:PT".$minute."M";
		}
		
	}
}



// an audio alarm
// use this, if the alarm should play a sound-file
// it can not be garanteed, that the sound will be played
class iCalAudioAlarm extends iCalAlarm
{

	var $attach;		// where is the audio-file to play
						// there is no guarantee that it will be played

	// constructor
	// sets initial things
	function iCalAudioAlarm()
	{
		$this->version = "0.8";
		$this->action = "ACTION:AUDIO";
	}
	
	// output
	// overrides the parent output method to add additional things
	function output()
	{
		$myOutput = "";
		// Add additional output here
		if (!empty($this->attach))
			$myOutput .= $this->attach."\r\n";
		return parent::output($myOutput);
	}
	
	// clear all
	// overrides the parent clear method to add additional things
	function clear()
	{
		$this->attach = "";
		parent::clear();
	}
	
	// set the file to play
	// this MUST be set!
	// there is no guarantee, that it will be played!
	// $file should give the path (or URL) to the audio-file
	function setAudioFile($file)
	{
		$this->attach = "ATTACH:".$file;
	}
}

// this alarm will display some text
class iCalDisplayAlarm extends iCalAlarm
{

	var $description;		// text to display
	
	// constructor
	// sets initial things
	function iCalDisplayAlarm()
	{
		$this->version = "0.8";
		$this->action = "ACTION:DISPLAY";
	}
	
	// output
	// overrides the parent output method to add additional things
	function output()
	{
		$myOutput = "";
		// Add additional output here
		if (!empty($this->description))
			$myOutput .= $this->description."\r\n";
		
		return parent::output($myOutput);
	}
	
	// clear all
	// overrides the parent clear method to add additional things
	function clear()
	{
		$this->description = "";
		parent::clear();
	}
	
	// set text to display
	// this MUST be set!
	function setText($text)
	{
		$this->description = "DESCRIPTION:".$text;
	}
}

// send an email when the alarm rings
class iCalEmailAlarm extends iCalAlarm
{
	var $attach;				// attachements to send with the email
	var $description;			// body text for the email
	var $summary;				// the subject for the email
	var	$attendee;				// receiver(s) for the email

	// constructor
	// sets initial things
	function iCalEmailAlarm()
	{
		$this->version = "0.8";
		$this->action = "ACTION:EMAIL";
	}
	
	// output
	// overrides the parent output method to add additional things
	function output()
	{
		$myOutput = "";
		// Add additional output here
		if (!empty($this->attach))
			$myOutput .= $this->attach."\r\n";
		if (!empty($this->description))
			$myOutput .= $this->description."\r\n";
		if (!empty($this->summary))
			$myOutput .= $this->summary."\r\n";
		if (!empty($this->attendee))
			$myOutput .= $this->attendee."\r\n";
		
		return parent::output($myOutput);
	}
	
	// clear all
	// overrides the parent clear method to add additional things
	function clear()
	{
		$this->attach = "";
		$this->description = "";
		$this->attendee = "";
		$this->summary = "";
		parent::clear();
	}
	
	// sets body-text and subject for the email
	// this MUST be set!
	function setText($text, $subject)
	{
		$this->description = "DESCRIPTION:".$text;
		$this->summary = "SUMMARY:".$subject;
	}
	
	// adds a receiver
	// there must be at least one receiver (or else no email could be sent)
	function addEmailAddress($email)
	{
		if (empty($this->attendee))
		{
			$this->attendee = "ATTENDEE:MAILTO:".$email;
		}
		else
		{
			$this->attendee .= "\r\nATTENDEE:MAILTO:".$email;
		}
	}
	
	// removes all email adresses
	function clearEmailAddresses()
	{
		$this->attendee = "";
	}
	
	// adds an attachment 
	// this is optional, there might be more than one
	// they should be send as attechments of the email
	// please give the path or URL to a file
	function addAttachment($file)
	{
		if (empty($this->attach))
		{
			$this->attach = "ATTACH:".$file;
		}
		else
		{
			$this->attach .= "\r\nATTACH:".$file;
		}
	}
	
	// removes all attachments
	function clearAttachments()
	{
		$this->attach = "";
	}
}

// do something, when the alarm goes off
class iCalProcedureAlarm extends iCalAlarm
{
	var $attach;				// Procedure or program to start
	var $description;			// parameters for the procedure or program

	// constructor
	// sets initial things
	function iCalProcedureAlarm()
	{
		$this->version = "0.8";
		$this->action = "ACTION:PROCEDURE";
	}
	
	// output
	// overrides the parent output method to add additional things
	function output()
	{
		$myOutput = "";
		// Add additional output here
		if (!empty($this->attach))
			$myOutput .= $this->attach."\r\n";
		if (!empty($this->description))
			$myOutput .= $this->description."\r\n";
		
		return parent::output($myOutput);
	}
	
	// clear all
	// overrides the parent clear method to add additional things
	function clear()
	{
		$this->attach = "";
		$this->description = "";
		parent::clear();
	}
	
	// set the procedure to start
	// this MUST be set!
	// there is no guarantee, that it will be started (might not be accessible)
	// $file should give the path (or URL) to the procedure or program
	// $parameters are optional parameters for $file
	function setProcedure($file, $parameters="")
	{
		$this->attach = "ATTACH:".$file;
		if (!empty($parameters))
			$this->description = "DESCRIPTION:".$parameters;
	}
	
	
}
?>
