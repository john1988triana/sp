<?php
// Class iCalEvent is a single event for the iCalWriter-Class
// Method output is used by iCalWriter to get the output
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


class iCalEvent
{

	var $start;			// Start of the event, as a string
	var $end;			// End of the event, as string
	var $duration;		// Duration of event, as string
						// There must not be end and duration at the same time
	var $summary;		// Provides a short description
	var $description;	// Provides a long description
	var $dtStamp;		// Provides the DTSTAMP (normally the creation-time of the event)
	var $version;		// Version of iCalEvent
	var $uid;			// Uniquie identifier
	var $comment;		// Comment for the event
	var $categories;	// Categories
	var $location;		// Location of the event
	var $status;		// Status of the event
						// 0 = not defined (will not be published)
						// 1 = tentative; 2 = confirmed; 3 = cancelled
	var $url;			// gives a URL for the event
	var $contact;		// Contact-information
	var $classification;	// access classification
	var $created;		// creation-date of event 
	var $geo;			// geo-coordinates
	var $lastMod;		// last modifified
	var $organizer;		// organizer of the event
	var $priority;		// priority of the event (0 to 9 where 9 is highest)
	var $sequence;		// the revision number of the event
	var $transparency;	// is the event transparent or not for busy time searches
	var $attachment;	// Attachments for this event
	var $attendee;		// Attendees for the event
	var $requestStatus; // Request-Status for the event
	var $related;		// This event is related to ...
	var $resources;		// Required resources
	var $xProp;			// Non standard properties
	var $additional;	// Additional properties that must conform to the RFC 2445
	var $alarm;			// contains alarm-code
	var $recurrence;	// contains recurrences


	// generates a random id of a given length
	function genRandomId($length)
	{
		
		$items = "abcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$newName="";
		mt_srand ((double) microtime()*1000000);
		for ($i=0; $i<$length; $i++)
		{
			$newName .= $items{mt_rand(0,strlen($items))};
		}
		
		return $newName;
		
	}

	// Initialize some things
	function iCalEvent()
	{
		$this->version = "0.8.1";
	
		// set dtStamp to now in UTC, this is, because this values must be given!
		$this->dtStamp="DTSTAMP:".gmdate("Ymd")."T".gmdate("His")."Z";
		
		// set uid, because this value must be given
		// it is set to a combination of timestamp + random id and host
		$this->uid = "UID:".time().$this->genRandomId(4)."@".$_SERVER['SERVER_NAME'];
		
		// status is set to not-defined
		$this->status = 0;
	}
	
	// returns the resulting output in iCalender-Format
	function output()
	{
		$myOutput = "BEGIN:VEVENT\r\n";
		
		$myOutput .= $this->dtStamp."\r\n";
		$myOutput .= $this->uid."\r\n";
		if (!empty($this->start))
			$myOutput .= $this->start."\r\n";
		if (!empty($this->end))
			$myOutput .= $this->end."\r\n";
		elseif (!empty($this->duration))
			$myOutput .= $this->duration."\r\n";
		if (!empty($this->summary))
			$myOutput .= $this->summary."\r\n";
		if (!empty($this->description))
			$myOutput .= $this->description."\r\n";
		if (!empty($this->comment))
			$myOutput .= $this->comment."\r\n";
		if (!empty($this->categories))
			$myOutput .= $this->categories."\r\n";
		if (!empty($this->location))
			$myOutput .= $this->location."\r\n";
		switch ($this->status) 
		{
			case 1:
					$myOutput .= "STATUS:TENTATIVE\r\n";
					break;
			case 2:
					$myOutput .= "STATUS:CONFIRMED\r\n";
					break;
			case 3:
					$myOutput .= "STATUS:CANCELLED\r\n";
					break;
		}
		if (!empty($this->url))
			$myOutput .= $this->url."\r\n";
		if (!empty($this->contact))
			$myOutput .= $this->contact."\r\n";
		if (!empty($this->classification))
			$myOutput .= $this->classification."\r\n";
		if (!empty($this->created))
			$myOutput .= $this->created."\r\n";
		if (!empty($this->geo))
			$myOutput .= $this->geo."\r\n";
		if (!empty($this->lastMod))
			$myOutput .= $this->lastMod."\r\n";
		if (!empty($this->organizer))
			$myOutput .= $this->organizer."\r\n";
		if (!empty($this->priority))
			$myOutput .= $this->priority."\r\n";
		if (!empty($this->sequence))
			$myOutput .= $this->sequence."\r\n";
		if (!empty($this->transparency))
			$myOutput .= $this->transparency."\r\n";
		if (!empty($this->attachment))
			$myOutput .= $this->attachment."\r\n";
		if (!empty($this->attendee))
			$myOutput .= $this->attendee."\r\n";
		if (!empty($this->requestStatus))
			$myOutput .= $this->requestStatus."\r\n";
		if (!empty($this->related))
			$myOutput .= $this->related."\r\n";
		if (!empty($this->resources))
			$myOutput .= $this->resources."\r\n";
		if (!empty($this->xProp))
			$myOutput .= $this->xProp."\r\n";
		if (!empty($this->additional))
			$myOutput .= $this->additional."\r\n";
		if (!empty($this->alarm))
			$myOutput .= $this->alarm;
		if (!empty($this->recurrence))
			$myOutput .= $this->recurrence;
			
		$myOutput .= "END:VEVENT\r\n";
		
		return $myOutput;	
	}
	
