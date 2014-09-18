
var utilities = {};

utilities.loadingStateHtml = '<div class="loading-overlay overlay"><i class="fa fa-refresh fa-spin"></i></div>';

utilities.setBoxLoading = function ($element, show) {

    if (show) {
        $element.append(utilities.loadingStateHtml);
    } else {

        $element.find('.loading-overlay').remove();
    }

};

utilities.trimHttp = function (url) {
    return url.substring(7, url.length);
};

utilities.trimPort = function (url) {
    if (url.indexOf(":") > 0) {
        var splittedUrl = url.split(':');
        console.log(splittedUrl);
        return splittedUrl[0];
    } else {
        return url;
    }

};

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};