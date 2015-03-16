<?php
// Class iCalRecurrence is a recurrence object for the iCalWriter-Class
// Method output is used by an iCalWriter event (or another iCalWriter-part) to get the output
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


class iCalRecurrence
{
	 var $version;				// iCalRecurrence version
	 
	 var $rDate;				// recurrence date values
	 var $rDateTime;			// recurrence datetime values
	 var $rPeriod;				// recurrence periods
	 
	 var $eDate;				// recurrence exception date values
	 var $eDateTime;			// recurrence exception datetime values
	 
	 var $rRule;				// the basic recurrence rule
	 var $rRuleCount;			// recurrence count
	 var $rRuleUntil;			// recurrence rule until
	 var $rRuleInterval;		// recurrence rule interval
	 var $rRuleWkSt;			// recurrence rule week start
	 var $rRuleByDay;			// recurrence rule by day
	 var $rRuleByMonthDay;		// recurrence rule by month day
	 var $rRuleByYearDay;		// recurrence rule by year day
	 var $rRuleByWeek;			// recurrence rule by week
	 var $rRuleByMonth;			// recurrence rule by month
	 var $rRuleBySetPos;		// recurrence rule by setpos
	 var $rRuleByHour;			// recurrence rule by hour
	 var $rRuleByMinute;		// recurrence rule by minute

	 var $eRule;				// the basic exception rule
	 var $eRuleCount;			// exception count
	 var $eRuleUntil;			// exception rule until
	 var $eRuleInterval;		// exception rule interval
	 var $eRuleWkSt;			// exception rule week start
	 var $eRuleByDay;			// exception rule by day
	 var $eRuleByMonthDay;		// exception rule by month day
	 var $eRuleByYearDay;		// exception rule by year day
	 var $eRuleByWeek;			// exception rule by week
	 var $eRuleByMonth;			// exception rule by month
	 var $eRuleBySetPos;		// exception rule by setpos
	 var $eRuleByHour;			// exception rule by hour
	 var $eRuleByMinute;		// exception rule by minute

	
	// Initialize some things
	function iCalRecurrence()
	{
		$this->version = "0.8.1";
		
	}
	
	// returns the resulting output in iCalender-Format
	function output()
	{
		$myOutput = "";
		
		if (!empty($this->rDate))
			$myOutput .= $this->rDate."\r\n";
		if (!empty($this->rDateTime))
			$myOutput .= $this->rDateTime."\r\n";
		if (!empty($this->rPeriod))
			$myOutput .= $this->rPeriod."\r\n";
		if (!empty($this->eDate))
			$myOutput .= $this->eDate."\r\n";
		if (!empty($this->eDateTime))
			$myOutput .= $this->eDateTime."\r\n";
			
		if (!empty($this->rRule))
		{
			// add recurrence rule
			$temp = $this->rRule;
			if (!empty($this->rRuleCount))
				$temp .= $this->rRuleCount;
			if (!empty($this->rRuleUntil))
				$temp .= $this->rRuleUntil;
			if (!empty($this->rRuleInterval))
				$temp .= $this->rRuleInterval;
			if (!empty($this->rRuleWkSt))
				$temp .= $this->rRuleWkSt;
			if (!empty($this->rRuleByDay))
				$temp .= $this->rRuleByDay;
			if (!empty($this->rRuleByMonthDay))
				$temp .= $this->rRuleByMonthDay;
			if (!empty($this->rRuleByYearDay))
				$temp .= $this->rRuleByYearDay;
			if (!empty($this->rRuleByWeek))
				$temp .= $this->rRuleByWeek;
			if (!empty($this->rRuleByMonth))
				$temp .= $this->rRuleByMonth;
			if (!empty($this->rRuleBySetPos))
				$temp .= $this->rRuleBySetPos;
			if (!empty($this->rRuleByHour))
				$temp .= $this->rRuleByHour;
			if (!empty($this->rRuleByMinute))
				$temp .= $this->rRuleByMinute;
			
			$myOutput .= $temp."\r\n";
		}

		if (!empty($this->eRule))
		{
			// add exception rule
			$temp = $this->eRule;
			if (!empty($this->eRuleCount))
				$temp .= $this->eRuleCount;
			if (!empty($this->eRuleUntil))
				$temp .= $this->eRuleUntil;
			if (!empty($this->eRuleInterval))
				$temp .= $this->eRuleInterval;
			if (!empty($this->eRuleWkSt))
				$temp .= $this->eRuleWkSt;
			if (!empty($this->eRuleByDay))
				$temp .= $this->eRuleByDay;
			if (!empty($this->eRuleByMonthDay))
				$temp .= $this->eRuleByMonthDay;
			if (!empty($this->eRuleByYearDay))
				$temp .= $this->eRuleByYearDay;
			if (!empty($this->eRuleByWeek))
				$temp .= $this->eRuleByWeek;
			if (!empty($this->eRuleByMonth))
				$temp .= $this->eRuleByMonth;
			if (!empty($this->eRuleBySetPos))
				$temp .= $this->eRuleBySetPos;
			if (!empty($this->eRuleByHour))
				$temp .= $this->eRuleByHour;
			if (!empty($this->eRuleByMinute))
				$temp .= $this->eRuleByMinute;
			
			$myOutput .= $temp."\r\n";
		}

		return $myOutput;
	}
	