	// clears all values, so the object could be reused
	function clear()
	{
		$this->start = "";
		$this->end = "";
		$this->duration = "";
		$this->summary = "";
		$this->description = "";
		$this->dtStamp="DTSTAMP:".gmdate("Ymd")."T".gmdate("His")."Z";
		$this->uid = "UID:".time().$this->genRandomId(4)."@".$_SERVER['SERVER_NAME'];
		$this->comment = "";
		$this->categories = "";
		$this->location = "";
		$this->status = 0;
		$this->url = "";
		$this->contact = "";
		$this->classification = "";
		$this->created = "";
		$this->geo = "";
		$this->lastMod = "";
		$this->organizer = "";
		$this->priority = "";
		$this->sequence = "";
		$this->transparency = "";
		$this->attachment = "";
		$this->attendee = "";
		$this->requestStatus = "";
		$this->related = "";
		$this->resources = "";
		$this->xProp = "";
		$this->additional = "";
		$this->alarm = "";
		$this->recurrence = "";
	}
	
	// Get iCalEvent-Version
	function getVersion()
	{
		return $this->version;
	}
	
	// sets the start of the event
	// year, month and day must be given
	// other things can be added and have the following meaning:
		// isUTC		is the date/datetime UTC				0 for no, 1 for yes
		// isLocalTime	is the date/datetime in local time		0 for no, 1 for yes
		// Never have isUTC=1 and isLocalTime=1 at the same time!
		// localTimeZone gives the string-value for the local timezone, see http://twiki.org/cgi-bin/xtra/tzdatepick.html
		// useTime		use the time-information				0 for no, 1 for yes
		// hour, minute and second should be self-explanatory
	function setStart($year, $month, $day, $isUTC=1, $isLocalTime=0, $localTimeZone="", $useTime=0, $hour="00", $minute="00", $second="00")
	{
		$startString = "DTSTART";
		
		// If using localTime and a localTimeZone is set
		if ($isLocalTime == 1 and strlen($localTimeZone)>0)
			$startString .= ";TZID=".$localTimeZone.":";
		else
			$startString .= ":";
		
		// Add date
		$startString .= $year . $month . $day;
		
		// if we should use the time, then do it
		if ($useTime == 1)
			$startString .= "T".$hour.$minute.$second;
			
		// if utc-time and not localTime
		if ($isUTC == 1 and $isLocalTime == 0)
		{
			$startString .= "Z";
		}
		
		$this->start =  $startString;
	}

