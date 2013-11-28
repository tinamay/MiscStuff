/*jslint browser: true*/
/*global $, jQuery*/

if (typeof String.prototype.startsWith !== 'function') {
    String.prototype.startsWith = function (str) {
        "use strict";
        return this.slice(0, str.length) === str;
    };
}

var touch = ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
var touchEvent = touch ? 'touchstart' : 'click';


$.ajaxSetup({
    beforeSend: function () {
        "use strict";
        $('#loadingAnim img').show();
    },
    complete: function () {
        "use strict";
        $('#loadingAnim img').hide();
    }
    /*success: function () {}*/
});


function showStationTimes(stationID) {
    "use strict";
    var targetUrl = "time.php/?id=" + stationID;
    $("#content_container").load(targetUrl, function () {
        window.location.hash = "station" + stationID;
        $("#nearStationsForLineList").slideToggle();
        $("#singleStationTimes").hide();
        $("#singleStationTimes").slideToggle();
    });
}

function showStationsForLine(lineID) {
    var targetUrl = "stationsForLine.php?id=" + lineID; 
    var div = $("#content_container").children()[0];
    $("#content_container").load(targetUrl, function () {
        window.location.hash = "stationsForLine" + lineID;
        $("#lineList").slideToggle();
        $("#stationsForLine").hide();
        $("#stationsForLine").slideToggle();
    });
}

/* ajax */

function loadLinesList() {
    targetUrl = "./lines.php"
    $("#content_container").load(targetUrl, function () {
        location.hash = "lineList"
        $("#linesList").hide();        
        $("#linesList").slideToggle("slow", "swing");
    });
}

function loadLinesForStations(lat, lgt) {
    targetUrl = "./stations.php?lat=" + lat + "&lgt=" + lgt;
    $("#content_container").load(targetUrl, function () {
        location.hash = "linesForStations" + lat + "/" + lgt;
        $("#linesForStations").hide();        
        $("#linesForStations").slideToggle("slow", "swing");
    });
}


function getNearStations() {
    "use strict";
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            "use strict";
            var lat, lgt, targetUrl;
            lat = position.coords.latitude;
            lgt = position.coords.longitude;
            loadLinesForStations(lat, lgt);
        });
    }
}

// ///////////////////////////////////////////////////////////////////

$(document).on("click", ".aStation", function () {
    var stationID = $(this).attr('target');    
    showStationTimes(stationID);
    $("#linesForStations").slideToggle();
});

$(document).on("click", ".aLine", function () {
    var lineID = $(this).attr('target');  
    showStationsForLine(lineID);
    $("#linesForStations").slideToggle();
});


$(window).on('hashchange', function(e) {
    //console.log("writting " + e.originalEvent.oldURL);
    split = e.originalEvent.oldURL.split("#");
    if(split.length==2) {
        newHash = split[1];
        document.cookie = document.cookie + "#" + newHash;
        console.log("newCookie " + document.cookie);
    }
});





///////////////////////////////////////////////////////
$(document).ready(function () {    
    document.cookie="#";
    console.log("cookie :" + document.cookie);
    $("#indexChoices").hide(); /* Showing nothing when ready. Content will be decided by the hash */
    
    $('#loadingAnim img').hide(); /* hidding the spinning ball, only showing on ajax */
    
    

    $("#linesList").click( function () {
        $("#loadingAnim img").show();
        $("#indexChoices").slideToggle("slow", "swing", function () {
            loadLinesList();
        });
    });
    
    $("#nearStations").click(function () {
        $("#loadingAnim img").show();
        $("#indexChoices").slideToggle("slow", "swing", function () {
            getNearStations();
        });
    });

    $("#backButton").click(function () {
        if(document.cookie) {
            console.log(document.cookie);
            split = document.cookie.split("#");
            aHash  = split[split.lenth-1];    
            window.location = aHash;
            location.reload();
            //TODO PILE HASH
        } else {
            $.get(".");
        }
    });

    
    ///
    /// ----  HASH handling ----
    ///
    if (window.location.hash) {
        var stationID, target;
        if (location.hash.startsWith('#linesForStations')) {
            var geocoords = location.hash.substring(17);
            var latlgt = geocoords.split('/');
            var lat = latlgt[0];
            var lgt = latlgt[1];
            loadLinesForStations(lat,lgt);
        } else if (location.hash.startsWith('#lineList')){
            loadLinesList();
        } else if (location.hash.startsWith('#stationsForLine')) {
            lineID = location.hash.substring(16);
            showStationsForLine(lineID);
        } else if (location.hash.startsWith('#station')) {
            stationID = location.hash.substring(8);
            showStationTimes(stationID);
        } else {
            alert("unknown hash");
        }
    } else {
        $("#indexChoices").slideToggle("slow", "swing");
    }
});


