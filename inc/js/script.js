$(document).ready(function(){
    
    //Initialize DataTable for workout_table
    var t = $('#workout_table').DataTable({
        "scrollY"           : "500px"
        ,"scrollCollapse"   : true
        ,"paging"           : false
    });
    
    //TODO: D3 Bar Chart
    file_exists("/wp-content/themes/astra-child/inc/auth/sabian_eg_workout_json.php");
    d3.select('div #viz-bar-chart');
    
    //TODO: D3 Line Graph
    d3.select('div #viz-line-graph');
    
    //Table highlighting/tooltips on mouse hover
    $('#workout_table tbody tr td').attr('title','Double-click to edit');
    
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
    $(document).on('dblclick','#workout_table tbody tr td',function(){
        
        //if not already editing
        if ($(this).html().indexOf('<input type="text"') < 0)
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
    
    //Save cell edit value when enter key pressed
    $(document).on('keyup','#cell-edit',function(k){
        
        //do nothing if keypressed is not 'enter'
        var key = k.which;
        if(key!=13)
        {
            return;
        }
        
        //if keypressed is 'enter'
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
        
        //Reset all red form field borders
        $('#date_input'    ).css('border','');
        $('#workout_input' ).css('border','');
        $('#count_input'   ).css('border','');
        $('#points_input'  ).css('border','');
        
        //Error if any fields are empty
        if (!di || !wi || !ci || !pi)
        {
            //Mark empty fields red
            if (!di)
            {
                $('#date_input'     ).css("border", "2px inset red");
            }
            if (!wi)
            {
                $('#workout_input'  ).css("border", "2px inset red");
            }
            if (!ci)
            {
                $('#count_input'    ).css("border", "2px inset red");
            }
            if (!pi)
            {
                $('#points_input'   ).css("border", "2px inset red");
            }
            
            //Remove success text if displayed
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
        }//Error if any fields are empty
        
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
    });//$('#addData_button').on('click'
    
});//$(document).ready(function()

/**
 * Check if file exists, and display alert for result
 * 
 * @param p file or path to check
 */
function file_exists(p)
{
    $.ajax({
        url:p,
        type:'HEAD',
        error: function()
        {
            var retVal = 'file/path NOT found: '+p;
            console.log(retVal);
            return retVal;
        },
        success: function()
        {
            var retVal = 'file/path found: '+p;
            console.log(retVal);
            return retVal;
        }
    });
}