	// sets the end of the event
	// same arguments as the setStart function
	// never use end and duration at the same time
	function setEnd($year, $month, $day, $isUTC=0, $isLocalTime=1, $localTimeZone="", $useTime=0, $hour="00", $minute="00", $second="00")
	{
		$startString = "DTEND";
		
		// If using localTime and a localTimeZone is set
		if ($isLocalTime == 1 and strlen($localTimeZone)>0)
			$startString .= ";TZID=".$localTimeZone.":";
		else
			$startString .= ":";
		
		// Add date
		$startString .= $year . $month . $day;
		
		// if we should use the time, then do it
		if ($useTime == 1)
			$startString .= "T".$hour.$minute.$second;
			
		// if utc-time and not localTime
		if ($isUTC == 1 and $isLocalTime == 0)
		{
			$startString .= "Z";
		}
		
		$this->end =  $startString;
	}


	// sets the duration
	// never use end and duration at the same time
	function setDuration($week=0, $day = 0, $hour = 0, $minute =0, $second=0)
	{
		$durationString = "DURATION:P";
		
		if ($week > 0)
			$durationString .= $week."W";
		if ($day > 0)
			$durationString .= $day."D";
		if ($hour > 0 or $minute > 0 or $second > 0)
		{
			$durationString .= "T".$hour."H".$minute."M".$second."S";
		}
		
		$this->duration = $durationString;
	}
	
	// sets short description (summary)
	function setShortDescription($text)
	{
		$this->summary = "SUMMARY:".$text;
	}	
	
	// sets long description 
	function setLongDescription($text)
	{
		$this->description = "DESCRIPTION:".$text;
	}
	
	// sets the DTSTAMP-value
	// this value must exists in all event-objects
	// for this reason it is initialysed in the constructor with the current date and time
	// this value must be in UTC!
	// all parameters must be given as a string, representing UTC-time (i.e. gmdate() )
	function setDtStamp($year, $month, $day, $hour, $minute, $second)
	{
		$this->dtStamp = "DTSTAMP:".$year.$month.$day."T".$hour.$minute.$second."Z";
	}	

	// sets the UID-value
	// this value must exist in all event-objects and it must globally unique!
	// it will be pre-set in the constructor
	// if you want to set it here, you have to care about creating a globally uniquie uid yourself
	// a good advice is to add the host this script is running and either a timestamp or a unique id from the database
	function setUID($newUID)
	{
		$this->uid = "UID:".$newUID;
	}

	// sets location
	// Location could contain any text, that describes the location
	// the 2nd (optional) parameter gives an URI to either an LDAP server entry or a vCard
	function setLocation($text, $alternate="")
	{
		 $newLocation = "LOCATION";
		if ($alternate == "")
			$newLocation .= ":";
		else
			$newLocation .= ';ALTREP="'.$alternate.'":';
		$this->comment = $newLocation.$text;
	}
	
	// sets the status of the event
	// $neuerStatus must be a string - the following values are possible:
	// none - no status set
	// tentative
	// confirmed
	// cancelled
	function setStatus($neuerStatus)
	{
		$status = strtolower($neuerStatus);
		switch ($status)
		{
			case "none" :
					$this->status = 0;
					break;
			case "tentative" :
					$this->status = 1;
					break;
			case "confirmed" :
					$this->status = 2;
					break;
			case "cancelled" :
					$this->status = 3;
					break;
			default :
					$this->status = 0;
					break;
		}
	}

	// sets URL
	// please include the scheme of the URL (i.e. http://)
	function setURL($text)
	{
		$this->url = "URL:".$text;
	}


	// sets access classification
	// this is no way to enforce access-restrictions!
	function setClassification($text)
	{
		$this->classification = "CLASS:".$text;
	}
	
	// sets creation date/time
	// this value must be in UTC!
	// all parameters must be given as a string, representing UTC-time (i.e. gmdate() )
	function setCreated($year, $month, $day, $hour, $minute, $second)
	{
		$this->created = "CREATED:".$year.$month.$day."T".$hour.$minute.$second."Z";
	}
	
