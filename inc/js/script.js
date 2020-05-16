$(document).ready(function(){
    
    //Initialize DataTable for workout_table
    var t = $('#workout_table').DataTable({
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false
    });//$('#workout_table').DataTable
    
    //Allow adding of new rows to #workout_table
    $('#addData_button').on('click',function(){
        alert("Data submitted!");
        
        t.row.add([
            $('#date_input'     ).val()
            ,$('#workout_input' ).val()
            ,$('#count_input'   ).val()
            ,$('#points_input'  ).val()
        ]).draw(false);
        
        $('#addData').trigger("reset");
        
    });//$('#addData_button').on('click',function()
    
});//$(document).ready(function()
