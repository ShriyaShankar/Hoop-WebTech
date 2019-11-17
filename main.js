function hostTournament(){
    window.location = "host.html";
}

function joinTournament(){
    window.location = "joinTournament.php";
}

function editTournament(){
    window.location = "edit.html";
}

/* function highlightDates(){
    var eventDates = {};
    for(var i=0; i<1; i++){
        eventDates[ new Date( '16/11/2019' )] = new Date( '16/11/2019' );
    }
    $('#datepicker').datepicker({
        beforeShowDay: function( date ) {
            var highlight = eventDates[date];
            if( highlight ) {
                 return [true, "event", 'Tooltip text'];
            } else {
                 return [true, '', ''];
            }
        }
    });
} */