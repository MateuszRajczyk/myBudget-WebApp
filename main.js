var currentDate = new Date();

var month = currentDate.getMonth()+1;
var year = currentDate.getFullYear();

var currentMonthDate1 = "01" + "." + month + "." + year;
var currentMonthDate2 = numbersOfDaysInMonth(month, year) + "." + month + "." + year;

document.getElementById("chosenTimePeriod").innerHTML = currentMonthDate1 + " - " + currentMonthDate2;

function showPassword()
{
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
	document.getElementById("toggler").innerHTML = '<i class="icon-eye-off-1" id="toggler"></i>'
  } else {
    x.type = "password";
	document.getElementById("toggler").innerHTML = '<i class="icon-eye-1" id="toggler"></i>'
  }

}

function isLeapYear(year)
{
    return (year == 2000 || year % 4 == 0);
}

function numbersOfDaysInMonth(month, year)
{
    switch(month)
    {
		case 1:
			return 31;
			break;
		case 2:
			if(isLeapYear(year))
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



function datePeriod(elem)
{
	var currentDate = new Date();
	
	var month = currentDate.getMonth()+1;
	
	var lastMonth = month - 1;
	
	var year = currentDate.getFullYear();
	
	var currentMonthDate1 = "01" + "." + month + "." + year;
	var currentMonthDate2 = numbersOfDaysInMonth(month, year) + "." + month + "." + year;
	var lastMonthDate1 = "01" + "." + lastMonth + "." + year;
	var lastMonthDate2= numbersOfDaysInMonth(lastMonth, year) + "." + lastMonth + "." + year;
	var currentYear1 = "01" + "." + "01" + "." + year;
	var currentYear2 = "31" + "." + "12" + "." + year;
	if (month<10)
	{
		currentMonthDate1 = "01" + "." + "0" + month + "." + year;
		currentMonthDate2 = numbersOfDaysInMonth(month, year) + "." + "0" + month + "." + year;
	}
	else if(lastMonth<10)
	{
		lastMonthDate1 = "01" + "." + "0" + (month-1) + "." + year;
		lastMonthDate2 = numbersOfDaysInMonth(lastMonth, year) + "." + "0" + lastMonth + "." + year;
	}
	
	
	
	if(elem.id == "currentMonth")
	{
		document.getElementById("chosenTimePeriod").innerHTML = currentMonthDate1 + " - " + currentMonthDate2;
	}
	else if(elem.id == "lastMonth")
	{
		document.getElementById("chosenTimePeriod").innerHTML = lastMonthDate1 + " - " + lastMonthDate2;
	}
	else if(elem.id == "currentYear")
	{
		document.getElementById("chosenTimePeriod").innerHTML = currentYear1 + " - " + currentYear2;
	}
	else if(elem.id == "selectedPeriod")
	{
		
	}
}


function rememberMe() 
{
	const rmCheck = document.getElementById("rememberMe"),
	emailInput = document.getElementById("email");

	if (localStorage.checkbox && localStorage.checkbox !== "") {
	  rmCheck.setAttribute("checked", "checked");
	  emailInput.value = localStorage.username;
	} else {
	  rmCheck.removeAttribute("checked");
	  emailInput.value = "";
	}
	
  if (rmCheck.checked && emailInput.value !== "") {
	localStorage.username = emailInput.value;
	localStorage.checkbox = rmCheck.value;
  } else {
	localStorage.username = "";
	localStorage.checkbox = "";
  }
}

