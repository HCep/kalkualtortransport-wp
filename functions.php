<?php
add_filter('widget_text', 'do_shortcode');
$roots_includes = array(
    '/functions/functions-page.php',
    '/functions/functions-ldm.php',
    '/functions/functions-przekatna.php'
   
  );
  
  foreach($roots_includes as $file){
    if(!$filepath = locate_template($file)) {
      trigger_error("Error locating `$file` for inclusion!", E_USER_ERROR);
    }
  
    require_once $filepath;
  }
  unset($file, $filepath);

function register_my_session()
{
  if( !session_id() )
  {
    session_start();
	
if(isset($_POST['sub'])){
   
    
	$_SESSION['calculate_result'] = $_POST['result'];
	$_SESSION['netto_result'] = $_POST['netto'];
	
	$_SESSION['sub_result'] = $_POST['sub'];
    $_SESSION['weight_res'] = $_POST['weight'];
    $_SESSION['date_from'] = $_POST['dateFrom'];
    $_SESSION['dateToo'] = $_POST['dateTo'];
    $_SESSION['wrom'] = $_POST['fromTo'];
    $_SESSION['do'] = $_POST['endTo'];
    $_SESSION['vehicle'] = $_POST['transport'];

    $_SESSION['textarea'] = $_POST['area'];

    $x = 0;
    $max = 10;
while($x < $max){
    $x++;
   if(!empty($_POST['sel-'.$x])){
    $_SESSION['we-'.$x] = $_POST['we-'.$x];
    $_SESSION['sel-'.$x] = $_POST['sel-'.$x];
    $_SESSION['wi-'.$x] = $_POST['wi-'.$x];
    $_SESSION['h-'.$x] = $_POST['h-'.$x];
    $_SESSION['l-i-'.$x] = $_POST['l-i-'.$x];
    $_SESSION['l-'.$x] = $_POST['l-'.$x];

   
   
}else{
    break;
}
}
  
 
}}

  
}

add_action('init', 'register_my_session');

add_action( "wp_enqueue_scripts", "enqueue_wp_child_theme" );
function enqueue_wp_child_theme() 
{
  
    wp_enqueue_script( 'bootstrap-js',  get_stylesheet_directory_uri() . '/inc/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );
    wp_enqueue_style( 'bootstrap-css',  get_stylesheet_directory_uri() . '/inc/bootstrap.min.css', array(), '4.3.1', 'all' );
    if(is_front_page() || is_page('kalkulator-transportu') || is_page('kalkulator-ldm')):
 	wp_enqueue_script( 'maps-js',  get_stylesheet_directory_uri() . '/js/maps.js', array( 'jquery' ), 'all' );
 	wp_enqueue_script( 'custom-js',  get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), 'all' );
	endif;
	wp_enqueue_style("child-css", get_stylesheet_uri());
	wp_enqueue_style("custom", get_stylesheet_directory_uri()."/css/custom.css");

    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700|Seaweed+Script' );

	wp_enqueue_script("child-js", get_stylesheet_directory_uri() . "/js/script.js", array( "jquery" ), "1.0", true );
	

}



//////////////////////////////////////////////////////////////////////////////////////////////
///// Kalkulator - transportu ////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

    add_filter( 'woocommerce_get_price_html', 'bbloomer_alter_price_display', 9999, 2 );
 
function bbloomer_alter_price_display( $price_html, $product ) {
    
  
        $orig_price = wc_get_price_to_display( $product );
		if(isset($_SESSION['sub_result'])){
            if(is_numeric($_SESSION['calculate_result'])){
               
			$sessionSum = $_SESSION['calculate_result'];
        $price_html = wc_price( $orig_price = $sessionSum );
      
    
    }}
   
    return $price_html;
    
 
}
add_action( 'woocommerce_before_calculate_totals', 'bbloomer_alter_price_cart', 9999 );
 
function bbloomer_alter_price_cart( $cart ) {

    foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $price = $product->get_price();
		if(isset($_SESSION['sub_result'])){
            if(is_numeric($_SESSION['calculate_result'])){
              
			$sessionSum = $_SESSION['calculate_result'];
        $cart_item['data']->set_price( $price = $sessionSum);
        
    }}}
   
}


