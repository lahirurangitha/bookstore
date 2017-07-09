function showResult(str,page) {
    if (str.length == 0) {
        document.getElementById("count").innerHTML = "";
        //hide all rows
        var lst = document.getElementsByClassName('trcls');
        for(var i = 0; i < lst.length; ++i) {
            lst[i].style.display = '';
        }
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            usrs = JSON.parse(this.responseText);

            //hide all rows
            var lst = document.getElementsByClassName('trcls');
            for(var i = 0; i < lst.length; ++i) {
                lst[i].style.display = 'none';
            }
            //display search result
            for (u in usrs) {
                document.getElementById('tr' + usrs[u].id).style.display = '';
            }
            document.getElementById("count").innerHTML = usrs.length + ' results found.';
        }
    };
    xmlhttp.open("GET", page+".php?q=" + str, true);
    xmlhttp.send();
}