	// clears all values, so the object could be reused
	function clear()
	{
		$this->rDate = "";
		$this->rDateTime = "";
		$this->rPeriod = "";
		$this->eDate = "";
		$this->eDateTime = "";
		
		$this->rRule = "";
		$this->rRuleCount = "";
		$this->rRuleUntil = "";
		$this->rRuleInterval = "";
		$this->rRuleWkSt = "";
		$this->rRuleByDay = "";
		$this->rRuleByMonthDay = "";
		$this->rRuleByYearDay = "";
		$this->rRuleByWeek = "";
		$this->rRuleByMonth = "";
		$this->rRuleBySetPos = "";
		$this->rRuleByHour = "";
		$this->rRuleByMinute = "";

		$this->eRule = "";
		$this->eRuleCount = "";
		$this->eRuleUntil = "";
		$this->eRuleInterval = "";
		$this->eRuleWkSt = "";
		$this->eRuleByDay = "";
		$this->eRuleByMonthDay = "";
		$this->eRuleByYearDay = "";
		$this->eRuleByWeek = "";
		$this->eRuleByMonth = "";
		$this->eRuleBySetPos = "";
		$this->eRuleByHour = "";
		$this->eRuleByMinute = "";
	}
	
	// Get iCalRecurrence-Version
	function getVersion()
	{
		return $this->version;
	}
	
	
	// adds date-value to the recurrence
	// year must be a 4 digit string
	// month and day must be 2 digit strings
	function addDate($year, $month, $day)
	{
		if (empty($this->rDate))
			$this->rDate = "RDATE;VALUE=DATE:".$year.$month.$day;
		else
			$this->rDate .= ",".$year.$month.$day;
	}
	
	// removes all recurrence dates
	function clearDates()
	{
		$this->rDate = "";
	}

	// adds date-time-value to the recurrence
	// year must be a 4 digit string
	// month, day, hour, minute, second must be 2 digit strings
	// if the time is UTC then set isUTC to 1, otherwise set isUTC to 0
	function addDateTime($year, $month, $day, $hour, $minute, $second, $isUTC=0)
	{
		if (empty($this->rDateTime))
		{
			$this->rDateTime = "RDATE:".$year.$month.$day."T".$hour.$minute.$second;
			if ($isUTC == 1)
				$this->rDateTime .= "Z";
		}
		else
		{
			$this->rDate .= ",".$year.$month.$day."T".$hour.$minute.$second;
			if ($isUTC == 1)
				$this->rDateTime .= "Z";
		}
	}
	
	// removes all recurrence date-times
	function clearDateTimes()
	{
		$this->rDateTime = "";
	}

	// adds period to the recurrence by giving a start and end date-time
	// year must be a 4 digit string
	// month, day, hour, minute, second must be 2 digit strings
	// start-values must give a time before the end-values
	// if the time is UTC then set isUTC to 1, otherwise set isUTC to 0
	function addPeriod($startyear, $startmonth, $startday, $starthour, $startminute, $startsecond, $endyear, $endmonth, $endday, $endhour, $endminute, $endsecond, $isUTC=0)
	{
		if (empty($this->rPeriod))
		{
			$this->rPeriod = "RDATE;VALUE=PERIOD:".$startyear.$startmonth.$startday."T".$starthour.$startminute.$startsecond;
			if ($isUTC == 1)
				$this->rPeriod .= "Z";
			$this->rPeriod .= "/".$startyear.$startmonth.$startday."T".$starthour.$startminute.$startsecond;
			if ($isUTC == 1)
				$this->rPeriod .= "Z";
		}
		else
		{
			$this->rPeriod .= ",".$startyear.$startmonth.$startday."T".$starthour.$startminute.$startsecond;
			if ($isUTC == 1)
				$this->rPeriod .= "Z";
			$this->rPeriod .= "/".$startyear.$startmonth.$startday."T".$starthour.$startminute.$startsecond;
			if ($isUTC == 1)
				$this->rPeriod .= "Z";
		}
	}
	
