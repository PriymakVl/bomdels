$(document).ready(function() {
       //show all row table
//   $('#all').click(function() {
//        $('.content table :radio').each(function() {
//            $(this).parent().parent().show();
//        });
//   });
    
    //sort element by type
   $('#sort_menu_danieli_box :radio').change(function() {
        var type_sort = $(this).attr('type_sort');
        console.log(type_sort);
        $('.content table :radio').each(function() {
            if(type_sort == 'all') $(this).parent().parent().show();    
            else {
                var type_elem = $(this).attr('type_elem');
                $(this).parent().parent().show();
                if(type_elem != type_sort && type_elem !== undefined) $(this).parent().parent().hide(); //undefine == row header    
            }
        });       
   });
   

   
      //      else if(type_sort == 'components_and_details') {
//                var type_elem = $(this).attr('type_elem');
//                $(this).parent().parent().show(); 
//                if(type_elem != 'detail') $(this).parent().parent().hide();
//                if(type_elem != 'compoment') $(this).parent().parent().hide();   
//            }
});

