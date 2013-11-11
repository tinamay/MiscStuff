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


function showNearStationsForLine($target) {
    "use strict";
    if($("#nearStationsForLineList").length == 0) {
        var nearStations = location.hash;
        var latlgtIndex = nearStations.split('/');
        var index = latlgtIndex[0];
        var lat = latlgtIndex[1];
        var lgt = latlgtIndex[2];
        var targetUrl = "./nearStations.php?lat=" + lat + "&lgt=" + lgt;
        $("#content_container").load(targetUrl, function () {
            $("#nearStationsForLineList").hide();
            $("#nearLinesList").hide();

            $('[id^="lineIndex"]').hide();
            $("#nearStationsForLineList").show();
            $(index).slideToggle();      
        });
    } else {
        $('[id^="lineIndex"]').hide();
        $("#nearStationsForLineList").show();
        $target.slideToggle();
    }
}

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


/* ajax */

function loadNearLines(lat, lgt) {
    targetUrl = "./nearStations.php?lat=" + lat + "&lgt=" + lgt;
    $("#content_container").load(targetUrl, function () {
        location.hash = "lines" + lat + "/" + lgt;
        $("#nearStationsForLineList").hide();
        $("#nearLinesList").hide();        
        $("#nearLinesList").slideToggle("slow", "swing");
             
    });
}


function getNearLines() {
    "use strict";
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            "use strict";
            var lat, lgt, targetUrl;
            lat = position.coords.latitude;
            lgt = position.coords.longitude;
            loadNearLines(lat, lgt);
        });
    }
}



// ///////////////////////////////////////////////////////////////////

$(document).on("click", "#nearLines", function () {
    $("#loadingAnim img").show();
    $("#indexChoices").slideToggle("slow", "swing", function () {
        getNearLines();
    })
});

//Change content to nearStations for line #
$(document).on("click", ".singleLine", function () {
    var target; //line
    //        line = $(this).attr('line');
    target = $(this).attr('target');
    $('#nearLinesList').slideToggle("slow", "swing", function () {
        showNearStationsForLine($("#" + target));
        location.hash = target + "/" +location.hash.substring(6); //remove #lines from older hash
    });
});


$(document).on("click", ".singleStation", function () {
    var stationID = $(this).attr('target');    
    showStationTimes(stationID);
    $("#nearStationsForLineList").slideToggle();
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
    
    
    $("#nearStations").click(function () {
        //NOTHING ... for the moment
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
        if (location.hash.startsWith('#station')) {
            stationID = location.hash.substring(8);
            showStationTimes(stationID);
        } else if (location.hash.startsWith('#lines')) {
            var geocoords = location.hash.substring(6);
            var latlgt = geocoords.split('/');
            var lat = latlgt[0];
            var lgt = latlgt[1];
            loadNearLines(lat,lgt);
        } else if (location.hash.startsWith('#lineIndex')){
            //$('#nearLinesList').hide();
            target = location.hash;//$($(location).attr('hash'));
            showNearStationsForLine(target);
        }
    } else {
        $("#indexChoices").slideToggle("slow", "swing");
    }



});