	// adds period to the recurrence by giving a start and a duration
	// year must be a 4 digit string
	// month, day, hour, minute, second must be 2 digit strings
	// weeks, days, hours, minutes must give the duration as integer
	// if the time is UTC then set isUTC to 1, otherwise set isUTC to 0
	function addPeriodDuration($startyear, $startmonth, $startday, $starthour, $startminute, $startsecond, $weeks, $days, $hours, $minutes, $isUTC = 0)
	{
		if (empty($this->rPeriod))
		{
			$this->rPeriod = "RDATE;VALUE=PERIOD:".$startyear.$startmonth.$startday."T".$starthour.$startminute.$startsecond;
			if ($isUTC == 1)
				$this->rPeriod .= "Z";
			$this->rPeriod .= "/P";
			if ($weeks > 0)
				$this->rPeriod .= $weeks;
			if ($days > 0)
				$this->rPeriod .= $days;
			if ($hours>0 or $minutes>0)
			{
				$this->rPeriod .= "T";
				if ($hours>0)
					$this->rPeriod .= $hours."H";
				if ($minutes>0)
					$this->rPeriod .= $minutes."M";
			}
			
		}
		else
		{
			$this->rPeriod .= ",".$startyear.$startmonth.$startday."T".$starthour.$startminute.$startsecond;
			if ($isUTC == 1)
				$this->rPeriod .= "Z";
			$this->rPeriod .= "/P";
			if ($weeks > 0)
				$this->rPeriod .= $weeks;
			if ($days > 0)
				$this->rPeriod .= $days;
			if ($hours>0 or $minutes>0)
			{
				$this->rPeriod .= "T";
				if ($hours>0)
					$this->rPeriod .= $hours."H";
				if ($minutes>0)
					$this->rPeriod .= $minutes."M";
			}
		}
		
	}
	
	// removes all recurrence periods
	function clearPeriods()
	{
		$this->rPeriod = "";
	}


	// adds exception date-value to the recurrence
	// year must be a 4 digit string
	// month and day must be 2 digit strings
	function addExceptionDate($year, $month, $day)
	{
		if (empty($this->eDate))
			$this->eDate = "EXDATE;VALUE=DATE:".$year.$month.$day;
		else
			$this->eDate .= ",".$year.$month.$day;
	}
	
	// removes all exception dates
	function clearExceptionDates()
	{
		$this->eDate = "";
	}

	// adds exception date-time-value to the recurrence
	// year must be a 4 digit string
	// month, day, hour, minute, second must be 2 digit strings
	// if the time is UTC then set isUTC to 1, otherwise set isUTC to 0
	function addExceptionDateTime($year, $month, $day, $hour, $minute, $second, $isUTC=0)
	{
		if (empty($this->eDateTime))
		{
			$this->eDateTime = "EXDATE:".$year.$month.$day."T".$hour.$minute.$second;
			if ($isUTC == 1)
				$this->eDateTime .= "Z";
		}
		else
		{
			$this->eDate .= ",".$year.$month.$day."T".$hour.$minute.$second;
			if ($isUTC == 1)
				$this->eDateTime .= "Z";
		}
	}
	
	// removes all exception date-times
	function clearExceptionDateTimes()
	{
		$this->eDateTime = "";
	}

	// sets recurrence to daily
	function setRecurrenceFrequenceDaily()
	{
		$this->rRule = "RRULE:FREQ=DAILY";
	}

	// sets recurrence to weekly
	function setRecurrenceFrequenceWeekly()
	{
		$this->rRule = "RRULE:FREQ=WEEKLY";
	}

	// sets recurrence to monthly
	function setRecurrenceFrequenceMonthly()
	{
		$this->rRule = "RRULE:FREQ=MONTHLY";
	}

	// sets recurrence to yearly
	function setRecurrenceFrequenceYearly()
	{
		$this->rRule = "RRULE:FREQ=YEARLY";
	}

	// sets recurrence to hourly
	function setRecurrenceFrequenceHourly()
	{
		$this->rRule = "RRULE:FREQ=HOURLY";
	}

