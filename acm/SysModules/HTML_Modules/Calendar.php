<?php
function OrganiseDateMonthYear()
{
    // Get the current year and month
    if (isset($_GET['month']) && isset($_GET['year'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
        $date = $_GET['day'];
    } else {
        $month = date('n');
        $year = date('Y');
        $date = date('d');
    }

    // Get the number of days in the current month
    $numDays = date('t', mktime(0, 0, 0, $month, 1, $year));

    // Get the first day of the month
    $firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));

    // Create an array of month names
    $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

    //view past or future month
    // Create links to navigate between months
    $prevMonth = $month - 1;
    $prevYear = $year;
    if ($prevMonth == 0) {
        $prevMonth = 12;
        $prevYear--;
    }
    $nextMonth = $month + 1;
    $nextYear = $year;
    if ($nextMonth == 13) {
        $nextMonth = 1;
        $nextYear++;
    }
    $prevMonthName = date('F', mktime(0, 0, 0, $prevMonth, 1));
    $nextMonthName = date('F', mktime(0, 0, 0, $nextMonth, 1));

    if (isset($_GET['month'])) {
        $Reset = "<a href='index.php' class='btn btn-xs btn-danger'><i class='fa fa-calendar'></i> Go to Today Date</a> ";
    } else {
        $Reset = "";
    }

    $return = "<div>
                        <h4 class='current-date'><i class='fa fa-calendar text-warning'></i> " . $date . " " . $months[$month] . " " . $year . "</h4>
                        <h5 class='mb-4'><i class='fa fa-clock text-success'></i> <span id='clock2'>" . date("h:i A") . "</span></h5>
                        <p class='flex-s-b m-b-10'>
                        <a href='?month=$prevMonth&amp;year=$prevYear&day=$date' class='btn btn-xs btn-default'><i class='fa fa-angle-double-left'></i> $prevMonthName</a> 
                        <a href='?month=$nextMonth&amp;year=$nextYear&day=$date' class='btn btn-xs btn-default'>$nextMonthName <i class='fa fa-angle-double-right'></i></a>
                        </p>
                        <form class='flex-s-b mb-2'>
                        <input type='hidden' name='day' value='$date'>
                        <select name='month' class='form-control  w-50 m-r-2' onchange='form.submit()'>
                        ";
    $return .=  InputOptionsWithKey($months, IfRequested('GET', 'month', $month, false));
    $return .= "
                        </select>
                        <input type='number' value='" . IfRequested('GET', 'year', date('Y'), false) . "' name='year' min='1900' max='2100' class='form-control  m-l-2 w-50' onchange='form.submit()'>
                        </form>
                        </div>
                        ";
    // Create the calendar table
    $return .= "<table class='table'>";
    $return .= "<tr class='cal-header'><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";

    // Create the first row of the calendar
    $return .= "<tr>";

    for ($i = 1; $i < $firstDay; $i++) {
        $return .= "<td></td>";
    }
    for ($i = 1; $i <= 7 - $firstDay; $i++) {
        if ($date == $i) {
            $select = "active";
        } else {
            $select = "";
        }
        $return .= "<td" . (($i == date('j') && $month == date('n') && $year == date('Y')) ? " class='today'" : "") . ">
                          <a class='$select' href='?month=$month&year=$year&day=$i'>$i</a>
                          </td>";
    }
    $return .= "</tr>";

    // Create the rest of the calendar
    for ($j = 1; $j <= ceil(($numDays - 7 + $firstDay) / 7); $j++) {
        $return .= "<tr>";
        for ($i = 1; $i <= 7; $i++) {
            $day = $i + ($j - 1) * 7 + (7 - $firstDay + 1);
            if ($day <= $numDays) {
                if ($day == $date) {
                    $select = "active";
                } else {
                    $select = "";
                }
                $return .= "<td" . (($day == date('j') && $month == date('n') && $year == date('Y')) ? " class='today'" : "") . ">
                              <a class='$select' href='?month=$month&year=$year&day=$day'>$day</a>
                              </td>";
            } else {
                $return .= "<td>$day</td>";
            }
        }
        $return .= "</tr>";
    }

    $return .= "</table>";

    $return .=  $Reset;

    return $return;
}

DEFINE("GENERATE_CALENDAR", OrganiseDateMonthYear());
