var dict = {};
    $(document).ready(function(){
      var query = $('#dept').val();

      $.ajax({
      url:"showCode.php",
      method:"POST",
      data:{query:query},
      dataType: 'json',
      success:function(data){ 
       
        fillDict(data);
        fillCode(data); 
        $("#code").prop("selectedIndex", 0).val();
        courseCode()
    }
});
$('#dept').on('change', function() {
    var query = $(this).val();
    
    $.ajax({
      url:"showCode.php",
      method:"POST",
      data:{query:query},
      dataType: 'json',
      success:function(data){
        fillDict(data);
        fillCode(data);
       $("#code").prop("selectedIndex", 0).val();
       courseCode()
      }
    });
    
   });

   $('#code').on('change', function(){
    courseCode()
   })
});


function fillDict(data){
    var i;
        for(i = 0; i <data[0].length; i++)
          dict[data[0][i]] = data[1][i]

}
function fillCode(data){
    $('#code').empty()
        data[0].forEach(function(item){        
          $('#code').append('<option value="'+item+'" >'+item+'</option>');
      });
}
function courseCode(){
 var courseCode = $('#code').find(":selected").val();
     $('#cName').val(dict[courseCode]);
}


   