	// sets recurrence to minutely
	function setRecurrenceFrequenceMinutely()
	{
		$this->rRule = "RRULE:FREQ=MINUTELY";
	}

	// sets Recurrence count (how often should it be repeated)
	// number must be a integer value
	// if number is 0, then the count-value will be cleard
	function setRecurrenceCount($number)
	{
		if ($number > 0)
			$this->rRuleCount = ";COUNT=".$number;
		else
			$this->rRuleCount = "";
	}

	// adds recurrence until date-time-value
	// year must be a 4 digit string
	// month, day, hour, minute, second must be 2 digit strings
	// if the time is UTC then set isUTC to 1, otherwise set isUTC to 0
	function addRecurrenceUntilDateTime($year, $month, $day, $hour, $minute, $second, $isUTC=0)
	{
		$this->rRuleUntil = ";UNTIL=".$year.$month.$day."T".$hour.$minute.$second;
		if ($isUTC == 1)
			$this->rRuleUntil .= "Z";
	}

	// adds interval to the recurrence
	// means it will happen every x days, weeks, months, ...
	// number must be a integer value
	// if number is 0, then the interval-value will be cleard
	function setRecurrenceInterval($number)
	{
		if ($number > 0)
			$this->rRuleInterval = ";INTERVAL=".$number;
		else
			$this->rRuleInterval = "";
	}
	
	// sets week start day for recurrence and exception rule
	// day could have one of the following values (as string): MO, TU, WE, TH, FR, SA, SU
	// if day is empty, then the weekstart will be reset (default is monday)
	function setWeekStartDay($day)
	{
		if (empty($day))
		{
			$this->rRuleWkSt = "";
			$this->eRuleWkSt = "";
		}
		else
		{
			$this->rRuleWkSt = ";WKST=".$day;
			$this->eRuleWkSt = ";WKST=".$day;
		}
	}
	
	// adds a month to the by month-list
	// give the number of the corresponding month (1 = january, 2 = february, ...)
	function addRecurrenceByMonth($number)
	{
		if (empty($this->rRuleByMonth))
		{
			$this->rRuleByMonth = ";BYMONTH=".$number;
		}
		else
			$this->rRuleByMonth .= ",".$number;
	}
	
	// clears the by month list
	function clearRecurrenceByMonth()
	{
		$this->rRuleByMonth = "";
	}
	
	// adds recurrence by day to the by day list
	// day must be one of the following values (as string): MO, TU, WE, TH, FR, SA, SU
	// specific is optional and must be a integer value, specifying the nth occurence of the day
	// addRecurrenceByDay("MO"); - this means every monday
	// addRecurrenceByDay("FR", 1); - this means only the first friday (of a month or year, depending on frequence set)
	// addRecurrenceByDay("SU", -1); - this means only the last sunday (of a month or year, depending on frequence set)
	function addRecurrenceByDay($day, $specific=0 )
	{
		if ($specific == 0)
			$temp = $day;
		else
			$temp = $specific.$day;
		
		if (empty($this->rRuleByDay))
			$this->rRuleByDay = ";BYDAY=".$temp;
		else
			$this->rRuleByDay .= ",".$temp;		
	}

	// clears the by day list
	function clearRecurrenceByDay()
	{
		$this->rRuleByDay = "";
	}

	// adds recurrence by month-day to the by month-day list
	// day must be a positive or negative integer value between -31 and 31
	// there are months that have less than 31 days!
	function addRecurrenceByMonthDay($day)
	{
		if (empty($this->rRuleByMonthDay))
			$this->rRuleByMonthDay = ";BYMONTHDAY=".$day;
		else
			$this->rRuleByMonthDay .= ",".$day;		
	}

	// clears the by month-day list
	function clearRecurrenceByMonthDay()
	{
		$this->rRuleByMonthDay = "";
	}
	
	// adds recurrence by year-day to the by year-day list
	// day must be a positive or negative integer value between giving the day in a year
	// if day is negative, it starts at the end of the year counting backwards
	function addRecurrenceByYearDay($day)
	{
		if (empty($this->rRuleByYearDay))
			$this->rRuleByYearDay = ";BYYEARDAY=".$day;
		else
			$this->rRuleByYearDay .= ",".$day;		
	}

	// clears the by year-day list
	function clearRecurrenceByYearDay()
	{
		$this->rRuleByYearDay = "";
	}

