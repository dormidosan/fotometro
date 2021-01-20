@extends('layouts.app')

@section('styles')
<!-- link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" -->
<link rel="stylesheet"  href="{{ asset('libs/datepicker/css/bootstrap-datepicker3.min.css') }}"/>
<link rel="stylesheet"  href="{{ asset('libs/datepicker/css/bootstrap-datepicker3.standalone.min.css') }}"/>

<style type="text/css">
  img.resize {
  max-width:75%;
  max-height:75%;
}

.img-container {
        text-align: center;
        display: block;
      }
</style>

@endsection

@section('content')



<!-- div class="container-fluid" style="background-image: ur0l('images/rasp.jpg');"  -->
<div class="container-fluid" >

  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">

        <div class="card-header">

         <div class="container-fluid">       
          <div class="row">
            <div class="col-sm-4">
              <h3 class="box-title">Mapa anual</h3>
            </div>
            <div class="col-sm-8">
              <label for="anyos">Escoger año:</label>
              <select name="anyos" id="anyos">
                <option value="volvo">----</option>
              </select>
            </div>  
          </div>
        </div>


      </div> <!-- div class="card-header" -->

      <div class="card-body" >
        <span class="img-container">
        <img  id="imagenAnyo" class="resize" src="" alt=""  > 
        </span>
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

<script type="text/javascript">

 $(function () {
   $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
    }
  });

   $.ajax({
    type: 'GET',
    url: "{{ route('mapas.showAnyos') }}" ,
    dataType: 'json',
    success: function (result) {
      var res = [];

      console.log(result.data);
      $("#anyos").empty();
      
      $("#anyos").append('<option value="" disabled selected hidden>Elegir año</option>');

      $.each(result.data , function(index,row){
         //Use the Option() constructor to create a new HTMLOptionElement.
         var option = new Option(row , index);
                    //Convert the HTMLOptionElement into a JQuery object that can be used with the append method.
                    //$(option).html(row);
                    //Append the option to our Select element.
                    $("#anyos").append(option);

                  });       
    }
  });

   $( "#anyos" ).change(function() {

      console.log( this.value );
      mostrargraficoAnual(this.value );
    });


    function mostrargraficoAnual(anyo) {

         $.ajax({
          type: 'post',
          url: "{{ route('mapas.showAnyo') }}" ,
          dataType: 'json',
          data: {
            anyo: anyo         
          },
          success: function (result) {
            
            console.log(result.url);
            
            document.getElementById("imagenAnyo").src = result.url;


              }//success: function (result) 


      });
  
     }

 })




</script>

@endsection