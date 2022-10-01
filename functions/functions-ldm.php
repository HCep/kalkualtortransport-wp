<?php

function calculate_ldm(){ 
$s1 = get_field('standard_1'); 
$s2 = get_field('standard_2'); 
$s3 = get_field('standard_3'); 
$s4 = get_field('standard_4'); 
$s5 = get_field('standard_5'); 
$s6 = get_field('standard_6'); 

$kat1 = get_field('kat_1');
$kat2 = get_field('kat_2');
$kat3 = get_field('kat_3');
$kat4 = get_field('kat_4');
$kat5 = get_field('kat_5');
$kat6 = get_field('kat_6');

$tr1 = get_field('number_1');
$tr2 = get_field('number_2');
$tr3 = get_field('number_3');
?>
  <div class="container" style="order:3;">
        <div class="ldm-calc-wrapp">
        <div class="ldm-calc-cnt pb-3">
            <div class="info-cnt d-flex justify-content-end">
                <button class="info-btn"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/question.svg" alt=""> <span>Informacje</span> </button>
            </div>
            <div class="info-cnt">

            </div>
        <div id="commodity">
        <div class="ldm-inputs-container">     
                <div class="input-container">
                <label for="sel-1"> Wybierz rozmiar palety:</label>
                <br />
                <select name="selectedt" id="sel-1" class="selected-com second-step-input py-2 px-3">
                <option val="0">Wybierz paletę</option>
                <?php if(!empty($s1['name'])){?>
                <option val="1"><?php echo $s1['name']; ?></option>
                <?php  
                }
                if(!empty($s2['name'])){
                ?>
                <option val="2"><?php echo $s2['name']; ?></option>
                <?php  
                }
                if(!empty($s3['name'])){
                ?>
                <option val="3"><?php echo $s3['name']; ?></option>
                <?php  
                }
                if(!empty($s4['name'])){
                ?>
                <option val="4"><?php echo $s4['name']; ?></option>
                <?php  
                }
                if(!empty($s5['name'])){
                ?>
                <option val="5"><?php echo $s5['name']; ?></option>
                <?php  
                }
                if(!empty($s6['name'])){
                ?>
                <option val="6"><?php echo $s6['name']; ?></option>
                <?php } ?>
                </select>
                </div>
                <div class=" input-container">
                <label for="weight">Waga</label>
                <br />
                <input class="weight form-control second-step-input py-2 px-3" required type="number" id="we-1" max="3500" min="400" name="weight" placeholder="waga(kg)" />
                </div>
                <div class="input-container">
                <label for="height">Wysokość</label>
                <br />
                <input class="height form-control second-step-input py-2 px-3" required type="number" id="h-1" max="270" min="0" name="height" placeholder="wysokość(cm)" /> 
           
                </div>
                <div class="input-container">
                <label for="width">Szerokość</label>
                <br />
                <input class="width form-control second-step-input py-2 px-3"  required type="number" id="wi-1" max="245" min="220" name="width" placeholder="szerokość(cm)" /> 
                </div>
                <div class="input-container">
                <label for="long">Długość</label>
                <br />
                <input class="long form-control second-step-input py-2 px-3" required type="number" id="l-1" max="620" min="160" name="long" placeholder="długość(cm)" />
                </div>
                
                <div class="input-container">
                <label for="quantity">Ilość</label>
                <br />
                <input class="quantity form-control second-step-input py-2 px-3" required type="number" max="9" min="1" id="l-i-1" placeholder="ilość" min="0" max="9" />
                </div>
                </div>
                <div class="field_wrapper"  id="field_wrapper">

                </div>
                <div class="order">
                    <p class="font-weight-bold pt-5">Zamówienie:</p>
                    <div id="transport-order">

                </div>
                
                
                </div>
                   </div>   
            <a href="javascript:void(0);" class="add_button mr-3" title="Dodaj produkt"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check.svg" alt=""> <span>Dodaj towar</span>
            </a>
            <a href="javascript:void(0);" id="add_palet" class="add_goods mr-3" title="Dodaj produkt"> <span>+</span> <span>Kolejny towar</span> </a>

            <input type="button" class="submit btn-calculate-next bg-orange" value="Oblicz LDM"  id="calc_ldm"/>
        </div>
        <div class="result-div">
            <h3>WYNIK LDM</h3>
            <input type="text" id="result_ldm" name="LDM" />
        </div>
        </div>
  </div>
  <script type="text/javascript">
    var wrapp = jQuery('#field_wrapper');
    var weInput = '<input class="weight required second-step-input py-2 px-3" type="number" max="3500" min="400" placeholder="waga(cm)" />';
    var hInput = '<input class="height required second-step-input py-2 px-3" type="number" max="250" min="0" placeholder="wysokość(cm)"  />';
    var wiInput = '<input class="width required second-step-input py-2 px-3" type="number" max="245" min="220" placeholder="szerokość(cm)" />';
    var lInput = '<input class="long  required second-step-input py-2 px-3" type="number" max="620" min="160" placeholder="długość(cm)" />';
    var iInput = '<input class="quantity required second-step-input py-2 px-3" max="9" min="1" type="number" placeholder="ilość" min="0" max="9" />';
    var select = ' <select class="selected-com  second-step-input py-2 px-3"><option val="0">Wybierz standard</option><option val="1"><?php echo $s1['name'];?></option><option val="2">Paleta 120/100</option><option val="3">Paleta 120/120</option><option val="4">Niestandardowe wymiary</option></select>';
  var removeButton ='<a href="javascript:void(0);" class="remove_btn pl-2"><img width="20px" src="<?php echo get_stylesheet_directory_uri(); ?>/images/delete-icon.svg" /></a>';
    var arrayWE = [];
    var arrayWI = [];
    var arrayH = [];
    var arrayL = [];
    var arrayI = [];
    var arraySE = [];
var firstSE = jQuery("select[id ='sel-1']");
var firstWE = jQuery("input[id ='we-1']"); 
var firstWI = jQuery("input[id ='wi-1']");
var firstL = jQuery("input[id ='l-1']");
    var maxField = 10; 
    var addButton = jQuery('.add_button'); 
    var addPal = jQuery('#add_palet');
    var x = 1; 
    var y = 0;
    var inputWE;
    var inputWI;
    var inputL;
    var inputH;
    var inputI;
    var inputSE;
    var sel2O;
    var removeB; 
    var sumArrayWE;
    var sumArrayWI;
    var sumArrayH;
    var sumArrayL;
    var sumArrayI;
    var sumWE;
    var sumWI;
    var sumL;
    var sumH;
    var inputSE; 
    var startR = jQuery('#start');
    var endR = jQuery('#end');
    var hiddenWrapp = jQuery('#hidden-inputs');
    var dWE;
    var dWI;
    var dH;
    var dL;
    var dI;
    var dSE;
    var sumLDM;
    var LDMFirstStep = [];
   var LDMZero;
    var days;
    var date;
    var dateE ;
    var dayE ;
    var monthE;
    var yearE;
    var dayS ;
    var monthS;
    var yearS;
    var maxH;
              
    var radio6 = jQuery('#radio6');             
jQuery(document).ready(function(){
    jQuery("#submit").click(function(event){
   event.preventDefault();
   console.log("RESULT: "+jQuery('#result').val());

    jQuery('#pay-for-order').prop("disabled", false); 
   
  
});
jQuery('#previous2').click(function(){
    jQuery('#pay-for-order').prop("disabled", true); 
    jQuery('#decriptionGoods').remove();
    
});
   
            jQuery(firstSE).on('change', function(){
                var sel1O = jQuery("#sel-1 option:selected").val();
                console.log(sel1O);
                if(sel1O != "Wbierz paletę"){
                    if(sel1O == "<?php echo $s4['name']; ?>"){
                        if(jQuery(<?php echo $s4['width'];?>).length || jQuery(<?php echo $s4['dlong'];?>).length){
                            jQuery(firstWI).prop('disabled', true);
                            jQuery(firstL).prop('disabled', true);
                            jQuery(firstWI).val(<?php echo $s4['width']; ?>);
                            jQuery(firstL).val(<?php echo $s4['dlong']; ?>);   }
                        else{
                            jQuery(firstWI).prop('disabled', false);
                            jQuery(firstL).prop('disabled', false); 
                        }
                    }else{
                    if(sel1O == "<?php echo $s1['name'];?>"){
                        if(jQuery(<?php echo $s1['width'];?>).length || jQuery(<?php echo $s1['dlong'];?>).length){
                            jQuery(firstWI).prop('disabled', true);
                            jQuery(firstL).prop('disabled', true);
                            jQuery(firstWI).val(<?php echo $s1['width']; ?>);
                            jQuery(firstL).val(<?php echo $s1['dlong']; ?>);   }
                        else{
                            jQuery(firstWI).prop('disabled', false);
                            jQuery(firstL).prop('disabled', false); 
                        }   
                    }
                    if(sel1O == "<?php echo $s2['name']; ?>" ){
                            if(jQuery(<?php echo $s2['width'];?>).length || jQuery(<?php echo $s2['dlong'];?>).length){
                                jQuery(firstWI).prop('disabled', true);
                                jQuery(firstL).prop('disabled', true);
                                jQuery(firstWI).val(<?php echo $s2['width']; ?>);
                                jQuery(firstL).val(<?php echo $s2['dlong']; ?>);   }
                            else{
                                jQuery(firstWI).prop('disabled', false);
                                jQuery(firstL).prop('disabled', false); 
                            }  
                        }
                        if(sel1O == "<?php echo $s3['name']; ?>"){
                            if(jQuery(<?php echo $s3['width'];?>).length || jQuery(<?php echo $s3['dlong'];?>).length){
                                jQuery(firstWI).prop('disabled', true);
                                jQuery(firstL).prop('disabled', true);
                                jQuery(firstWI).val(<?php echo $s3['width']; ?>);
                                jQuery(firstL).val(<?php echo $s3['dlong']; ?>);   }
                            else{
                                jQuery(firstWI).prop('disabled', false);
                                jQuery(firstL).prop('disabled', false); 
                            }  
                        }
                        if(sel1O == "<?php echo $s5['name']; ?>"){
                            if(jQuery(<?php echo $s5['width'];?>).length || jQuery(<?php echo $s5['dlong'];?>).length){
                                jQuery(firstWI).prop('disabled', true);
                                jQuery(firstL).prop('disabled', true);
                                jQuery(firstWI).val(<?php echo $s5['width']; ?>);
                                jQuery(firstL).val(<?php echo $s5['dlong']; ?>);   }
                            else{
                                jQuery(firstWI).prop('disabled', false);
                                jQuery(firstL).prop('disabled', false); 
                            }  
                        }     
                        if(sel1O == "<?php echo $s5['name']; ?>"){
                            if(jQuery(<?php echo $s6['width'];?>).length || jQuery(<?php echo $s6['dlong'];?>).length){
                                jQuery(firstWI).prop('disabled', true);
                                jQuery(firstL).prop('disabled', true);
                                jQuery(firstWI).val(<?php echo $s6['width']; ?>);
                                jQuery(firstL).val(<?php echo $s6['dlong']; ?>);   }
                            else{
                                jQuery(firstWI).prop('disabled', false);
                                jQuery(firstL).prop('disabled', false); 
                            }  
                        }                       
                    }
                }
                else{
                alert('Wybierz rodzaj towaru');
                }
                });
    
            jQuery(addPal).click(function(){
            if(x < maxField){ 
                x++;
                jQuery('<br />').appendTo(wrapp);
                        jQuery(select).attr("id", "sel-" + x).appendTo(wrapp);
                        jQuery(weInput).attr("id", "we-" + x).appendTo(wrapp);
                        jQuery(hInput).attr("id", "h-" + x).appendTo(wrapp);
                        jQuery(wiInput).attr("id", "wi-" + x).appendTo(wrapp);
                        jQuery(lInput).attr("id", "l-" + x).appendTo(wrapp);
                        jQuery(iInput).attr("id", "l-i-" + x).appendTo(wrapp);
                      
                     

                        jQuery(removeButton).attr("id", "re-" + x).appendTo(wrapp);
                        var checkExist = setInterval(function() {
                           if (jQuery("select[id ='sel-"+x+"']").length) { 
                       jQuery("select[id ='sel-"+x+"']").on('change', function(){
                           
                           var sel2O = jQuery("select[id ='sel-"+x+"']").val();
                           if(sel2O != "Wbierz paletę"){
                                 if(sel2O == "<?php echo $s4['name']; ?>"){
                                     if(jQuery(<?php echo $s4['width'];?>).length || jQuery(<?php echo $s4['dlong'];?>).length){
                                    
                                    jQuery( "input[id^='wi-"+ x + "']").prop('disabled', true);
                                        jQuery("input[id^='l-"+ x + "']").prop('disabled', true);
                                       jQuery( "input[id^='wi-"+ x + "']").val(<?php echo $s4['width'];?>);
                                       jQuery("input[id^='l-"+ x + "']").val(<?php echo $s4['dlong'];?>);
                                }
                                    else{
                                        jQuery( "input[id^='wi-"+ x + "']").prop('disabled', false);
                                    jQuery("input[id^='l-"+ x + "']").prop('disabled', false);
                                    }
                                 }else{                   
                                       if(sel2O == "<?php echo $s1['name'];?>"){
                    
                                                if(jQuery(<?php echo $s1['width'];?>).length || jQuery(<?php echo $s1['dlong'];?>).length){
                                            
                                            jQuery( "input[id^='wi-"+ x + "']").prop('disabled', true);
                                                jQuery("input[id^='l-"+ x + "']").prop('disabled', true);
                                            jQuery( "input[id^='wi-"+ x + "']").val(<?php echo $s1['width'];?>);
                                            jQuery("input[id^='l-"+ x + "']").val(<?php echo $s1['dlong'];?>);
                                        }
                                            else{
                                                jQuery( "input[id^='wi-"+ x + "']").prop('disabled', false);
                                            jQuery("input[id^='l-"+ x + "']").prop('disabled', false);
                                            }
                                           
                                       }
                                       if(sel2O == "<?php echo $s2['name'];?>"){
                                        if(jQuery(<?php echo $s2['width'];?>).length || jQuery(<?php echo $s2['dlong'];?>).length){
                                            
                                            jQuery( "input[id^='wi-"+ x + "']").prop('disabled', true);
                                                jQuery("input[id^='l-"+ x + "']").prop('disabled', true);
                                            jQuery( "input[id^='wi-"+ x + "']").val(<?php echo $s2['width'];?>);
                                            jQuery("input[id^='l-"+ x + "']").val(<?php echo $s2['dlong'];?>);
                                        }
                                            else{
                                                jQuery( "input[id^='wi-"+ x + "']").prop('disabled', false);
                                            jQuery("input[id^='l-"+ x + "']").prop('disabled', false);
                                            }
                                                  
                                              }
                                        if(sel2O == "<?php echo $s3['name'];?>"){
                                            if(jQuery(<?php echo $s3['width'];?>).length || jQuery(<?php echo $s3['dlong'];?>).length){
                                            
                                            jQuery( "input[id^='wi-"+ x + "']").prop('disabled', true);
                                                jQuery("input[id^='l-"+ x + "']").prop('disabled', true);
                                            jQuery( "input[id^='wi-"+ x + "']").val(<?php echo $s3['width'];?>);
                                            jQuery("input[id^='l-"+ x + "']").val(<?php echo $s3['dlong'];?>);
                                        }
                                            else{
                                                jQuery( "input[id^='wi-"+ x + "']").prop('disabled', false);
                                            jQuery("input[id^='l-"+ x + "']").prop('disabled', false);
                                            }
                                                  
                                        }  
                                        if(sel2O == "<?php echo $s5['name'];?>"){
                                            if(jQuery(<?php echo $s5['width'];?>).length || jQuery(<?php echo $s5['dlong'];?>).length){
                                            
                                            jQuery( "input[id^='wi-"+ x + "']").prop('disabled', true);
                                                jQuery("input[id^='l-"+ x + "']").prop('disabled', true);
                                            jQuery( "input[id^='wi-"+ x + "']").val(<?php echo $s5['width'];?>);
                                            jQuery("input[id^='l-"+ x + "']").val(<?php echo $s5['dlong'];?>);
                                        }
                                            else{
                                                jQuery( "input[id^='wi-"+ x + "']").prop('disabled', false);
                                            jQuery("input[id^='l-"+ x + "']").prop('disabled', false);
                                            }
                                                  
                                        }  
                                        if(sel2O == "<?php echo $s6['name'];?>"){
                                            if(jQuery(<?php echo $s6['width'];?>).length || jQuery(<?php echo $s6['dlong'];?>).length){
                                            
                                            jQuery( "input[id^='wi-"+ x + "']").prop('disabled', true);
                                                jQuery("input[id^='l-"+ x + "']").prop('disabled', true);
                                            jQuery( "input[id^='wi-"+ x + "']").val(<?php echo $s6['width'];?>);
                                            jQuery("input[id^='l-"+ x + "']").val(<?php echo $s6['dlong'];?>);
                                        }
                                            else{
                                                jQuery( "input[id^='wi-"+ x + "']").prop('disabled', false);
                                            jQuery("input[id^='l-"+ x + "']").prop('disabled', false);
                                            }
                                                  
                                        }  
                               }
                           }   
                        }); 
                           
                       clearInterval(checkExist); 
                   }
                       }, 100);
                      removeB = jQuery("a[id^='re-"+ x + "']");
                     jQuery(removeB).on('click', function(){
                            console.log('Y: '+y);
                        if(y == 2 || y > 2){
                        jQuery("#order-"+y).remove();
                        jQuery("#order-result-"+y).remove();
                       
                        }
                                     jQuery("#l-i-"+x+"").remove();
                                     jQuery("#wi-"+x+"").remove();
                                     jQuery("#we-"+x+"").remove();
                                     jQuery("#l-"+x+"").remove();
                                     jQuery("#sel-"+x+"").remove();
                                     jQuery("#h-"+x+"").remove();
                                     jQuery("a[id^='re-"+ x + "']").remove();
                                     if(arrayWE.length){
                                     arrayWE.splice(-1);
                                arrayWI.splice(-1);
                                arrayH.splice(-1);
                                arrayL.splice(-1);
                                arrayI.splice(-1);  
                                LDMFirstStep.splice(-1);  }                       
                             x--;
                                     }); 
                }
                });

                jQuery(addButton).click(function(){
                if(x < maxField){ 
                    y++;
                            inputWE = jQuery("input[id^='we-"+ y + "']");
                            inputWI = jQuery("input[id^='wi-"+ y + "']");
                            inputH = jQuery("input[id^='h-"+ y + "']");
                            inputL = jQuery("input[id^='l-"+ y + "']");
                            inputI = jQuery("input[id^='l-i-"+ y + "']");
                           inputSE = jQuery("select[id^='sel-"+ y + "']");
                           arrayWE.push(jQuery(inputWE).val()*jQuery(inputI).val());
                            arrayWI.push(jQuery(inputWI).val()*jQuery(inputI).val());
                            arrayL.push(jQuery(inputL).val()*jQuery(inputI).val());
                            arrayH.push(jQuery(inputH).val());
                            arrayI.push(jQuery(inputI).val());
                            maxH = Math.max.apply(Math, arrayH);
                            maxWI = Math.max.apply(Math, arrayWI);
                            maxL = Math.max.apply(Math, arrayL);
                            sumWE = 0;
                            jQuery.each(arrayWE,function(){sumWE+=parseFloat(this) || 0;});
                            sumWI = 0;
                            jQuery.each(arrayWI,function(){sumWI+=parseFloat(this) || 0;});
                            sumL = 0;
                            jQuery.each(arrayL,function(){sumL+=parseFloat(this) || 0;});  
                            sumLDM = 0;
                                jQuery.each(LDMFirstStep,function(){sumLDM+=parseFloat(this) || 0;});
                                sumLDM = sumLDM.toFixed(2);
                           if (!jQuery(inputWE).val() || !jQuery(inputWI).val() || !jQuery(inputH).val() || !jQuery(inputL).val() || !jQuery(inputI).val()) {  
                                alert('Wproawdź wszystkie dane!');
                                arrayWE.splice(-1);
                                arrayWI.splice(-1);
                                arrayH.splice(-1);
                                arrayL.splice(-1);
                                arrayI.splice(-1);  
                                LDMFirstStep.splice(-1); 
                                y--;                                                                   
                           }else if(jQuery(inputWE).val() >= 3500 || !jQuery(inputWI).val() >= 245 || !jQuery(inputH).val() >= 250|| !jQuery(inputL).val() >= 620 || !jQuery(inputI).val() >= 10){
                                alert(' Wprowadzono za duże wartości! \n Maksymalne wartości: \n Waga: 3500kg \n Szerokość: 245cm \n Wysokość: 250cm \n Długość: 620cm \n Ilość: 9' );
                                arrayWE.splice(-1);
                                arrayWI.splice(-1);
                                arrayH.splice(-1);
                                arrayL.splice(-1);
                                arrayI.splice(-1);  
                                LDMFirstStep.splice(-1); 
                                y--;         
                           }
                          else if(maxH >= 270){  
                                alert('Za wysoki towar! O ile to możliwe, przepakuj proszę towar na dwie palety lub zmniejsz jego wysokość.');
                                arrayH.splice(-1);
                                y--;
                                }else  if(sumWE >= 3500){
                                    alert('Za ciężki towar! Maksymalna łączna waga towaru to 3500kg');       
                                    arrayWE.splice(-1);    
                                       y--;                                
                    
                                }else if(maxWI >= 245) {
                                    alert('Za szeroki towar! Maksymalna łączna szerokość towaru to 250 cm');       
                                    arrayWI.splice(-1);
                                    y--;                            
                                } else if (maxL >= 620){
                                    alert('Za duża długość towaru! Maksymalna łączna długość to 620 cm');     
                                    arrayL.splice(-1);
                                    y--;
                                }
                           else{
                            console.log("DOBRZE!");
                            LDMZero = (jQuery(inputL).val()*jQuery(inputWI).val()*jQuery(inputI).val());
                            LDMFirstStep.push(((LDMZero*0.4)/0.96)/10000);
                           dSE = jQuery('<input type="hidden">');
                        jQuery(dSE).attr("name", "sel-"+x);
                        jQuery(dSE).attr("value", jQuery(inputSE).val());
                        jQuery(dSE).appendTo(hiddenWrapp);
                        dWE = jQuery('<input type="hidden">');
                        jQuery(dWE).attr("name", "we-"+x);
                        jQuery(dWE).attr("value", jQuery(inputWE).val());
                        jQuery(dWE).appendTo(hiddenWrapp);
                        dWI = jQuery('<input type="hidden">');
                        jQuery(dWI).attr("name", "wi-"+x);
                        jQuery(dWI).attr("value", jQuery(inputWI).val());
                        jQuery(dWI).appendTo(hiddenWrapp);
                        dH = jQuery('<input type="hidden">');
                        jQuery(dH).attr("name", "h-"+x);
                        jQuery(dH).attr("value", jQuery(inputH).val());
                        jQuery(dH).appendTo(hiddenWrapp);
                        dL = jQuery('<input type="hidden">');
                        jQuery(dL).attr("name", "l-"+x);
                        jQuery(dL).attr("value", jQuery(inputL).val());
                        jQuery(dL).appendTo(hiddenWrapp);
                        dI = jQuery('<input type="hidden">');
                        jQuery(dI).attr("name", "l-i-"+x);
                        jQuery(dI).attr("value", jQuery(inputI).val());
                        jQuery(dI).appendTo(hiddenWrapp);
                        jQuery('#calc_ldm').on('click', function(){
                                    console.log('SUM LDM 2 '+ sumLDM);
                  
                        if(sumLDM >= 0){
                        jQuery('#result_ldm').val(sumLDM);
                        }else{
                            alert('Wprowadź dane!');
                        }
              });
                            jQuery('<p class="your-order" id="order-'+y+'"><strong> Standard:</strong> '+jQuery(inputSE).val()+' <strong> Waga:</strong> '+jQuery(inputWE).val()+'kg <strong>Szerokość:</strong> '+jQuery(inputWI).val()+'cm <strong>Wysokość:</strong> '+jQuery(inputH).val()+'cm <strong>Długość:</strong> '+jQuery(inputL).val()+'cm <strong>Ilość:</strong> '+jQuery(inputI).val()+'x </p>').appendTo('#transport-order');
                            jQuery(removeButton).attr("id", "re-" + x).appendTo('#order-'+y);
                            jQuery('<p class="your-order" id="order-result-'+y+'"><strong> Standard:</strong> '+jQuery(inputSE).val()+' <strong> Waga:</strong> '+jQuery(inputWE).val()+'kg <strong>Szerokość:</strong> '+jQuery(inputWI).val()+'cm <strong>Wysokość:</strong> '+jQuery(inputH).val()+'cm <strong>Długość:</strong> '+jQuery(inputL).val()+'cm <strong>Ilość:</strong> '+jQuery(inputI).val()+'x </p>').appendTo('#order-trans');           
                        }
                            removeB = jQuery("a[id^='re-"+ y + "']");
                     jQuery(removeB).on('click', function(){
                        jQuery(this).closest("#order-"+y).remove();
                        jQuery(this).closest("#order-result-"+y).remove();
                                arrayWE.splice(-1);
                                arrayWI.splice(-1);
                                arrayH.splice(-1);
                                arrayL.splice(-1);
                                arrayI.splice(-1);  
                                LDMFirstStep.splice(-1);  
                             y--;
                            
                                     });
                    }
        });
       
   jQuery('#next2').on('click', function(){
    var text = jQuery('textarea#area').val();
    if(text.length){
        jQuery('<p class="your-order" id="decriptionGoods">Opis towaru: '+ text +'</p>').appendTo('#order-trans'); 
    }else{
        alert('Proszę opisać towar!');
    }
    if(sumWE >= 1201){
               
               if( sumLDM <= 2.10 && sumWE <= 1201 && sumL <= 206.5 ){
                  
                   jQuery('#transport-kat').html('<p><?php echo $kat4; ?></p>');
                   dT = jQuery('<input type="hidden">');
                       jQuery(dT).attr("name", "transport");
                       jQuery(dT).attr("value", "<?php echo $kat4; ?>");
                       jQuery(dT).appendTo(hiddenWrapp);

                   
               }else if( sumLDM <= 4.20 && sumWE <= 2332 && sumL <= 413 ) {

                   jQuery('#transport-kat').html('<p><?php echo $kat5; ?></p>');
                   dT = jQuery('<input type="hidden">');
                       jQuery(dT).attr("name", "transport");
                       jQuery(dT).attr("value", "<?php echo $kat5; ?>");
                       jQuery(dT).appendTo(hiddenWrapp);
                  
               }else  if( sumLDM <= 6.30 && sumWE <= 3500 && sumL <= 620 ){

                 
               jQuery('#transport-kat').html('<p><?php echo $kat6; ?></p>');
               dT = jQuery('<input type="hidden">');
                       jQuery(dT).attr("name", "transport");
                       jQuery(dT).attr("value", "<?php echo $kat6; ?>");
                       jQuery(dT).appendTo(hiddenWrapp);
             
                   }
              
           }else{
              
               if(sumWE < 1201){
                  
                   if( sumLDM <= 1.33 && sumWE <= 400 && sumL <= 160 ){
                   
                       jQuery('#transport-kat').html('<p><?php echo $kat1; ?></p>');
                       dT = jQuery('<input type="hidden">');
                       jQuery(dT).attr("name", "transport");
                       jQuery(dT).attr("value", "<?php echo $kat1; ?>");
                       jQuery(dT).appendTo(hiddenWrapp);
                     
                   }else  if( sumLDM <= 2.66 && sumWE <= 800 && sumL <= 320 ) 
               
                  {
                      
                   jQuery('#transport-kat').html('<p><?php echo $kat2; ?></p>');
                   dT = jQuery('<input type="hidden">');
                       jQuery(dT).attr("name", "transport");
                       jQuery(dT).attr("value", "<?php echo $kat2; ?>");
                       jQuery(dT).appendTo(hiddenWrapp);
                  
                       }
                else if( sumLDM <= 4 && sumWE <= 1200 && sumL <= 480 ){
                   
               jQuery('#transport-kat').html('<p><?php echo $kat3; ?></p>');
               dT = jQuery('<input type="hidden">');
                       jQuery(dT).attr("name", "transport");
                       jQuery(dT).attr("value", "<?php echo $kat3; ?>");
                       jQuery(dT).appendTo(hiddenWrapp);
             
                   }     
           }
       }
   });

    jQuery('#next1').on('click', function(){
            var startDate = jQuery('#dateFrom').val();
            var endDate = jQuery('#dateTo').val();
            var start = new Date(startDate);
            var end = new Date(endDate);
            var diffDate = (end - start) / (1000 * 60 * 60 * 24);
            days = Math.round(diffDate);

            date = new Date(jQuery('#dateFrom').val());
             dateE = new Date(jQuery('#dateTo').val());
             dayE = dateE.getDate();
             monthE = dateE.getMonth() + 1;
             yearE = dateE.getFullYear();
            
             dayS = date.getDate();
             monthS = date.getMonth() + 1;
             yearS = date.getFullYear();
            console.log('data nadania: '+[dayS, monthS, yearS].join('/'));
            console.log('data dostawy: '+[dayE, monthE, yearE].join('/'));
          
            jQuery('#data-picker-order').remove();
          console.log('Usunięto!');
            jQuery('<p id="data-picker-order"><strong>DATA NADANIA:</strong> '+[dayS, monthS, yearS].join("/")+' <strong>DATA DOSTAWY:</strong> '+[dayE, monthE, yearE].join("/")+'</p>').appendTo(jQuery('#date-info'));
       
          
      
   
        });
           
        jQuery('#submit').on('click', function () {
        
            jQuery('<p>LDM: '+sumLDM+'</p>' ).appendTo(jQuery('#ldm'));
              if(sumLDM >= 6.3)
            {
               
              
            alert('Towar zajmuje zbyt dużą powierzchnie. LDM wynosi: '+sumLDM);}
            else { if(days >= 3){
                             var summaryPrice = total*(<?php echo $tr3; ?>);
                             console.log('summaryPrice3: '+summaryPrice);
                             var sumRound = Math.ceil(summaryPrice);
                             console.log('sumRound3: '+sumRound);
                            var result = sumRound*1.23;
                            console.log('result3: '+result);
                             var localResult3 = localStorage.getItem('result3');
                             jQuery('#netto').val(sumRound.toFixed(2));
                               jQuery('#result').val(result);
                               localStorage.setItem('result3', result);
             
                 
                           }else if(days === 2 && days > 1){
                               var stawka = <?php echo $tr2; ?>;
                            var summaryPrice = total* stawka;
                            console.log('stawka: '+ stawka);
                            console.log('summaryPrice2: '+summaryPrice);
                            var sumRound = Math.ceil(summaryPrice);
                            console.log('sumRound2: '+sumRound);
                            var result = sumRound*1.23;
                            console.log('result2: '+result);
                            var localResult2 = localStorage.getItem('result2');
                            localStorage.setItem('result2', result);
                            jQuery('#netto').val(sumRound.toFixed(2));
                               jQuery('#result').val(result);
                              
                            
                            
                           }else if(days === 1){
                            var summaryPrice = total*(<?php echo $tr1; ?>);
                            console.log('summaryPrice: '+summaryPrice);
                           
                            var sumRound = Math.ceil(summaryPrice);
                            console.log('sumRound: '+sumRound);
                            var result = sumRound*1.23;
                            console.log('result: '+result);
                            var localResult1 = localStorage.getItem('result1');
                            jQuery('#netto').val(sumRound.toFixed(2));
                               jQuery('#result').val(result);
                               localStorage.setItem('result1', result);
                               }else if(days <= 0){
                            alert('Wybierz właściwą datę!')
                        }
                    }
          
                                        
                 });
});

</script>

<?php } 
add_shortcode('calculate-ldm', 'calculate_ldm');