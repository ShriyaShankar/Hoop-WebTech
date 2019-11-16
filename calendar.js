const scalDate = new Date();
const bcalDate = new Date();
const datesToBeHighlighted = [];
const date1 = new Date();
date1.setDate(19);
datesToBeHighlighted.push(date1);
const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
fetch('join.php').then((response) => String(response)).then(response => console.log(response));
function assignDate(dateObjA, dateObjB) {
    dateObjA.setDate(1);
    dateObjA.setMonth(dateObjB.getMonth());
    dateObjA.setDate(dateObjB.getDate());
    dateObjA.setFullYear(dateObjB.getFullYear());
}

function highlightAccordingToDates(dateString){
    const dateElements = dateString.split("-");
    const year = dateElements[0];
    const month = dateElements[1];
    const date = dateElements[2];


}
function initBCalendarView() {
    const monthContainer=document.getElementById("bcal-mon");
    monthContainer.innerHTML = months[bcalDate.getMonth()];
    const yearContainer = document.getElementById("bcal-year");
    yearContainer.innerHTML=bcalDate.getFullYear();
    bcalDate.setDate(1);
    while (bcalDate.getDay()!=1) {
        bcalDate.setDate(bcalDate.getDate()-1);    
    }
    let bcalContainer = document.getElementById("bcal-container");
    bcalContainer = bcalContainer.getElementsByClassName("days");
    bcalContainer=bcalContainer[0].getElementsByTagName("li");
    for(let i=0;i<bcalContainer.length;i++) {
        bcalContainer[i].classList.remove('inactive');
        bcalContainer[i].classList.remove('active');
        bcalContainer[i].classList.remove('selected');
        if (bcalDate.getMonth()!=scalDate.getMonth()) {
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
        if((date.getMonth()+1)%13 == bcalDate.getMonth() && date.getFullYear() == bcalDate.getFullYear()){
            for(let i=0;i<bcalContainer.length;i++){
                if(!(bcalContainer[i].classList.contains('inactive'))){
                    if(date.getDate() == bcalContainer[i].innerHTML)
                        bcalContainer[i].classList.add("selected");
                }
            }     
        }
    }
    assignDate(bcalDate,scalDate);
}

function scalendarViewChange(clicked_id)
{    
    if (clicked_id == "scal-button-left")        
        scalDate.setDate(scalDate.getDate()-1);    
    else
        scalDate.setDate(scalDate.getDate()+1);
    initBCalendarView();
}

function bcalendarSelect(clickedDateElement)
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
}

function jumpToToday()
{
    const currentDate = new Date();
    assignDate(scalDate, currentDate);
    assignDate(bcalDate, currentDate);
    initBCalendarView();
}

function bcalenderMonthChange(clickedClass)
{
    bcalDate.setDate(1);
    if (clickedClass.className=="prev")
        bcalDate.setMonth(bcalDate.getMonth()-1);
    else
        bcalDate.setMonth(bcalDate.getMonth()+1);
    assignDate(scalDate,bcalDate);
    initBCalendarView();
}

