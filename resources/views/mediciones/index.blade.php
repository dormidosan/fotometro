@extends('layouts.app')

@section('styles')
<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" -->
<link rel="stylesheet"  href="{{ asset('libs/datepicker/css/bootstrap-datepicker3.min.css') }}"/>
<link rel="stylesheet"  href="{{ asset('libs/datepicker/css/bootstrap-datepicker3.standalone.min.css') }}"/>

@endsection

@section('content')



<img src="images/rasp.jpg" alt="Girl in a jacket" width="200" height="121" style="display: none;" > 
<!-- div class="container-fluid" style="background-image: ur0l('images/rasp.jpg');"  -->
<div class="container-fluid" >

  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">

        <div class="card-header">

         <div class="container-fluid">

          <div class="row">
            <div class="col-sm-4">
              <h3 class="box-title">Grafico Tiempo Real</h3>
            </div>
            <div class="col-sm-8">

            </div>  
          </div>

          <div class="row" style="display: none;">
            <div class="col-sm-2">
              <label for="cars">Real time</label>

              <div class="btn-group btn-group-toggle" id="realtime" data-toggle="buttons">
                <label class="btn btn-outline-primary active" data-toggle="on">
                  <input type="radio" name="options" id="option1" autocomplete="off" checked data-toggle="on"> ON
                </label>
                <label class="btn btn-outline-secondary" data-toggle="off">
                  <input type="radio" name="options" id="option2" autocomplete="off" data-toggle="off" > OFF
                </label>
              </div>


            </div>
            <div class="col-sm-10">

            </div>  

          </div>

        </div>






      </div> <!-- div class="card-header" -->

      <div class="card-body">
        <div id="plot_real_time" style="height: 300px;"></div>
      </div>

    </div> <!-- div class="card" -->
  </div> <!--div class="col-md-10" -->
</div> <!-- div class="row justify-content-center" -->

<br>
<br>
<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="card">

      <div class="card-header">

        <div class="container-fluid">

          <div class="row">
            <div class="col-sm-4">
              <h3 class="box-title">Grafico diario</h3>
            </div>
            <div class="col-sm-8">

            </div>  
          </div>

          <div class="row">
            <div class="col-sm-2">
              <label for="cars">Fecha: </label>

              <div class="input-group date datepicker" >
                <input type="text" class="form-control" name="fecha" id="InputFecha">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <span class="fa fa-calendar"></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-sm-10">

            </div>  

          </div>

        </div>




      </div> <!-- div class="card-header" -->

      <div class="card-body">
        <div id="plot_daily" style="height: 300px;"></div>
      </div>

    </div> <!-- div class="card" -->
  </div> <!--div class="col-md-10" -->
</div> <!-- div class="row justify-content-center" -->

<br>
<br>

<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="card">

      <div class="card-header">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Grafico mensual</h3>  

        <label for="meses">Escoger mes:</label>
        <select name="meses" id="meses">
          <option value="volvo">----</option>
        </select>

        <button id="btnDescargar" class="btn btn-outline-success">Descargar</button>

      </div> <!-- div class="card-header" -->

      <div class="card-body">
        <div id="plot_monthly" style="height: 300px;"></div>
      </div>

    </div> <!-- div class="card" -->
  </div> <!--div class="col-md-10" -->
</div> <!-- div class="row justify-content-center" -->



</div> <!-- div class="container-fluid" -->
@endsection



@section('scripts')
<!-- script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script -->

