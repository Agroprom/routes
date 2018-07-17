<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Курьеры и регионы</title>
        <script  src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  
        <script  src="/js/site.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    </head>
    <body>
        <div style="width: 1140px; margin: auto; margin-bottom: 20px; " >                    
            <form id="add-trip" action="" accept-charset="utf-8" method="Post">
                <table class="table table-striped table-bordered detail-view"   >
                    <h3 style="text-align: center;">Добавить поездку</h3>
                    <tr>
                        <td>Курьер</td>
                        <td><select name="courier_id" id="courier_id">    
                            </select></td>                    
                    </tr>

                    <tr><td>Регион</td>
                        <td> <select name="region_id" id="region_id"></select></td>
                    </tr>
                    <tr><td>Дата выезда из Москвы </td>
                        <td> <input type="date" id="start_date" name="start_date"></td>    
                    </tr>

                    <tr><td>Дата возвращения</td><td><span id="end_date"></span></td>  </tr>            
                </table>           
                <input type="submit" class="btn btn-primary" value="Добавить">
            </form>
        </div>
        <div style="width: 1140px; margin: auto;" >
            <form id="show-trips" action="" accept-charset="utf-8" method="Post">
                <table class="table table-striped table-bordered detail-view"   >   
                    <tr>
                        <th>Дата выезда из Москвы с</th>
                        <td><input type="date"  name="start_date">  </td> 
                        <th> по</th>
                        <td> <input type="date" name="end_date"></td>    
                        <td> <input type="submit" class="btn btn-primary" value="Посмотреть расписание"></td>
                    </tr>    
                </table>      
            </form>       
        </div>

        <div id="trips">

        </div>        



        <?php
        ?>



        <script>
            $("#add-trip").submit(function (e) {

                var url = "/commands/add-trip.php";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#add-trip").serialize(),
                    success: function (data)
                    {
                        console.log(data);
                        $('#trips').html(data);
                    }
                });

                e.preventDefault();
            });

            $("#show-trips").submit(function (e) {

                var url = "/commands/show-trips.php";

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#show-trips").serialize(),
                    success: function (data)
                    {
                        console.log(data);
                        $('#trips').html(data);
                    }
                });

                e.preventDefault();
            });

            $(document).ready(function (e) {

                getCouriers();
                getRegions();


            });

            $('#start_date').change(function (e) {
                calculateEndDate();
                getAvailCouriersForDate();
            });
            $('#region_id').change(function (e) {
                calculateEndDate();
                getAvailCouriersForDate();
            });



        </script>  
    </body>

</html>

