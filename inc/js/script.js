$(document).ready(function(){
    
    //Initialize DataTable for workout_table
    var t = $('#workout_table').DataTable({
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false
    });
    
    //Initialize D3
    var svg = d3.select("#bars")
        ,margin = 200
        ,width = svg.attr("width") - margin
        ,height = svg.attr("height") - margin;


    var xScale = d3.scaleBand().range ([0, width]).padding(0.4),
        yScale = d3.scaleLinear().range ([height, 0]);

    var g = svg.append("g")
               .attr("transform", "translate(" + 100 + "," + 100 + ")");
    
    //TODO: d3.json function not executing
    d3.json("/wp-content/themes/astra-child/inc/auth/sabian_eg_workout_json.php", function(error, data) {
        if (error)
        {
            throw error;
        }
        
        data.forEach(function(d) {
            d.Date = parseDate(d.Date);
            d.Points = +d.Points;
        });//data.forEach
    });//d3.json
    
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
        
    });//$('#addData_button').on('click',function()
    
});//$(document).ready(function()

/**
 * Check if file exists, and display alert for result
 */
function file_exists(p)
{
    $.ajax({
        url:p,
        type:'HEAD',
        error: function()
        {
            //file not exists
            alert("not found: "+p);
        },
        success: function()
        {
            //file exists
            alert("found: "+p);
        }
    });
}