function calculate_form(){?>
<?php 
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

<?php if(is_front_page()){ ?>
    <section class="calc-wrapp" >
   <div class="calculator-container">
    <?php if(get_locale() == "en_GB"){ ?>
   <div><p id="zip-button" style="cursor:pointer">EXPAND</p></div>
   <?php }else{ ?>
    <div><p id="zip-button" style="cursor:pointer">ROZWIŃ</p></div>
    <?php } ?>
<?php }else { ?>
    <section class="calc-wrapp" style="order:3;">
    <div class="container">
<?php } ?>
    <div class="progress">
    <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
  </div>
  <div class="panel-group">
    <div class="panel panel-primary">
     <div class="panel-heading">
        <div class="row">
            <div class="col-4">
            Trasa
            </div>
            <div class="col-4">
            Zamówienie
            </div>
            <div class="col-4">
            Bilans
            </div>
        </div> 
        </div>
        <form action="/?add-to-cart=332&quantity=1" method="post" novalidate>
        <div class="form-horizontal" id="multistep_form">
      
            <fieldset id="account">
            <div class="panel-body"><h4>Krok 1 - Trasa i data</h4>
                 
            <section id="firststep">
                <header>
                    <p class="my-3" style="font-size:14px;">Wyznacz trasę wpisując dokładny adres w polu SKĄD oznaczającym miejsce skąd ma być zabrany towar i w polu DOKĄD oznaczającym gdzie ma być dokonany rozładunek.</p>
                    <p class="my-3" style="font-size:14px;">Jeśli napotkałeś problem podczas wyliczania stawki przez Nasz kalkulator skontaktuj się z nami przez <a href="https://dev.tymtrans.eu/kontakt/" style="color:#0069b2;"> formularz kontaktowy </a> lub złóż <a style="color:#0069b2;" href="https://dev.tymtrans.eu/zapytanie-ofertowe/"> zapytanie ofertowe. </a>
                </header>
            <div class="container mx-auto">
            <div class="row">
            <div class="col-md-4 mx-0  ">
            <div class="row flex-column justify-content-between">
            <div id="locations" class="location-cnt p-3">
                <div class="form-group">
                    <label>
                     SKĄD
                    </label>
                    <br />
                    <div class="d-flex">
                    <img class="pr-3" src="<?php echo get_stylesheet_directory_uri(); ?>/images/marker-blue.svg" alt="">
                    <input placeholder="Np. Agrykola 1, 00-460 Warszawa" id="start" name="fromTo" type="text" class="first-step-input w-100">
                    </div>
                </div>
                <div class="form-group">
                    <label>
                     DOKĄD </label>
                     <br />
                     <div class="d-flex">
                     <img class="pr-3" src="<?php echo get_stylesheet_directory_uri(); ?>/images/marker-orange.svg" alt="">
                    <input placeholder="Np. Rue de Rivoli, 75001 Paris, Francja" id="end" name="endTo" type="text" class="first-step-input w-100">
                    </div>
                </div>
                <div class="form-group">
                    <input type="button" value="TRASA" id="calc_km" class="btn-calculate-sub bg-orange" data-scroll>
                    </div>
                </div>
                <div class="date-picker mt-3 p-3">
                <label>DATA NADANIA
                <input class="p-3 first-step-input" type="date" id="dateFrom" name="dateFrom" /></label>
                <label class="pt-3">DATA DOSTAWY
                <input class=" p-3 first-step-input" type="date" id="dateTo" name="dateTo" /></label>
                </div>
            </div>
            </div>
            <div class="col-md-5 px-md-3 px-0 mx-0" >
                <div class="map-position">
                <div id="map"></div>
                </div>
                </div> 
                <div class="col-md-3 px-0 mx-0 summary-cnt">
                 <h3 class="title-summary w-100 d-block font-weight-bold text-white uppercase text-center p-3">PODSUMOWANIE</h3>
                   <div class="p-3 d-flex flex-wrap">
                   <span class="">TRASA:</span>
                   <input disabled id="from" name="from" type="text" style="border:0px; display:block; width:100%;">
                   <input disabled id="to" name="to" type="text" style="border:0px; display:block; width:100%;"> 
                   </div>
                   <div class="grey-bg p-3">
                       <section id="results d-flex">
                    <div id="warnings-panel"></div>
                    <span>LICZBA KM:</span> <input class="inline" disabled id="total" name="total" type="text" style="border:0px; background-color:transparent;" />
                   
                </section>
                   </div> 
            </div>
            </div>
            </div>
            <div class="col-12 mx-auto text-center my-3"> 
                  <p class="next btn-calculate-next" id="next1" name="password"><span class="pr-2">DALEJ</span> <img width="20px" src="<?php echo get_stylesheet_directory_uri(); ?>/images/next-caret.svg" alt=""></p>  
                  </div> 
            </div>
            </fieldset>
            <fieldset id="personal">
             <section id="wyliczenia">
    <header><h3 class="text-center font-weight-bold py-3">Krok 2 - Zamówienie</h3></header>
        <div class="container px-0">
       
        <div class="calc-wrap justify-content-between">
        <div class="calc-cnt pb-3">
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
                <div class="field_wrapper mt-3"  id="field_wrapper">

                </div>
                <div class="order">
                    <p class="font-weight-bold pt-5">Zamówienie:</p>
                    <div id="transport-order">

                </div>
                
                
                </div>
                   </div>   
            <a href="javascript:void(0);" class="add_button mr-3" title="Dodaj produkt"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check.svg" alt=""> <span>Dodaj do zamówienia</span>
            </a>
            <a href="javascript:void(0);" id="add_palet" class="add_goods" title="Dodaj produkt"> <span>+</span> <span>Kolejny towar</span> </a>
            <p class="font-weight-bold pt-5 text-gray">Opisz w jednym zdaniu rodzaj towaru, który chcesz przetransportować:</p>
            <textarea name="area" id="area" ></textarea>

            <div class="d-flex justify-content-start text-center my-3">
                <p type="button" name="previous" class="previous btn-calculate-next mr-3"  id="previous1">WSTECZ</p>
                <p class="next btn-calculate-next" id="next2" name="password"><span class="pr-2">DALEJ</span> <img width="20px" src="<?php echo get_stylesheet_directory_uri(); ?>/images/next-caret.svg" alt=""></p>  
            </div> 
        </div>
    <div class="col-lg-3 px-0 mx-0 summary-cnt">
                 <h3 class="title-summary w-100 d-block font-weight-bold text-white uppercase text-center p-3">PODSUMOWANIE</h3>
                   <div class="p-3 d-flex flex-wrap">
                   <span class="">TRASA:</span>
                   <input disabled id="fromTwo" class="result-input" name="fromTwo" type="text" value="" style="display:block; width:100%;">
                   <input disabled id="toTwo" class="result-input" name="toTwo" type="text" value="" style="display:block; width:100%;"> 
                   </div>
                   <div class="grey-bg p-3">
                       <section id="results d-flex">
                    <div id="warnings-panel"></div>
                    <span>LICZBA KM:</span> <input class="inline" disabled id="totalTwo" name="totalTwo" type="text" style="border:0px; background-color:transparent;" />
                </section> 
            </div>  
           
            </div>
           
            </fieldset>
            <fieldset id="contact">
             <div class="panel-body"><h4>Krok 3: Podsumowanie</h4><br>
                  
        <div class="col-12">
        <div class="order-summary card p-3">
            <h4>Twoje zamówienie:</h4>
            <p>Trasa:</p>
            
                <div class="map-position">
                <div id="map2"></div>
                </div>
                 
            <div id="road" class="d-flex flex-wrap my-3">
               <label><strong>SKĄD: </strong> <input type="text" disabled id="startT" class="result-input mr-3"></label>
               <label><strong>DOKĄD: </strong> <input type="text" disabled id="endD" class="result-input"></label>
            </div>
            <hr class="mt-2">
            <p>Data:</p>
            <div id="date-info">

            </div>
            <hr class="mt-2">
         
            <p>Twój towar:</p>
            <div id="order-trans"></div>
            <div class="order-res">

            </div>
            <h4 class="head-kat">Kategoria pojazdu:</h4>
            <div id="transport-kat">
            </div> 
           
        </div>
       

            <input type="button" name="previous" class="previous btn-calculate-next bg-orange" value="WSTECZ" id="previous2" />
            <input type="button" class="submit btn-calculate-next bg-orange" value="Oblicz koszt transportu" id="submit"/>
            
            <input type="submit" id="pay-for-order" class="btn-calculate-next bg-orange" disabled name="sub" value="ZAMAWIAM" />
            <hr class="my-2">
            <div class="d-flex justify-content-between result-container flex-wrap">
            <span >Cena netto: </span>
            <input type="text" id="netto" name="netto" class="result-input" />
            <span class="pr-md-5" >VAT: 23% </span>
            
            <span >Cena brutto: </span>
            <input type="text" id="result" name="result" class="result-input" />
          
            </div>
            <hr class="my-2">
            
        <div id="hidden-inputs">
            
        </div>
       
                    
                </div>
            </div>
            </fieldset>
            
        </div>
        </form>
      </div>
    </div>
   
</div>
</section>
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
    jQuery('#zip-button').on('click', function() {
  
        if(jQuery('.calculator-container').hasClass('show-cnt')){
            jQuery('.calculator-container').removeClass('show-cnt');
            <?php if(get_locale()=='en_GB'){ ?>
            jQuery('#zip-button').text('EXPAND');
            <?php }else { ?>
                jQuery('#zip-button').text('ROZWIŃ');
            <?php } ?>
        }else{
            jQuery('.calculator-container').addClass('show-cnt');
            <?php if(get_locale()=='en_GB'){ ?>
            jQuery('#zip-button').text('COLLAPSE');
            <?php }else { ?>
                jQuery('#zip-button').text('ZWIŃ');
            <?php } ?>
        }
    });
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
                        if(y <= 2){
                        jQuery("#order-"+y).remove();
                        jQuery("#order-result-"+y).remove();
                        }
                                jQuery(this).closest("#l-i-"+x+"").remove();
                                jQuery(this).closest("#wi-"+x+"").remove();
                                jQuery(this).closest("#we-"+x+"").remove();
                                jQuery(this).closest("#l-"+x+"").remove();
                                jQuery(this).closest("#sel-"+x+"").remove();
                                jQuery(this).closest("#h-"+x+"").remove();
                                jQuery(this).closest("a[id^='rem-"+ x + "']").remove();
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
                            jQuery('<p class="your-order" id="order-'+y+'"><strong> Standard:</strong> '+jQuery(inputSE).val()+' <strong> Waga:</strong> '+jQuery(inputWE).val()+'kg <strong>Szerokość:</strong> '+jQuery(inputWI).val()+'cm <strong>Wysokość:</strong> '+jQuery(inputH).val()+'cm <strong>Długość:</strong> '+jQuery(inputL).val()+'cm <strong>Ilość:</strong> '+jQuery(inputI).val()+'x </p>').appendTo('#transport-order');
                            jQuery(removeButton).attr("id", "re-" + x).appendTo('#order-'+y);
                            jQuery('<p class="your-order" id="order-result-'+y+'"><strong> Standard:</strong> '+jQuery(inputSE).val()+' <strong> Waga:</strong> '+jQuery(inputWE).val()+'kg <strong>Szerokość:</strong> '+jQuery(inputWI).val()+'cm <strong>Wysokość:</strong> '+jQuery(inputH).val()+'cm <strong>Długość:</strong> '+jQuery(inputL).val()+'cm <strong>Ilość:</strong> '+jQuery(inputI).val()+'x </p>').appendTo('#order-trans');           
                        }
                            removeB = jQuery("a[id^='re-"+ x + "']");
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
<?php
}
add_shortcode('calculate-form', 'calculate_form');
add_action( 'woocommerce_after_order_notes', 'wpdesk_vat_field' );
function wpdesk_vat_field( $checkout ) {
   echo '<div class="my-3" id="wdesk_vat_field"><h2>' . __('Dane do Faktury') . '</h2>';
    woocommerce_form_field( 'vat_number', array(
        'type'          => 'text',
        'class'         => array( 'vat-number-field form-row-wide') ,
        'label'         => __( 'NIP' ),
        'placeholder'   => __( 'Wpisz NIP, aby otrzymać fakturę' ),
    ), $checkout->get_value( 'vat_number' ));
 
    echo '</div>';
    echo '<div class="d-flex flex-wrap" id="client_data"><h2>' . __('Dane odbiorcy') . '</h2>';
    woocommerce_form_field( 'name_od', array(
        'type'          => 'text',
        'class'         => array( 'vat-number-field form-row-wide') ,
        'label'         => __( 'Imię odbiorcy' ),
        'placeholder'   => __( 'Imię odbiorcy' ),
        'required'      => true
    ), $checkout->get_value( 'name_od' ));
    woocommerce_form_field( 'surname_od', array(
        'type'          => 'text',
        'class'         => array( 'vat-number-field form-row-wide') ,
        'label'         => __( 'Nazwisko odbiorcy' ),
        'placeholder'   => __( 'Nazwisko odbiorcy' ),
        'required'      => true
    ), $checkout->get_value( 'surename_od' ));
    woocommerce_form_field( 'adress_od', array(
        'type'          => 'text',
        'class'         => array( 'vat-number-field form-row-wide') ,
        'label'         => __( 'Adres odbiorcy' ),
        'placeholder'   => __( 'Ulica / nr. domu/mieszkania / kod pocztowy / miasto' ),
        'required'      => true
    ), $checkout->get_value( 'adress_od' ));
 
    echo '</div>';
    woocommerce_form_field( 'form_netto', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_netto' ));   
    woocommerce_form_field( 'date_from', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'date_from' ));
    woocommerce_form_field( 'date_to', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'date_to' ));
    woocommerce_form_field( 'form_from', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_from' ));
    woocommerce_form_field( 'form_to', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_to' ));
    woocommerce_form_field( 'form_transport', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_transport' ));
    woocommerce_form_field( 'form_desc', array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_desc' ));
    $x = 0;
            $max = 10;
            while($x < $max){
            $x++;
            if(!empty( $_SESSION['sel-'.$x] )){         
    woocommerce_form_field( 'form_sel_'.$x, array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_sel_'.$x ));
    woocommerce_form_field( 'form_we_'.$x, array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_we_'.$x ));
    woocommerce_form_field( 'form_wi_'.$x, array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_wi_'.$x ));
    woocommerce_form_field( 'form_h_'.$x, array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_h_'.$x ));
    woocommerce_form_field( 'form_l_'.$x, array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_l_'.$x ));
    woocommerce_form_field( 'form_i_'.$x, array(
        'type'          => 'hidden',
    ), $checkout->get_value( 'form_i_'.$x ));
}else{
    break;
}
}
}
add_action( 'woocommerce_checkout_update_order_meta', 'wpdesk_checkout_vat_number_update_order_meta' );
function wpdesk_checkout_vat_number_update_order_meta( $order_id ) {
    $_POST['form_netto'] = $_SESSION['netto_result'];
        $_POST['date_from'] = $_SESSION['date_from'];
        $_POST['date_to'] = $_SESSION['dateToo'];
        $_POST['form_from'] = $_SESSION['wrom'];
        $_POST['form_to'] = $_SESSION['do'];
        $_POST['form_transport'] = $_SESSION['vehicle'];
        $_POST['form_desc'] = $_SESSION['textarea'];
        $x = 0;
        $max = 10;


        while($x < $max){
        $x++;
        $_POST['form_sel_'.$x] = $_SESSION['sel-'.$x];
       

            $_POST['form_we_'.$x] = $_SESSION['we-'.$x];
            $_POST['form_wi_'.$x] = $_SESSION['wi-'.$x];
            $_POST['form_h_'.$x] = $_SESSION['h-'.$x];
            $_POST['form_l_'.$x] = $_SESSION['l-'.$x];
            $_POST['form_i_'.$x] = $_SESSION['l-i-'.$x];
       
        
            update_post_meta( $order_id, '_form_sel_'.$x, sanitize_text_field( $_POST['form_sel_'.$x] ) );
            update_post_meta( $order_id, '_form_we_'.$x, sanitize_text_field( $_POST['form_we_'.$x] ) );
            update_post_meta( $order_id, '_form_wi_'.$x, sanitize_text_field( $_POST['form_wi_'.$x] ) );
            update_post_meta( $order_id, '_form_h_'.$x, sanitize_text_field( $_POST['form_h_'.$x] ) );
            update_post_meta( $order_id, '_form_l_'.$x, sanitize_text_field( $_POST['form_l_'.$x] ) );
            update_post_meta( $order_id, '_form_i_'.$x, sanitize_text_field( $_POST['form_i_'.$x] ) );   
    }
    session_destroy();
    if ( ! empty( $_POST['vat_number'] ) ) {
        update_post_meta( $order_id, '_vat_number', sanitize_text_field( $_POST['vat_number'] ) );
        update_post_meta( $order_id, '_name_od', sanitize_text_field( $_POST['name_od'] ) );
        update_post_meta( $order_id, '_surename_od', sanitize_text_field( $_POST['surename_od'] ) );
        update_post_meta( $order_id, '_adress_od', sanitize_text_field( $_POST['adress_od'] ) );
    }
    update_post_meta( $order_id, '_date_from', sanitize_text_field( $_POST['form_netto'] ) );
    update_post_meta( $order_id, '_date_from', sanitize_text_field( $_POST['date_from'] ) );
    update_post_meta( $order_id, '_date_to', sanitize_text_field( $_POST['date_to'] ) );
    update_post_meta( $order_id, '_form_from', sanitize_text_field( $_POST['form_from'] ) );
    update_post_meta( $order_id, '_form_to', sanitize_text_field( $_POST['form_to'] ) );
    update_post_meta( $order_id, '_form_transport', sanitize_text_field( $_POST['form_transport'] ) );
    update_post_meta( $order_id, '_form_desc', sanitize_text_field( $_POST['form_desc'] ) );
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wpdesk_vat_number_display_admin_order_meta', 10, 1 );
/**
 * Wyświetlenie pola NIP
 */
function wpdesk_vat_number_display_admin_order_meta( $order ) {
    echo '<p><strong>' . __( 'NIP', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_vat_number', true ) . '</p>';       
    echo '<p><strong>' . __( 'Imię odbiorcy', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_name_od', true ) . '</p>';       
    echo '<p><strong>' . __( 'Nazwisko odbiorcy', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_surename_od', true ) . '</p>';       
    echo '<p><strong>' . __( 'Adres odbiorcy', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_adress_od', true ) . '</p>';       
    echo '<p><strong>' . __( 'Cena netto' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_netto', true ) . '</p>';
    echo '<p><strong>' . __( 'Data nadania' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_date_from', true ) . '</p>';
    echo '<p><strong>' . __( 'Data dostawy' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_date_to', true ) . '</p>';
    echo '<p><strong>' . __( 'Skąd' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_from', true ) . '</p>';
    echo '<p><strong>' . __( 'Dokąd' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_to', true ) . '</p>';
    echo '<p><strong>' . __( 'Pojazd' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_transport', true ) . '</p>';
    echo '<p><strong>' . __( 'Opis towaru' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_desc', true ) . '</p>';
    $x = 0;
    $max = 10;
    while($x < $max){
    $x++;
    $select_data = get_post_meta( $order->get_id(), '_form_sel_'.$x, true );
    if(!empty($select_data)){
    echo '<p><strong>' . __( 'Standard' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_sel_'.$x, true ) . '</p>';
    echo '<p><strong>' . __( 'Waga' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_we_'.$x, true ) . '</p>';
    echo '<p><strong>' . __( 'Szerokość' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_wi_'.$x, true ) . '</p>';
    echo '<p><strong>' . __( 'Długość' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_l_'.$x, true ) . '</p>';
    echo '<p><strong>' . __( 'Wysokość' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_h_'.$x, true ) . '</p>';
    echo '<p><strong>' . __( 'Ilość' ) . ':</strong> ' . get_post_meta( $order->get_id(), '_form_i_'.$x, true ) . '</p>';
    }else{
        break;
    }
}
}
add_filter( 'woocommerce_email_order_meta_keys', 'wpdesk_vat_number_display_email' );
/**
* Pole NIP w mailu
*/
function wpdesk_vat_number_display_email( $keys ) {
        $date_od = '_date_from';
     $keys['NIP'] = '_vat_number';
     return $keys;
}
add_filter('woocommerce_add_to_cart_redirect', 'lw_add_to_cart_redirect');
function lw_add_to_cart_redirect() {
 global $woocommerce;
 $lw_redirect_checkout = $woocommerce->cart->get_checkout_url();
 return $lw_redirect_checkout;
}
add_action( 'woocommerce_email_after_order_table', 'mm_email_after_order_table', 10, 4 );
function mm_email_after_order_table( $order, $sent_to_admin, $plain_text, $email ) { ?>
<h3>Dane odbiorcy: </h3>
<table cellspacing="0" cellpadding="6" style="margin-bottom:30px; color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif" width="100%">		
    <tfoot>
        <tr>
         <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left">Imię odbiorcy: </th>
        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_name_od', true )); ?></span></td>
                </tr>
                                    <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Nazwisko odbiorcy: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_surename_od', true )); ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Adres odbiorcy: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_adress_od', true )); ?></td>
                </tr>
                
        </tfoot>
</table>
<h3>Dane zamówienia: </h3>
<table cellspacing="0" cellpadding="6" style="margin-bottom:30px; color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif" width="100%">		
    <tfoot>
        <tr>
         <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left">Data Nadania: </th>
        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_date_from', true )); ?></span></td>
                </tr>
                                    <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Data Dostawy: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_date_to', true )); ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Skąd: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_from', true )); ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Dokąd: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php  esc_html_e(get_post_meta( $order->get_id(), '_form_to', true )); ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Pojazd: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_transport', true )); ?></td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Opis towaru: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_desc', true )); ?></td>
                </tr>
        </tfoot>
</table>
<table cellspacing="0" cellpadding="6" style="margin-bottom:30px; color:#636363;border:1px solid #e5e5e5;vertical-align:middle;width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif" width="100%">
    <tfoot>
    <?php $x = 0;
            $max = 10;
            while($x < $max){
            $x++;
            $select_data = get_post_meta( $order->get_id(), '_form_sel_'.$x, true );
            if(!empty($select_data)){  
            ?>
        <tr>
         <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left">Standard: </th>
        <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left;border-top-width:4px" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_sel_'.$x, true )); ?></span></td>        
    </tr>
                                    <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Waga: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_we_'.$x, true )); ?> kg</td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Szerokość: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_wi_'.$x, true )); ?> cm</td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Wysokość: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php  esc_html_e(get_post_meta( $order->get_id(), '_form_h_'.$x, true )); ?> cm</td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Długość: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php  esc_html_e(get_post_meta( $order->get_id(), '_form_l_'.$x, true )); ?> cm</td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left">Ilość: </th>
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left" align="left"><?php esc_html_e(get_post_meta( $order->get_id(), '_form_i_'.$x, true )); ?>x</td>
                </tr>
                <?php
                } else break; 
                }
                ?> 
        </tfoot>
</table>
<?php } 
// Displaying quantity setting fields on admin product pages
add_action( 'woocommerce_product_options_pricing', 'wc_qty_add_product_field' );
function wc_qty_add_product_field() {
    global $product_object;
    $values = $product_object->get_meta('_qty_args');
    echo '</div><div class="options_group quantity hide_if_grouped">
    <style>div.qty-args.hidden { display:none; }</style>';
    woocommerce_wp_checkbox( array( // Checkbox.
        'id'            => 'qty_args',
        'label'         => __( 'Quantity settings', 'woocommerce' ),
        'value'         => empty($values) ? 'no' : 'yes',
        'description'   => __( 'Enable this to show and enable the additional quantity setting fields.', 'woocommerce' ),
    ) );
    echo '<div class="qty-args hidden">';
    woocommerce_wp_text_input( array(
            'id'                => 'qty_min',
            'type'              => 'number',
            'label'             => __( 'Minimum Quantity', 'woocommerce-max-quantity' ),
            'placeholder'       => '',
            'desc_tip'          => 'true',
            'description'       => __( 'Set a minimum allowed quantity limit (a number greater than 0).', 'woocommerce' ),
            'custom_attributes' => array( 'step'  => 'any', 'min'   => '0'),
            'value'             => isset($values['qty_min']) && $values['qty_min'] > 0 ? (int) $values['qty_min'] : 0,
    ) );
    woocommerce_wp_text_input( array(
            'id'                => 'qty_max',
            'type'              => 'number',
            'label'             => __( 'Maximum Quantity', 'woocommerce-max-quantity' ),
            'placeholder'       => '',
            'desc_tip'          => 'true',
            'description'       => __( 'Set the maximum allowed quantity limit (a number greater than 0). Value "-1" is unlimited', 'woocommerce' ),
            'custom_attributes' => array( 'step'  => 'any', 'min'   => '-1'),
            'value'             => isset($values['qty_max']) && $values['qty_max'] > 0 ? (int) $values['qty_max'] : -1,
    ) );
    woocommerce_wp_text_input( array(
            'id'                => 'qty_step',
            'type'              => 'number',
            'label'             => __( 'Quantity step', 'woocommerce-quantity-step' ),
            'placeholder'       => '',
            'desc_tip'          => 'true',
            'description'       => __( 'Optional. Set quantity step  (a number greater than 0)', 'woocommerce' ),
            'custom_attributes' => array( 'step'  => 'any', 'min'   => '1'),
            'value'             => isset($values['qty_step']) && $values['qty_step'] > 1 ? (int) $values['qty_step'] : 1,
    ) );
    echo '</div>';
}
// Show/hide setting fields (admin product pages)
add_action( 'admin_footer', 'product_type_selector_filter_callback' );
function product_type_selector_filter_callback() {
    global $pagenow, $post_type;
    if( in_array($pagenow, array('post-new.php', 'post.php') ) && $post_type === 'product' ) :
    ?>
    <script>
    jQuery(function($){
        if( $('input#qty_args').is(':checked') && $('div.qty-args').hasClass('hidden') ) {
            $('div.qty-args').removeClass('hidden')
        }
        $('input#qty_args').click(function(){
            if( $(this).is(':checked') && $('div.qty-args').hasClass('hidden')) {
                $('div.qty-args').removeClass('hidden');
            } else if( ! $(this).is(':checked') && ! $('div.qty-args').hasClass('hidden')) {
                $('div.qty-args').addClass('hidden');
            }
        });
    });
    </script>
    <?php
    endif;
}
// Save quantity setting fields values
add_action( 'woocommerce_admin_process_product_object', 'wc_save_product_quantity_settings' );
function wc_save_product_quantity_settings( $product ) {
    if ( isset($_POST['qty_args']) ) {
        $values = $product->get_meta('_qty_args');

        $product->update_meta_data( '_qty_args', array(
            'qty_min' => isset($_POST['qty_min']) && $_POST['qty_min'] > 0 ? (int) wc_clean($_POST['qty_min']) : 0,
            'qty_max' => isset($_POST['qty_max']) && $_POST['qty_max'] > 0 ? (int) wc_clean($_POST['qty_max']) : -1,
            'qty_step' => isset($_POST['qty_step']) && $_POST['qty_step'] > 1 ? (int) wc_clean($_POST['qty_step']) : 1,
        ) );
    } else {
        $product->update_meta_data( '_qty_args', array() );
    }
}
// The quantity settings in action on front end
add_filter( 'woocommerce_quantity_input_args', 'filter_wc_quantity_input_args', 99, 2 );
function filter_wc_quantity_input_args( $args, $product ) {
    if ( $product->is_type('variation') ) {
        $parent_product = wc_get_product( $product->get_parent_id() );
        $values  = $parent_product->get_meta( '_qty_args' );
    } else {
        $values  = $product->get_meta( '_qty_args' );
    }
    if ( ! empty( $values ) ) {
        // Min value
        if ( isset( $values['qty_min'] ) && $values['qty_min'] > 1 ) {
            $args['min_value'] = $values['qty_min'];

            if( ! is_cart() ) {
                $args['input_value'] = $values['qty_min']; // Starting value
            }
        }
        // Max value
        if ( isset( $values['qty_max'] ) && $values['qty_max'] > 0 ) {
            $args['max_value'] = $values['qty_max'];

            if ( $product->managing_stock() && ! $product->backorders_allowed() ) {
                $args['max_value'] = min( $product->get_stock_quantity(), $args['max_value'] );
            }
        }
        // Step value
        if ( isset( $values['qty_step'] ) && $values['qty_step'] > 1 ) {
            $args['step'] = $values['qty_step'];
        }
    }
    return $args;
}
// Ajax add to cart, set "min quantity" as quantity on shop and archives pages
add_filter( 'woocommerce_loop_add_to_cart_args', 'filter_loop_add_to_cart_quantity_arg', 10, 2 );
function filter_loop_add_to_cart_quantity_arg( $args, $product ) {
    $values  = $product->get_meta( '_qty_args' );

    if ( ! empty( $values ) ) {
        // Min value
        if ( isset( $values['qty_min'] ) && $values['qty_min'] > 1 ) {
            $args['quantity'] = $values['qty_min'];
        }
    }
    return $args;
}
// The quantity settings in action on front end (For variable productsand their variations)
add_filter( 'woocommerce_available_variation', 'filter_wc_available_variation_price_html', 10, 3);
function filter_wc_available_variation_price_html( $data, $product, $variation ) {
    $values  = $product->get_meta( '_qty_args' );

    if ( ! empty( $values ) ) {
        if ( isset( $values['qty_min'] ) && $values['qty_min'] > 1 ) {
            $data['min_qty'] = $values['qty_min'];
        }

        if ( isset( $values['qty_max'] ) && $values['qty_max'] > 0 ) {
            $data['max_qty'] = $values['qty_max'];

            if ( $variation->managing_stock() && ! $variation->backorders_allowed() ) {
                $data['max_qty'] = min( $variation->get_stock_quantity(), $data['max_qty'] );
            }
        }
    }
    return $data;
}
add_filter( 'woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 9999, 2 );
   
function bbloomer_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}