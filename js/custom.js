
jQuery(document).ready(function () {

  jQuery(document).ready(function(){

   

  
 
     

jQuery(document).ready(function(){  
  var form_count = 1, form_count_form, next_form, total_forms;
  total_forms = jQuery("fieldset").length;  
  jQuery(".next").click(function(){
    var startDate = jQuery('#dateFrom').val();
    var endDate = jQuery('#dateTo').val();

    var start = new Date(startDate);
    var end = new Date(endDate);
    var present = new Date();
    var min = (start - present) / (1000 * 60 * 60 * 24);
    var diffDate = (end - start) / (1000 * 60 * 60 * 24);
    days = Math.round(diffDate);

    console.log('Liczba: '+form_count);
    if(total > 0 && startDate.length && endDate.length){
      if(form_count === 1){
        if(days <= 0){
          alert('Źle wybrana data! Wybierz ponownie!');
        }
        else if(total >= 1200 && days == 1)  {
          
          alert('Za długa trasa w zbyt krótkim odstępie czasowym. Proszę wybrać późniejszą datę.');
      }else if(min < 0){

        alert('Wybierz odpowiednią datę co najmniej od dnia dzisiejszego.');
      }
      
      else  if(total <= 300 ){
           
        alert('Zbyt krótka trasa');
    }
     else{

        
      let previous = jQuery(this).closest("fieldset").attr('id');
      let next = jQuery('#'+this.id).closest('fieldset').next('fieldset').attr('id');
      jQuery('#'+next).show();
      jQuery('#'+previous).hide();
      setProgressBar(++form_count);}
       }else if(form_count === 2){
        var text = jQuery('textarea#area').val();
        if(!jQuery(inputWE).val() || !jQuery(inputWI).val() || !jQuery(inputH).val() || !jQuery(inputL).val() || !jQuery(inputI).val() || !text.length){
          alert('Proszę wypełnić wszystkie pola towaru oraz opis!');
        }
        
        else{
          let previous = jQuery(this).closest("fieldset").attr('id');
      let next = jQuery('#'+this.id).closest('fieldset').next('fieldset').attr('id');
      jQuery('#'+next).show();
      jQuery('#'+previous).hide();
      setProgressBar(++form_count);
        }
      }
    }else{
      alert('Proszę wypełnić wszystkie pola!');
    }
     
      
       
  }); 
  
  jQuery(".previous").click(function(){
   
        let current = jQuery(this).closest("fieldset").attr('id');
        let previous = jQuery('#'+this.id).closest('fieldset').prev('fieldset').attr('id');
        jQuery('#'+previous).show();
        jQuery('#'+current).hide();
        setProgressBar(--form_count);
         
  }); 
  setProgressBar(form_count);  
  function setProgressBar(curStep){
    var percent = parseFloat(100 / total_forms) * curStep;
    percent = percent.toFixed();
    jQuery(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  } 
});

jQuery(document).ready(function(){  

  jQuery('#calc_km').on('click', function(){
    var from = jQuery('#start').val();
    var to = jQuery('#end').val();
    
    jQuery('#from').val(from);
    jQuery('#to').val(to);
    jQuery('#fromTwo').val(from);
    jQuery('#toTwo').val(to);
    jQuery('#startT').val(from);
      jQuery('#endD').val(to);
    
    
  })


});



                });
                });