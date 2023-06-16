 $(document).ready(function(){
    $('.phone').inputmask("(999) 999-9999");
    
    $('.select-date').click(function (){
        var service_id = $(this).attr('service_id');
        var btn_class  = $(this).attr('btn_class');
        $('body').data('service_id',service_id);
        $('body').data('btn_class',btn_class);
         });
    $('.select-date').datepicker({
        orientation: "bottom right",
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function(e) {
        var date          = e.format();
        var newdate       = moment(date).format('YYYY-MM-DD');
        var service_id    = $('body').data('service_id');
        var btn_class     = $('body').data('btn_class');
        var day           =  moment(date).format('D');
        var suffix        = ordinal_suffix_of(day);
        var selected_date = moment(date).format('MMMM')+" "+suffix+ ", " + moment(date).format('YYYY');
        $("#date-heading").html("DATE SELECTED : " + selected_date );
        $.ajax({
            url: ajax_url_sch,
            data: {'service_id': service_id, 'btn_class': btn_class, 'date': newdate},
            type: 'GET',
            success: function(res){
                $('.load_scheduler').html(res);
            },
            error: function(err){
               
            }
        });
    });
    $('#select-date').daterangepicker({ 
        "singleDatePicker": true,
    },function(start, end, label) {
        var date = new Date(start.toLocaleString());
        var newdate = moment(date).format('YYYY-MM-DD');
        getAvail(newdate);
    });
});
function getAvail(avail_date){
   $.ajax({
        url: ajax_url_avail,
        data: {'date': avail_date},
        type: 'GET',
        success: function(res){
            $('#avail').html(res);
        },
        error: function(err){
            
        }
    });
}
function ordinal_suffix_of(i) {
    var j = i % 10,
        k = i % 100;
    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
}