	// sets geographic coordinates
	// both values must me float
	function setGeo($lat, $lon)
	{
		$this->geo = "GEO:".$lat.";".$lon;
	}

	// sets last modified date/time
	// this value must be in UTC!
	// all parameters must be given as a string, representing UTC-time (i.e. gmdate() )
	function setLastModified($year, $month, $day, $hour, $minute, $second)
	{
		$this->lastMod = "LAST-MODIFIED:".$year.$month.$day."T".$hour.$minute.$second."Z";
	}

	// sets organizer information
	// might need some more looking into
	function setOrganizer($text)
	{
		$this->organizer = "ORGANIZER:".$text;
	}
	
	// sets priority
	// values are integer ranging from 0 to 9
	// 9 is the highest priority
	function setPriority($value)
	{
		$this->priority = "PRIORITY:".$value;
	}

	// sets sequence (revision number)
	// values are integer starting from 0
	// the user is responsible for setting the sequence-number correctly, if it should be used
	// iCalWriter will not change it on its own
	function setSequence($value)
	{
		$this->sequence = "SEQUENCE:".$value;
	}

	// sets no tranpsarency (opaque)
	function setNoTransparency()
	{
		$this->transparency = "TRANSP:OPAQUE";		
	}
	
	// sets tranpsarency (transparent)
	function setTransparency()
	{
		$this->transparency = "TRANSP:TRANSPARENT";		
	}
	
	// adds an attachment for the event
	// each event can have multiple attachments
	// use clearAttachment() to remove all attachments
	// the parameter should give the URI of the attachement
	// might need some looking into (for additional parameters)
	function addAttachment($text)
	{
		if (empty($this->attachment))
			$this->attachment = "ATTACH:".$text;
		else
			$this->attachment = $this->attachment . "\r\nATTACH:".$text; 
	}
	
	// removes all attachments
	function clearAttachment()
	{
		$this->attachment = "";	
	}
	
	// adds an attendee for the event
	// each event can have multiple attendees
	// use clearAttendee() to remove all attendees
	// might need some looking into (for additional parameters)
	function addAttendee($text)
	{
		if (empty($this->attendee))
			$this->attendee = "ATTENDEE:".$text;
		else
		$this->attendee = $this->attendee . "\r\nATTENDEE:".$text; 
	}
	
	// removes all attendees
	function clearAttendee()
	{
		$this->attendee = "";	
	}

	// adds categorie(s)
	// each event can have multiple categories
	// call this function several times or give a list of comma-seperated categories
	function addCategories($text)
	{
		if (empty($this->categories))
			$this->categories = "CATEGORIES:".$text;
		else
		$this->categories = $this->categories . "\r\nCATEGORIES:".$text; 
	}
	
	// a synonym for addCategories
	function setCategories($text)
	{
		$this->addCategories($text);
	}

	// removes all categories
	function clearCategories()
	{
		$this->categories = "";	
	}


	// adds comment
	// each event can have multiple comments
	function addComment($text)
	{
		if (empty($this->comment))
			$this->comment = "COMMENT:".$text;
		else
		$this->comment = $this->comment. "\r\nCOMMENT:".$text; 
	}

	// synonym for addComment
	function setComment($text)
	{
		$this->addComment($text);
	}

	// removes all comments
	function clearComments()
	{
		$this->comment = "";	
	}

	// adds contact information
	// this could be a name, email-adresse, phone number, ... or a combination seperated by \,
	// the 2nd (optional) parameter gives an URI to either an LDAP server entry or a vCard
	function addContact($text, $alternate="")
	{
		$newContact = "CONTACT";
		if ($alternate == "")
			$newContact .= ":";
		else
			$newContact .= ';ALTREP="'.$alternate.'":';
		if (empty($this->contact))
		{
			$this->contact = $newContact.$text;
		} 
		else
		{
			$this->contact = $this->contact . "\r\n" . $newContact.$text;
		}
	}

	// synonym for addContact
	function setContact($text, $alternate="")
	{
		$this->addContact($text, $alternate);
	}
	