<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js" integrity="sha512-eO1AKNIv7KSFl5n81oHCKnYLMi8UV4wWD1TcLYKNTssoECDuiGhoRsQkdiZkl8VUjoms2SeJY7zTSw5noGSqbQ==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.resize.min.js" integrity="sha512-9zhTD6cZrwSp3aSDtC2dM9RPiRylLkHphz2DcBPElrql8QK/WVg3iHl2yC/imytI9BpKFzvzHzYHDM/8K9GPeA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.time.min.js" integrity="sha512-lcRowrkiQvFli9HkuJ2Yr58iEwAtzhFNJ1Galsko4SJDhcZfUub8UxGlMQIsMvARiTqx2pm7g6COxJozihOixA==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es-mx.min.js" integrity="sha512-Qy4cmZ6v7vnVEc0cn/BIj9q15eB98do4hMvu8xtc/H+v+YYpdpDrB35flHS3NPLbZUpe1npSYY/u+Gi3UB61vw==" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flot.tooltip/0.9.0/jquery.flot.tooltip.min.js" integrity="sha512-oQJB9y5mlxC4Qp62hdJi/J1NzqiGlpprSfkxVNeosn23mVn5JA4Yn+6f26wWOWCDbV9CxgJzFfVv9DNLPmhxQg==" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ asset('libs/datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script >
 var updateInterval = 4000 //Fetch data ever x milliseconds
 var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching 

 $(function () {

  moment.locale('es-mx');
  $('div.datepicker').datepicker({
    endDate: new Date(),
    autoclose: true,
    language: "es",
    format: "yyyy-mm-dd",
    todayBtn: "linked",
    todayHighlight: true
        // format: "dd-mm-yyyy"
      });

  $('#InputFecha').attr("placeholder", "Ingresar dia");

  $("<div id='tooltip'></div>").css({
    position: "absolute",
    display: "none",
    border: "1px solid #fdd",
    padding: "2px",
    "background-color": "#fee",
    opacity: 0.80
  }).appendTo("body");


  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
    }
  });
  var data = [], totalPoints = 100


  $.ajax({
    type: 'GET',
    url: "{{ route('mediciones.showMeses') }}" ,
    dataType: 'json',
    success: function (result) {
      var res = [];

      console.log(result.data);
      $("#meses").empty();
      
      $("#meses").append('<option value="" disabled selected hidden>Elegir mes</option>');

      $.each(result.data , function(index,row){
         //Use the Option() constructor to create a new HTMLOptionElement.
         var option = new Option(row , index);
                    //Convert the HTMLOptionElement into a JQuery object that can be used with the append method.
                    //$(option).html(row);
                    //Append the option to our Select element.
                    $("#meses").append(option);

                  });       
    }
  });



  var plot_real_time = $.plot('#plot_real_time', [ [1, 3] ], {
    grid  : {
      borderColor: '#f3f3f3',
      borderWidth: 1,
      tickColor  : '#f3f3f3'
    },
    series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#3c8dbc'
      },
      lines : {
        fill : true, //Converts the line chart to area chart
        color: '#3c8dbc'
      },
      yaxis : {
        min : 0,
        max : 1500,
        show: true
      },
      xaxis : {        
        //min : 0,
        //max : 100,
        show: true,
      //  mode: "time",
    //timeformat: "%d/%m %H:%M",
    //tickSize: [1, "hour"],



  }
})


//var fecha_vencimiento = $('input[name=fecha_vencimiento]').val();

graficarDiario('last');

$('div.datepicker').datepicker()
.on('changeDate', function(e) {
  var dailyDate = e.format(0,'yyyy-mm-dd');
  console.log(dailyDate);
  graficarDiario(dailyDate);
        // `e` here contains the extra attributes
      });

graficarMensual('last');
$( "#meses" ).change(function() {

  console.log( this.value );
  graficarMensual(this.value );
});






  



  if (realtime === 'on') {
    update()
  }


  $('#realtime .btn').click(function () {
    if ($(this).data('toggle') === 'on') {
      realtime = 'on';
      console.log('ENCENDIDO');
    }
    else {
      realtime = 'off';
      console.log('APAGADO');
    }
    update()
  })

  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
    + label
    + '<br>'
    + Math.round(series.percent) + '%</div>'
  }


})


 function graficarDiario(fecha) {

  // var plot_daily = $.plot('#plot_daily', [ [1, 3]], {
  //   grid  : {
  //     borderColor: '#f3f3f3',
  //     borderWidth: 1,
  //     tickColor  : '#f3f3f3'
  //   },
  //   series: {
  //       shadowSize: 0, // Drawing is faster without shadows
  //       color     : '#3c8dbc'
  //     },
  //     lines : {
  //       fill : true, //Converts the line chart to area chart
  //       color: '#3c8dbc'
  //     },
  //     yaxis : {
  //       min : 0,
  //       max : 1000,
  //       show: true
  //     },
  //     xaxis : {        
  //       show: true,
  //   }
  // })

  $.ajax({
    type: 'POST',
    url: "{{ route('mediciones.showDaily') }}" ,
    dataType: 'json',
    data: {
      fecha: fecha         
    },
    success: function (result) {
      var res = [];
      var reversed = [];
      console.log(result);

      if (result.exito == 0) {
        alert('NO SE ENCONTRO DATOS: '+ fecha);
        return false;
      }

      $.each(result.data , function(index,row){
       reversed.push(row);  

     });
      reversed.reverse();
      console.log(reversed);

      $.each(reversed , function(index,row){
       res.push([row.hora , row.promedio]);  
     //ticks.push( row.fecha+" "+row.hora  );
   });


      var options = {

        grid  : {
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor  : '#f3f3f3'        
        },
        series: {
            shadowSize: 0, // Drawing is faster without shadows
            color     : '#3c8dbc'
          },
          lines : {
              fill : true, //Converts the line chart to area chart
              color: '#3c8dbc'
            },
            yaxis : {
              min : 0,
              //max : 1000,
              show: true
            },
            xaxis : {        
              show: true
            }
          };
          //[{data: res, label: result.mes}]
          $.plot('#plot_daily', [{data: res, label: result.fecha}], options);        
        }
      });



  
}

