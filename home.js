var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    function drawCalendarMonths()
    {
        for(var i = 0; i < months.length; i++)
        {
            var doc = document.createElement("div");
            doc.innerHTML = months[i];
            doc.classList.add("dropdown-item");

            doc.onclick = (function () {
                var selectedMonth = i;
                return function ()
                {
                    month = selectedMonth;
                    document.getElementById("curMonth").innerHTML = months[month];
                    loadCalendarDays();
                    return month;
                }
            })();

            document.getElementById("months").appendChild(doc);
        }
    }