	// adds recurrence by week number
	// week must give a valid week number
	// if week is negative, it starts at the end of the year counting backwards
	function addRecurrenceByWeek($week)
	{
		if (empty($this->rRuleByWeek))
			$this->rRuleByWeek = ";BYWEEKNO=".$week;
		else
			$this->rRuleByWeek .= ",".$week;		
	}

	// clears the by week number list
	function clearRecurrenceByWeek()
	{
		$this->rRuleByWeek = "";
	}

	// adds recurrence by hour
	// hour must be between 0 and 23
	function addRecurrenceByHour($hour)
	{
		if (empty($this->rRuleByHour))
			$this->rRuleByHour = ";BYHOUR=".$hour;
		else
			$this->rRuleByHour .= ",".$hour;		
	}

	// clears the by hour list
	function clearRecurrenceByHour()
	{
		$this->rRuleByHour = "";
	}

	// adds recurrence by minute
	// minute must be between 0 and 59
	function addRecurrenceByMinute($minute)
	{
		if (empty($this->rRuleByMinute))
			$this->rRuleByMinute = ";BYMINUTE=".$minute;
		else
			$this->rRuleByMinute .= ",".$minute;		
	}

	// clears the by minute list
	function clearRecurrenceByMinute()
	{
		$this->rRuleByMinute = "";
	}
	
	// selects the nth occurence of another ByXXX rule
	// value must be between 1 and 366 or -1 and -366
	// only use this together with another addRecurenceByXXX-function
	// example: selects the last workday of the month
	// setRecurrenceFrequenceMonthly();
	// addRecurenceByDay("MO");
	// addRecurenceByDay("TU");
	// addRecurenceByDay("WE");
	// addRecurenceByDay("TH");
	// addRecurenceByDay("FR");
	// addRecurrenceBySetPos(-1);
	// end example
	function addRecurrenceBySetPos($value)
	{
		if (empty($this->rRuleBySetPos))
			$this->rRuleBySetPos = ";BYSETPOS=".$value;
		else
			$this->rRuleBySetPos .= ",".$value;		
	}

	// clears the by SetPos list
	function clearRecurrenceBySetPos()
	{
		$this->rRuleBySetPos = "";
	}
	
	// sets exception to daily
	function setExceptionFrequenceDaily()
	{
		$this->eRule = "EXRULE:FREQ=DAILY";
	}

	// sets exception to weekly
	function setExceptionFrequenceWeekly()
	{
		$this->eRule = "EXRULE:FREQ=WEEKLY";
	}

	// sets exception to monthly
	function setExceptionFrequenceMonthly()
	{
		$this->eRule = "EXRULE:FREQ=MONTHLY";
	}

	// sets exception to yearly
	function setExceptionFrequenceYearly()
	{
		$this->eRule = "EXRULE:FREQ=YEARLY";
	}

	// sets exception to hourly
	function setExceptionFrequenceHourly()
	{
		$this->eRule = "EXRULE:FREQ=HOURLY";
	}

	// sets exception to minutely
	function setExceptionFrequenceMinutely()
	{
		$this->eRule = "EXRULE:FREQ=MINUTELY";
	}

	// sets exception count (how often should it be repeated)
	// number must be a integer value
	// if number is 0, then the count-value will be cleard
	function setExceptionCount($number)
	{
		if ($number > 0)
			$this->eRuleCount = ";COUNT=".$number;
		else
			$this->eRuleCount = "";
	}

	// adds exception until date-time-value
	// year must be a 4 digit string
	// month, day, hour, minute, second must be 2 digit strings
	// if the time is UTC then set isUTC to 1, otherwise set isUTC to 0
	function addExceptionUntilDateTime($year, $month, $day, $hour, $minute, $second, $isUTC=0)
	{
		$this->eRuleUntil = ";UNTIL=".$year.$month.$day."T".$hour.$minute.$second;
		if ($isUTC == 1)
			$this->eRuleUntil .= "Z";
	}

	// adds interval to the exception
	// means it will not happen every x days, weeks, months, ...
	// number must be a integer value
	// if number is 0, then the interval-value will be cleard
	function setExceptionInterval($number)
	{
		if ($number > 0)
			$this->eRuleInterval = ";INTERVAL=".$number;
		else
			$this->eRuleInterval = "";
	}
	
	// adds a month to the exception by month-list
	// give the number of the corresponding month (1 = january, 2 = february, ...)
	function addExceptionByMonth($number)
	{
		if (empty($this->eRuleByMonth))
		{
			$this->eRuleByMonth = ";BYMONTH=".$number;
		}
		else
			$this->eRuleByMonth .= ",".$number;
	}
	