function graficarMensual(mes) {

  // var plot_monthly = $.plot('#plot_monthly', [ [1, 3]], {
  //   grid  : {
  //     borderColor: '#f3f3f3',
  //     borderWidth: 1,
  //     tickColor  : '#f3f3f3'
  //   },
  //   series: {
  //       shadowSize: 0, // Drawing is faster without shadows
  //       color     : '#3c8dbc'
  //     },
  //     lines : {
  //       fill : true, //Converts the line chart to area chart
  //       color: '#3c8dbc'
  //     },
  //     yaxis : {
  //       //min : 0,
  //       //max : 1500,
  //       show: true
  //     },
  //     xaxis : {        
  //       show: true,
  //   }
  // });

  $.ajax({
    type: 'post',
    url: "{{ route('mediciones.showMonthly') }}" ,
    dataType: 'json',
    data: {
      mes: mes         
    },
    success: function (result) {
      var res = [];
      var reversed = [];
      console.log(result.data);
      
      console.log(result.mesid);
      $.each(result.data , function(index,row){
       reversed.push(row);  

     });
      reversed.reverse();
      console.log(reversed);

      $.each(reversed , function(index,row){
       res.push([row.dia , row.promedio]);  
     //ticks.push( row.fecha+" "+row.hora  );
   });


      var options = {

        grid  : {        
          borderColor: '#f3f3f3',
          borderWidth: 1,
          tickColor  : '#f3f3f3',
        //hoverable: true,
        //autoHighlight: true,
        //mouseActiveRadius: 1
        hoverable: true, //to trigger plothover event on mouse hover or tap on a point
        //clickable: true //to trigger plotclick event on mouse hover
      },
      series: {
            shadowSize: 0, // Drawing is faster without shadows
            color     : '#3c8dbc',
            lines: { show: true },
            points: { show: true }
          },
          lines : {
              fill : true, //Converts the line chart to area chart
              color: '#3c8dbc'
            },
            yaxis : {
              min : 0,
              //max : 1000,
              show: true
            },
            xaxis : {        
              show: true,
              tickSize : 1,
              //tickDecimals: null,

              ticks: 1, //null or number or ticks array or (fn: range -> ticks array)
              //tickSize: 1, //number or array
              //minTickSize: 1, //number or array
              //tickFormatter: 1, //(fn: number, object -> string) or string
              //tickDecimals: , //null or number

              //labelWidth: 1, //null or number
              //labelHeight: 1, //null or number
              //reserveSpace: true, //null or true
              
              //tickLength: 1, //null or number

              //alignTicksWithAxis: 1, //null or number
            }
          };


          $.plot('#plot_monthly', [{data: res, label: result.mes}], options);    

          $("#plot_monthly").bind("plothover", function (event, pos, item) {
            if (!pos.x || !pos.y) {
              return;
            }
              //alert("You hover at " + pos.x + ", " + pos.y);
              console.log("You hover at " + pos.x + ", " + pos.y);
              // axis coordinates for other axes, if present, are in pos.x2, pos.x3, ...
              // if you need global screen coordinates, they are pos.pageX, pos.pageY

              if (item) {
                  //highlight(item.series, item.datapoint);
                  console.log("hover");
                  //alert("You hover a point!");
                }




                if (item) {
                  console.log(item);
                  var x = item.datapoint[0].toFixed(0),
                  y = item.datapoint[1].toFixed(2);

                  //$("#tooltip").html(item.series.label + " of " + x + " = " + y)
                  $("#tooltip").html(item.series.label + "  dia: " + x + ", Total: " + y)
                  .css({top: item.pageY-35, left: item.pageX+5})
                  .fadeIn(200);
                } else {
                  $("#tooltip").hide();
                }





              });

          $("#plot_monthly").bind("plothovercleanup", function (event, pos, item) {
            $("#tooltip").hide();
          });

          if (result.data == '') {
            $("#btnDescargar").hide();
            alert('NO SE ENCONTRO DATOS: ' + result.mes );                    
          }else{
            $("#btnDescargar").show();            
          }
          document.getElementById("btnDescargar").onclick = function () {                
                var url = '{{ route("mediciones.getDownload", ":mes") }}';
                url = url.replace(':mes', result.mesid);
                console.log(result.mesid);
                console.log(url);
                window.location.href = url;
            };  
          

        }//success: function (result) 


      });
  
}

  // function download(mes) {
  //   $.ajax({
  //     type: 'GET',
  //     url: "{a{ route('mediciones.getDownload') }}" ,
  //     dataType: 'json',
  //     data: {
  //       mes: mes         
  //     },
  //     success: function (result) {
            
  //     }
  //   });
  // }

