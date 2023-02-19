
// -------------- GO BACK --------------- //
var goBack = function() {
    window.history.back();
}
// -------------- END GO BACK --------------- //


// -------------- GET URL SEGMENT --------------- //
var getURLSegment = function (paramIndex) {
    var splitUrl = $(location).attr('pathname').split('/');
    
    // Remove Index 0
    splitUrl.splice(0, 1);

    if ($(location).attr('hostname') === 'localhost') {
        // Again, Remove Index Before 'public'
        splitUrl.splice(0, $.inArray('public', splitUrl) + 1);
    }
    
    return empty(paramIndex) ? splitUrl : splitUrl[paramIndex];
}
// -------------- END GET URL SEGMENT --------------- //


// --------- CHECK VARIABLE EMPTY OR NOT ---------- //
var empty = function (variable) {
    var isEmpty = true;

    if (
        (Array.isArray(variable) && variable.length > 0) ||
        (!Array.isArray(variable) && variable !== null &&
            variable !== undefined && variable !== '')
    ) {
        isEmpty = false;
    }

    return isEmpty;
}
// --------- CHECK VARIABLE EMPTY OR NOT ---------- //


// ------ CHANGE NUMBER TO FORMAT PRICE -------- //
var toPrice = function (num) {
    num += "";
    var numSplit = num.split(".");
    var x1 = numSplit[0];
    var x2 = numSplit.length > 1 ? "." + numSplit[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + "." + "$2");
    }
    return "Rp. " + x1 + x2;
}
// ------ CHANGE NUMBER TO FORMAT PRICE -------- //


// ----- REMOVE ITEM FROM ARRAY ------- //
Array.prototype.remove = function(x) {
    var i;
    for(i in this){
        if(this[i].toString() === x.toString()){
            this.splice(i,1)
        }
    }
}
// ----- REMOVE ITEM FROM ARRAY ------- //


// ----- GET URL PARAMETER (FOR GET METHOD ONLY) ------- //
var getURLParam = function (k) {
    let p={};
    location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){p[k]=v})
    return k?p[k]:p;
}
// ----- END GET URL PARAMETER (FOR GET METHOD ONLY) ------- //


// ------------- REMOVE URL PARAMETER ----------- //
var removeURLParam = function (key, sourceURL) {
    let rtn = '',
        param,
        params_arr = [];
    if (sourceURL !== "") {
        params_arr = sourceURL.split("&");
        for (let i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = params_arr.join("&");
    }
    return rtn;
}
// ------------- END REMOVE URL PARAMETER ----------- //

