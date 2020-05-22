$(document).ready(function(){
    
    //Initialize DataTable for workout_table
    var t = $('#workout_table').DataTable({
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false
    });//$('#workout_table').DataTable
    
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
    $('#workout_table tbody tr td').on('click',function(){
        var td  = ($(this).text() ? $(this).text() : $(this).val() );
        var cw  = Math.floor(($(this).width()-25) / 10);
        var txt = '<input type="text" value="'+td+'" size="'+cw+'">';
        $(this).html("").append(txt);
    });
    /*
    function myCallbackFunction (updatedCell, updatedRow, oldValue) {
        console.log("The new value for the cell is: " + updatedCell.data());
        console.log("The values for each cell in that row are: " + updatedRow.data());
        alert("Done!!!");
    }

    t.MakeCellsEditable({
        "onUpdate": myCallbackFunction
    });
    */
    //Allow adding of new rows to #workout_table
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
