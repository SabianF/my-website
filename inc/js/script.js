$(document).ready(function(){
    
    //Initialize DataTable for workout_table
    var t = $('#workout_table').DataTable({
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false
    });//$('#workout_table').DataTable
    
    //Table highlighting on mouse hover
    $('#workout_table tbody tr').on('mouseenter',function(){
        $(this).css('background-color','#EEE');
    });
    $('#workout_table tbody tr td').on('mouseenter',function(){
        $(this).css('background-color','#DDD');
    });
    $('#workout_table tbody tr').on('mouseleave',function(){
        $(this).css('background-color','');
    });
    $('#workout_table tbody tr td').on('mouseleave',function(){
        $(this).css('background-color','');
    });
    
    //Edit cell on click
    $('#workout_table tbody tr td').on('click',function(){
        if (!($(this).html().indexOf('<input type="text"') >= 0))
        {
            var td  = ($(this).html() ? $(this).text() : $(this).val() );
            var cw  = Math.floor(($(this).width()-30) / 10);
            var txt = '<input type="text" id="cell-edit" value="'+td+'" size="'+cw+'">';
            
            $(this).html("").append(txt);
            $('#cell-edit').focus().select();
        }//if not already editing
    });
    
    //Save cell edit value on defocus
    $(document).on('blur','#cell-edit',function(){
        var txt = $(this).val();
        $(this).parent().html("").append(txt);
    });
    
    //TODO: not working
    //Save cell edit value when enter key pressed
    $(document).on('keyup','#cell-edit',function(k){
        
        //break when keypressed != 'enter'
        var key = k.which;
        if(key!=13)
        {
            return;
        }
        
        //when keypressed is 'enter'
        var txt = $(this).val();
        $(this).parent().html("").append(txt);
    });

    //Add new rows
    $('#addData_button').on('click',function(){
        var di = $('#date_input'    ).val();
        var wi = $('#workout_input' ).val();
        var ci = $('#count_input'   ).val();
        var pi = $('#points_input'  ).val();
        
        t.row.add([
             di
            ,wi
            ,ci
            ,pi
        ]).draw(false);
        
        alert('Successfully added '+(di?di:'')+(di&&wi?', '+wi:(wi?wi:''))+(wi&&ci?', '+ci:(ci?ci:''))+(ci&&pi?', '+pi:(pi?pi:'')));
        $('#addData').trigger("reset");
        
    });//$('#addData_button').on('click',function()
    
});//$(document).ready(function()
