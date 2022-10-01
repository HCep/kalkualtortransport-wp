<?php 

function calc_diagonal(){ ?>
 <div class="container" style="order:3;">
 <div class="diag-calc-wrapp">
 <div class="ldm-calc-cnt pb-3">
     <div class="info-cnt d-flex justify-content-end">
         <button class="info-btn"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/question.svg" alt=""> <span>Informacje</span> </button>
     </div>
     <div class="info-cnt">

     </div>
 <div id="commodity">
 <div class="diag-inputs-container">     
       
         <div class="input-container">
         <label for="width">Szerokość</label>
         <br />
         <input class="width form-control second-step-input py-2 px-3"   type="number" id="wi-1" max="245" min="220" name="width" placeholder="szerokość(cm)" /> 
         </div>
         <div class="input-container">
         <label for="long">Długość</label>
         <br />
         <input class="long form-control second-step-input py-2 px-3"  type="number" id="l-1" max="620" min="160" name="long" placeholder="długość(cm)" />
         </div>
         
        
         </div>
         
        
     <input type="button" class="submit btn-calculate-next bg-orange" value="Oblicz Przekątną"  id="calc_diag"/>
            </div>   
    

 </div>
 <div class="result-div">
     <h3>WYNIK PRZEKĄTNEJ</h3>
     <input type="text" id="result_diagonal" name="diagonal" />
 </div>
 </div>
</div>
<script type="text/javascript">
   



jQuery(document).ready(function(){ 

    jQuery('#calc_diag').on('click', function(){
        var firstWI = jQuery("#wi-1").val();
var firstL = jQuery("#l-1").val();
var resDiag = jQuery("#result_diagonal");
var firstStep;

var SecondStep;
       
        firstStep = ((Math.pow(firstWI, 2)) + (Math.pow(firstL, 2)));
        console.log(firstStep); 
        SecondStep = Math.sqrt(firstStep);
        
        SecondStep = SecondStep.toFixed(2);
        jQuery(resDiag).val(SecondStep);
    })



});

</script>
<?php }

add_shortcode('kalkulator-przekatnej', 'calc_diagonal');