	// clears the exception by month list
	function clearExceptionByMonth()
	{
		$this->eRuleByMonth = "";
	}
	
	// adds recurrence by day to the exception by day list
	// day must be one of the following values (as string): MO, TU, WE, TH, FR, SA, SU
	// specific is optional and must be a integer value, specifying the nth occurence of the day
	// addExceptionByDay("MO"); - this means no monday
	// addExceptionByDay("FR", 1); - this means not at the first friday (of a month or year, depending on frequence set)
	// addExceptionByDay("SU", -1); - this means not at the last sunday (of a month or year, depending on frequence set)
	function addExceptionByDay($day, $specific=0 )
	{
		if ($specific == 0)
			$temp = $day;
		else
			$temp = $specific.$day;
		
		if (empty($this->eRuleByDay))
			$this->eRuleByDay = ";BYDAY=".$temp;
		else
			$this->eRuleByDay .= ",".$temp;		
	}

	// clears the exception by day list
	function clearExceptionByDay()
	{
		$this->eRuleByDay = "";
	}

	// adds recurrence by month-day to the exception by month-day list
	// day must be a positive or negative integer value between -31 and 31
	// there are months that have less than 31 days!
	function addExceptionByMonthDay($day)
	{
		if (empty($this->eRuleByMonthDay))
			$this->eRuleByMonthDay = ";BYMONTHDAY=".$day;
		else
			$this->eRuleByMonthDay .= ",".$day;		
	}

	// clears the exception by month-day list
	function clearExceptionByMonthDay()
	{
		$this->eRuleByMonthDay = "";
	}
	
	// adds recurrence by year-day to the exception by year-day list
	// day must be a positive or negative integer value between giving the day in a year
	// if day is negative, it starts at the end of the year counting backwards
	function addExceptionByYearDay($day)
	{
		if (empty($this->eRuleByYearDay))
			$this->eRuleByYearDay = ";BYYEARDAY=".$day;
		else
			$this->eRuleByYearDay .= ",".$day;		
	}

	// clears the exception by year-day list
	function clearExceptionByYearDay()
	{
		$this->eRuleByYearDay = "";
	}

	// adds exception by week number
	// week must give a valid week number
	// if week is negative, it starts at the end of the year counting backwards
	function addExceptionByWeek($week)
	{
		if (empty($this->eRuleByWeek))
			$this->eRuleByWeek = ";BYWEEKNO=".$week;
		else
			$this->eRuleByWeek .= ",".$week;		
	}

	// clears the exception by week number list
	function clearExceptionByWeek()
	{
		$this->eRuleByWeek = "";
	}

	// adds exception by hour
	// hour must be between 0 and 23
	function addExceptionByHour($hour)
	{
		if (empty($this->eRuleByHour))
			$this->eRuleByHour = ";BYHOUR=".$hour;
		else
			$this->eRuleByHour .= ",".$hour;		
	}

	// clears the exception by hour list
	function clearExceptionByHour()
	{
		$this->eRuleByHour = "";
	}

	// adds exception by minute
	// minute must be between 0 and 59
	function addExceptionByMinute($minute)
	{
		if (empty($this->eRuleByMinute))
			$this->eRuleByMinute = ";BYMINUTE=".$minute;
		else
			$this->eRuleByMinute .= ",".$minute;		
	}

	// clears the exception by minute list
	function clearExceptionByMinute()
	{
		$this->eRuleByMinute = "";
	}
	
	// selects the nth occurence of another ByXXX rule as exception
	// value must be between 1 and 366 or -1 and -366
	// only use this together with another addExceptionByXXX-function
	// example: selects the last workday of the month as exception
	// setExceptionFrequenceMonthly();
	// addExceptionByDay("MO");
	// addExceptionByDay("TU");
	// addExceptionByDay("WE");
	// addExceptionByDay("TH");
	// addExceptionByDay("FR");
	// addExceptioneBySetPos(-1);
	// end example
	function addExceptionBySetPos($value)
	{
		if (empty($this->eRuleBySetPos))
			$this->eRuleBySetPos = ";BYSETPOS=".$value;
		else
			$this->eRuleBySetPos .= ",".$value;		
	}

	// clears the exception by SetPos list
	function clearExceptionBySetPos()
	{
		$this->eRuleBySetPos = "";
	}


}
?>
