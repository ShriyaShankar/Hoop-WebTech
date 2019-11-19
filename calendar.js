const scalDate = new Date(); // not reqd for us
const bcalDate = new Date();
let datesToBeHighlighted = []; //list of dates that we want to highlight
let tournamentName = [];
// const date1 = new Date();
// date1.setDate(19);
// datesToBeHighlighted.push(date1);
const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
fetch('join.php') //fetch data from join.php file
    .then((response) => response.json())
        .then(response => {
            datesToBeHighlighted = response.map(dateString => convertToDateObject(dateString))
          //  tournamentName = response.map();
            initBCalendarView();
        });
function assignDate(dateObjA, dateObjB) {
    /*
        Deep copy function to copy two date objects, Javascript objects are always only referenced.
    */
    dateObjA.setDate(1);
    dateObjA.setMonth(dateObjB.getMonth());
    dateObjA.setDate(dateObjB.getDate());
    dateObjA.setFullYear(dateObjB.getFullYear());
}

function convertToDateObject(dateString){
    const dateElements = dateString.split("-"); //date format is in yyyy-mm-dd, so split based on '-'
    const year = dateElements[0]; //gives yyyy
    const month = dateElements[1]; //gives mm
    const date = dateElements[2]; //gives dd
    const newDate = new Date();
    newDate.setDate(date);
    newDate.setMonth(month - 1); //index 0
    newDate.setFullYear(year);
    return newDate;
}
function initBCalendarView() {
    const monthContainer=document.getElementById("bcal-mon"); //month container
    monthContainer.innerHTML = months[bcalDate.getMonth()]; //returns current month to html span tag
    const yearContainer = document.getElementById("bcal-year");
    yearContainer.innerHTML=bcalDate.getFullYear(); //returns current year to html span tag
    bcalDate.setDate(1); //default date set to 1st
    while (bcalDate.getDay()!=1) {
        bcalDate.setDate(bcalDate.getDate()-1);    //if date isn't first, set to current date
    }
    let bcalContainer = document.getElementById("bcal-container"); //calendar container
    bcalContainer = bcalContainer.getElementsByClassName("days"); //days class
    bcalContainer=bcalContainer[0].getElementsByTagName("li"); 
    for(let i=0;i<bcalContainer.length;i++) { //remove all attributes for all dates
        bcalContainer[i].classList.remove('inactive');
        bcalContainer[i].classList.remove('active');
        bcalContainer[i].classList.remove('selected');
        if (bcalDate.getMonth()!=scalDate.getMonth()) { // to make the dates of previous and next months in current calendar view less prominent
            bcalContainer[i].innerHTML=bcalDate.getDate();
            bcalContainer[i].setAttribute('class','inactive');
        }
        else {
            if (bcalDate.getDate()===scalDate.getDate()) {
                bcalContainer[i].innerHTML="<span class='active'></span>";
                const bcalDateContainer = bcalContainer[i].getElementsByTagName("span");
                bcalDateContainer[0].innerHTML=bcalDate.getDate();     
            }
            else
                bcalContainer[i].innerHTML = bcalDate.getDate();
        }
        bcalDate.setDate(bcalDate.getDate()+1);
    }
    for(const date of datesToBeHighlighted){    
      //  if((date.getMonth()+1)%13 == bcalDate.getMonth() && date.getFullYear() == bcalDate.getFullYear()){
          if(date.getFullYear() == bcalDate.getFullYear()){
            for(let i=0;i<bcalContainer.length;i++){
                if(!(bcalContainer[i].classList.contains('inactive'))){
                    if(date.getDate() == bcalContainer[i].innerHTML && date.getMonth() == bcalDate.getMonth())
                        bcalContainer[i].classList.add("selected");
                    // else if((date.getMonth()+1)%13 == bcalDate.getMonth() + 1){
                    //     bcalContainer[i].classList.add("selected");
                    //     monthContainer[i+1].classList.add("selected");
                    // }
                }
            }     
        }
    }
    assignDate(bcalDate,scalDate);
}


/* function bcalendarSelect(clickedDateElement)
{
    const spanElements = clickedDateElement.getElementsByTagName("span");
    if (spanElements.length==0)
    {
        console.log(clickedDateElement.className);
        if (clickedDateElement.className=="inactive")
        {
            if(Number(clickedDateElement.innerHTML)<15)
            {
                bcalDate.setDate(1);
                bcalDate.setMonth(bcalDate.getMonth()+1);
            }
            else 
            {
                bcalDate.setDate(1);
                bcalDate.setMonth(bcalDate.getMonth()-1);
            }
        }
        bcalDate.setDate(clickedDateElement.innerHTML);
        assignDate(scalDate,bcalDate);
    }
    initBCalendarView();
} */

function jumpToToday() //return back to present date
{
    const currentDate = new Date();
    assignDate(scalDate, currentDate); //not reqd for us
    assignDate(bcalDate, currentDate); //returns current date
    initBCalendarView();
}

function bcalenderMonthChange(clickedClass) //previous and next month access
{
    bcalDate.setDate(1);
    if (clickedClass.classList.contains("prev")) 
        bcalDate.setMonth(bcalDate.getMonth()-1); //prev month is current month - 1
    else
        bcalDate.setMonth(bcalDate.getMonth()+1); //next month is current month + 1
    assignDate(scalDate, bcalDate);
    initBCalendarView();
}



