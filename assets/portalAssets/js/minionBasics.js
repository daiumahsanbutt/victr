function popupNotification(message, type, duration = '5000', positionX='right', positionY='top'){
    var ripple = true;
    var dismissible = true;
    window.notyf.open({
        type,
        message,
        duration,
        ripple,
        dismissible,
        position: {
            x: positionX,
            y: positionY
        }
    });
}

const formatCash = n => {
    if (n < 1e3) return n;
    if (n >= 1e3 && n < 1e6) return +(n / 1e3).toFixed(2) + "K";
    if (n >= 1e6 && n < 1e9) return +(n / 1e6).toFixed(2) + "M";
    if (n >= 1e9 && n < 1e12) return +(n / 1e9).toFixed(2) + "B";
    if (n >= 1e12) return +(n / 1e12).toFixed(2) + "T";
};
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).on("click", "#activityLoadMore", function(){
    var activityListSize = $(".timeline-item").length;
    var showIntervals = $(".timeline-item").attr("show_intervals");
    var visibleElements = $(".timeline-item:visible").length;
    visibleElements= (visibleElements+showIntervals <= activityListSize) ? visibleElements+showIntervals : activityListSize;
    $('.timeline-item:lt('+visibleElements+')').show();
    if(visibleElements >=  $(".timeline-item").length){
        $('#activityLoadMore').hide();
    } else {
        $('#activityLoadMore').show();
    }
})

$(document).on("click", ".no_permission", function(){
    Swal.fire(
        'Error',
        'You do not have permission to perform this task!',
        'error'
    )
})
var defaultDateRangePreSetsSingle = {
    'This Week': [moment().startOf('week'), moment().endOf('week')],
    'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    'Current Quarter': [moment().quarter(moment().quarter()).startOf('quarter'), moment().quarter(moment().quarter()).endOf('quarter')],
    'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
    'This Year': [moment().startOf('year'), moment().endOf('year')],
    'Last Year': [moment().subtract(1, 'years').startOf('year'), moment().subtract(1, 'years').endOf('year')]
};

var defaultDateRangePreSets = {
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Week': [moment().startOf('week'), moment().endOf('week')],
    'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
    'This Month': [moment().startOf('month'), moment().endOf('month')],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    'Current Quarter': [moment().quarter(moment().quarter()).startOf('quarter'), moment().quarter(moment().quarter()).endOf('quarter')],
    'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
    'This Year': [moment().startOf('year'), moment().endOf('year')],
    'Last Year': [moment().subtract(1, 'years').startOf('year'), moment().subtract(1, 'years').endOf('year')]
};

function filter_cb(start, end) {
    $($(this)[0].element[0]).find("span").html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}
function processFormDataMinionfy(serialized_array){
    return new Promise(async function(resolve, reject){
        var form_data = {};
        for(var i = 0; i < serialized_array.length; i++){
            console.log(serialized_array[i].value);
            form_data[serialized_array[i].name] = serialized_array[i].value;
        }
        resolve(form_data);
    });
}

(function($,undefined){
    '$:nomunge';
    $.fn.serializeObject = function(){
      var obj = {};
      $.each( this.serializeArray(), function(i,o){
        var n = o.name,
          v = o.value;
          
          obj[n] = obj[n] === undefined ? v
            : $.isArray( obj[n] ) ? obj[n].concat( v )
            : [ obj[n], v ];
      });
      return obj;
    };
})(jQuery);

function loader_start(){
    $(".loader_overlay").show();
}
function loader_end(){
    $(".loader_overlay").hide();
}


function setStateAndCity(state_element, state_value, city_element, city_value){
    state_element.setChoiceByValue(state_value);
    var choices = [];
    var selected = true;
    for(var i = 0 ; i < cities.length; i++){
        if(cities[i].state_id == state_value){
            choices.push({
                value: cities[i].id,
                label: cities[i].name,
                selected: selected
            });
            selected = false;
        }
    }
    city_element.clearStore();
    city_element.setChoices(choices);
    city_element.setChoiceByValue(city_value);
}
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getFileSizeFromURL(url){
    var fileSize = '';
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send(null);
    if (http.status === 200) {
        fileSize = http.getResponseHeader('content-length');
    }
    return fileSize;
}

function removeHtmlTags(str) {
    return str.replace(/<[^>]*>/g, '');
}