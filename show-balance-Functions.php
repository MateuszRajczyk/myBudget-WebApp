<?php
	
function isLeapYear(int $year)
{
    return ($year == 2000 || $year % 4 == 0);
}

function numbersOfDaysInMonth(int $month, int $year)
{
    switch($month)
    {
		case 1:
			return 31;
			break;
		case 2:
			if(isLeapYear($year))
			{
				return 29;
				break;
			}
			else
			{
				return 28;
				break;
			}
			break;
		case 3:
			return 31;
			break;
		case 4:
			return 30;
			break;
		case 5:
			return 31;
			break;
		case 6:
			return 30;
			break;
		case 7:
			return 31;
			break;
		case 8:
			return 31;
			break;
		case 9:
			return 30;
			break;
		case 10:
			return 31;
			break;
		case 11:
			return 30;
			break;
		case 12:
			return 31;
			break;
    }
}





?>