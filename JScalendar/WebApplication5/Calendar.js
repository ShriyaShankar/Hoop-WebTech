$(document).ready(function () {

    GenerateHTMLString()

});

function GenerateHTMLString() {
    var date = new Date();
    var start = new Date();
    var end = new Date();
    start.setDate(date.getDate());
    end.setDate(date.getDate() + 30);

    var htmls = '';
    htmls += '<table><tr><th> Name </th>';
    for (var d = start ; d <= end; d.setDate(d.getDate() + 1)) {

        var WGHeader = '<th>' + formatDateddMM(new Date(d)) + '</th>';
        htmls += WGHeader;

    }
    htmls += '</tr>'
    var onerow = '';
    for (var i = 0; i < 5; i++) {

        var name = "A" + i.toString();
        onerow += '<tr><td>' + name + '</td>';


        for (var ji = 0; ji <= 30; ji++) {

            onerow += '<td> </td>';


        }
        onerow += '</tr>'
    }
    htmls += onerow;
    $('#Calendar').append(htmls);

}

function formatDateddMM(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [day, month].join('/');
}