function formTicks(val, ticksArr) {
  var tick = ticksArr[val];
  var tickRaw = ticksArr[val];

  if ( tick != undefined ) {
    tick = new Date( tick );

    var hours = tick.getHours(),
    minutes = tick.getMinutes();

    tick =  hours+':'+minutes;
    tick = tickRaw;
    tick = moment(tickRaw).format('DD MMM HH:mm');
  }
  else { tick = '' }

    return tick
}


function update() {
  ticks = [];
  $.ajax({
    type: 'GET',
    url: "{{ route('mediciones.showRealTime') }}" ,
    dataType: 'json',
    success: function (result) {
        //var arrayInvertido = [];
        var res = [];
        var reversed = [];
        console.log(result.data);
        
        // $.each(result.data , function(index,row){
        //      //console.log(row.fecha+" "+row.hora + " ++ " +new Date(row.fecha+" "+row.hora).getTime()); 
        //      var c_datetime = new Date(row.fecha+" "+row.hora);
        //      c_datetime.setHours(c_datetime.getHours() - 6);
        //      res.push([c_datetime.getTime(), row.medicion]);  

        //  });

        // $.each(result.data , function(index,row){
        //      //console.log(row.fecha+" "+row.hora + " ++ " +new Date(row.fecha+" "+row.hora).getTime()); 
        //      //var c_datetime = new Date(row.fecha+" "+row.hora);
        //      //c_datetime.setHours(c_datetime.getHours() - 6);
        //      reversed.push(row);  
             
        //    });
        // reversed.reverse();
        // console.log(reversed);

        //$.each(reversed , function(index,row){
        $.each(result.data , function(index,row){
             //console.log(row.fecha+" "+row.hora + " ++ " +new Date(row.fecha+" "+row.hora).getTime()); 
             //var c_datetime = new Date(row.fecha+" "+row.hora);
             //c_datetime.setHours(c_datetime.getHours() - 6);
             res.push([index, row.medicion]);  
             ticks.push( row.fecha+" "+row.hora  );
           });

        //dotsData.push( [i, json[i].value] );

        /*
        parsedTest = jQuery.parseJSON(result); 
        //INVERTIR, YA QUE VIENEN MALOS 
        parsedTest = parsedTest.reverse();
        console.log(parsedTest);
        for (var i = 0; i < parsedTest.length; i++) {
          res.push([i, parsedTest[i]]);          
        }
        console.log(res);
        plot_real_time.setData([res])
        */
        

        //plot_real_time.setData([res]);
        //plot_real_time.setupGrid(); //only necessary if your new data will change the axes or grid
        //plot_real_time.draw();
        var markings = [],
        firstDay = new Date( ticks[0] ).getDate();

        for (var i=1; i<ticks.length; i++) {
          var loopDay = new Date( ticks[i] ).getDate();
          if ( loopDay != firstDay ) {
            var marking = {
              color: '#000000',
              lineWidth: 1,
              xaxis: { from: i, to: i }
            }

            markings.push( marking )

                firstDay = loopDay; // loop through all days
              }
            }


            var options = {
            //grid: { markings: markings },
            //xaxis: { tickFormatter: function(val) { return formTicks(val, ticks) } },


            grid  : {
              borderColor: '#f3f3f3',
              borderWidth: 1,
              tickColor  : '#f3f3f3',
              markings: markings
            },
            series: {
              shadowSize: 0, // Drawing is faster without shadows
              color     : '#3c8dbc',
              lines: { show: true },
              points: { show: true }
            },
            lines : {
              fill : true, //Converts the line chart to area chart
              color: '#3c8dbc'
            },
            yaxis : {
              min : 0,
              max : 1500,
              show: true
            },
            xaxis : {        
              //min : 0,
              //max : 100,
              show: true,
              tickSize : 4,             
              //ticks: 1,
              tickFormatter: function(val) { return formTicks(val, ticks) }
            //  mode: "time",
          //timeformat: "%d/%m %H:%M",
          //tickSize: [1, "hour"],



        }

      };

      $.plot('#plot_real_time', [res], options);

        //plot_real_time.setData([res]);
        //plot_real_time.setData([res]);
        //plot_real_time.setupGrid(); //only necessary if your new data will change the axes or grid
        //plot_real_time.draw();

      }
    });
      //plot_real_time.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
      //plot_real_time.draw()
      if (realtime === 'on'){        
        setTimeout(update, updateInterval);
      }
    // TERMINA UPDATE()
  }


</script>

@endsection