	// removes all contacts
	function clearContacts()
	{
		$this->contact = "";	
	}
	
	// set request status as pending (request has been received
	// and initally processed but completion is pending)
	// description should give a more detailed explanation
	// $status is optional. It could set a more detailed status code
	//
	// Explanation for status:
	// The request status uses a short return status code. For pending this is 1.xx
	// So the main return code is always 1. $status replaces the xx.
	// If no $status is given, 0 is used as default value
	function setRequestStatusPending($description, $status=0)
	{
		$this->requestStatus= "REQUEST-STATUS:1." . $status . ";" . $description;
	}

	// set request status as successful
	// description should give a more detailed explanation
	// $status is optional. It could set a more detailed status code
	//
	// Explanation for status:
	// The request status uses a short return status code. For successful this is 2.xx
	// So the main return code is always 2. $status replaces the xx.
	// If no $status is given, 0 is used as default value
	function setRequestStatusSuccessful($description, $status=0)
	{
		$this->requestStatus = "REQUEST-STATUS:2." . $status . ";" . $description;
	}

	// set request status as client error
	// this means either a syntax or semantic error
	// description should give a more detailed explanation
	// $status is optional. It could set a more detailed status code
	//
	// Explanation for status:
	// The request status uses a short return status code. For client error this is 3.xx
	// So the main return code is always 3. $status replaces the xx.
	// If no $status is given, 0 is used as default value
	function setRequestStatusClientError($description, $status=0)
	{
		$this->requestStatus = "REQUEST-STATUS:3." . $status . ";" . $description;
	}

	// set request status as scheduling error
	// description should give a more detailed explanation
	// $status is optional. It could set a more detailed status code
	//
	// Explanation for status:
	// The request status uses a short return status code. For scheduling error this is 4.xx
	// So the main return code is always 4. $status replaces the xx.
	// If no $status is given, 0 is used as default value
	function setRequestStatusSchedulingError($description, $status=0)
	{
		$this->requestStatus= "REQUEST-STATUS:4." . $status . ";" . $description;
	}
	
	// removes the request status
	function removeRequestStatus()
	{
		$this->requestStatus = "";
	}
	
	// adds an related object
	// each event can have multiple related objects
	// use clearRelated() to remove all related objects
	// the parameter should give the unique id (UID) of the related object
	function addRelated($text)
	{
		if (empty($this->related))
			$this->related = "RELATED-TO:<".$text.">";
		else
			$this->related = $this->related . "\r\nRELATED-TO:<".$text.">"; 
	}
	
	// removes all related objects
	function clearRelated()
	{
		$this->related = "";	
	} 

	// adds a resource
	// each event can have multiple resources
	// either use this functions several times or give a comma seperated list
	// use clearResources() to remove all resources
	function addResource($text)
	{
		if (empty($this->resources))
			$this->resources = "RESOURCES:".$text;
		else
			$this->resources = $this->resources . "\r\nRESOURCES:".$text; 
	}
	
	// removes all resources
	function clearResources()
	{
		$this->resources = "";	
	} 

	// adds a non standard property (x-prop)
	// each event can have multiple x-props
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
	// each event can have multiple of them
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
	
	// adds an alarm to the event
	// each event can have multiple alarms
	// use clearAlarms() to remove all alarm objects
	// the paramter must be the alarm-object
	function addAlarm($alarmObject)
	{
		$erg = $alarmObject->output();
		$this->alarm .= $erg;
	}
	
	// removes all alarms from the event
	function clearAlarm()
	{
		$this->alarm = "";
	} 

	// adds an recurrence to the event
	// each event can have multiple recurrences
	// use clearRecurrence() to remove all recurrence objects
	// the paramter must be the recurrence-object
	function addRecurrence($recurrenceObject)
	{
		$erg = $recurrenceObject->output();
		$this->recurrence .= $erg;
	}
	
	// removes all recurrences from the event
	function clearRecurrence()
	{
		$this->recurrence = "";
	} 

}
?>
