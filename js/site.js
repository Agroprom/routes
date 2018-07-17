function getCouriers() {
    $.ajax({
        type: "POST",
        url: "/commands/get-couriers.php",
        // data: $("#add-trip").serialize(), 
        success: function (data)
        {
          //  console.log(data);
            $('#courier_id').html(data);
        }
    });

}
function getRegions() {
    $.ajax({
        type: "POST",
        url: "/commands/get-regions.php",
        // data: $("#add-trip").serialize(), 
        success: function (data)
        {
           // console.log(data);
            $('#region_id').html(data);
        }
    });

}

function calculateEndDate() {
    var data = new Object();
    data.region_id = $('#region_id').val();
    data.start_date = $('#start_date').val();


    console.log(data);
    $.ajax({
        type: "POST",
        url: "/commands/calculate-end-date.php",
        data: data,
        success: function (data)
        {
            // console.log(data); 
            $('#end_date').html(data);
        }
    });

}

function getAvailCouriersForDate() {
    var data = new Object();
    data.start_date = $('#start_date').val();
    $.ajax({
        type: "POST",
        url: "/commands/get_avail_couriers_for_date.php",
        data: $("#add-trip").serialize(),
        success: function (data)
        {
            //console.log(data);
            $('#courier_id').html(data);
        }
    });

}