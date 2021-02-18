<head>
<script language="javascript" src="calendar.js"></script>
</head>
<?php	
//get class into the page
require_once('classes/tc_calendar.php');

/*Otros seteos del calendario:
	  $myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1890, 2080);
					  
	  $myCalendar->dateAllow('1890-01-01', '2045-05-01', false);
					  
	  $myCalendar->setSpecificDate(array("2039-01-10", "2039-01-13", "2039-01-23"), 0, 'month');
					  
	  $myCalendar->startMonday(true);
	  $myCalendar->showWeeks(true);  
*/				
      $date3_default = "2017-09-25";
      $date4_default = "2017-10-01";

	  $myCalendar = new tc_calendar("date3", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date3_default))
            , date('m', strtotime($date3_default))
            , date('Y', strtotime($date3_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date3', 'date4', $date4_default);
	  $myCalendar->writeScript();	  
	  
	  $myCalendar = new tc_calendar("date4", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date4_default))
           , date('m', strtotime($date4_default))
           , date('Y', strtotime($date4_default)));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(1970, 2020);
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date3', 'date4', $date3_default);
	  $myCalendar->writeScript();	  
?>