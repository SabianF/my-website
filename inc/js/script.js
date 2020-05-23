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
    
    //Edit cell on double-click
    $('#workout_table tbody tr td').on('dblclick',function(){
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
        
        //Get all values from input fields
        var di = $('#date_input'    ).val();
        var wi = $('#workout_input' ).val();
        var ci = $('#count_input'   ).val();
        var pi = $('#points_input'  ).val();
        
        //Error if any fields are empty
        if (!di || !wi || !ci || !pi)
        {
            //Remove failure text if displayed
            if ($('#addData-success').length)
            {
                $('#addData-success').remove();
            }
            
            //Add failure text if not already displayed
            if (!$('#addData-fail').length)
            {
                $('#addData_button').after('<p id="addData-fail">Please fill out all fields!</p>');
            }
            return;
        }
        
        //Add new row to table using input data
        t.row.add([
             di
            ,wi
            ,ci
            ,pi
        ]).draw(false);
        
        //Clear all form fields after submit
        $('#addData').trigger("reset");
        
        //Remove failure text if displayed
        if ($('#addData-fail').length)
        {
            $('#addData-fail').remove();
        }
        
        //Display success text if not already displayed
        if (!$('#addData-success').length)
        {
            $('#addData_button').after('<p id="addData-success">New data added successfully!</p>');
        }
        
    });//$('#addData_button').on('click',function()
    
});//$(document).ready(function()
