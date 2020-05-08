$(document).ready(function(){

    $('select[name="sort-type"]').change(function(){
        var sel = $(this).val();
        switch (sel)
        {
            case "Date":
                alert("Date selected");
                break;
            case "Type":
                alert("Type selected");
                break;
            case "Count":
                alert("Count selected");
                break;
            case "Points":
                alert("Points selected");
                break;
            default:
                break;
        }
    });

    $("#filter-button").click(function()
    {
        var value = $("#filter-type").val();
        if(value == "OMWx5")
        {
            alert("OMWx5 has been selected");
        }
        else
        {
            /*
            // AJAX Code To Submit Form.
            $.ajax
            ({
                type: "POST",
                url: "ajaxsubmit.php",
                data: dataString,
                cache: false,
                success: function(result)
                {
                    alert(result);
                }
            });
            */
            alert("OMWx5 not selected");
        }
        return false;
    });
    
    $("#sort-button").click(function()
    {
        var value = $("#sort-type").val();
        if(value == "Type")
        {
            alert("Type has been selected");
        }
        else
        {
            /*
            // AJAX Code To Submit Form.
            $.ajax
            ({
                type: "POST",
                url: "ajaxsubmit.php",
                data: dataString,
                cache: false,
                success: function(result)
                {
                    alert(result);
                }
            });
            */
            alert("Type not selected");
        }
        return false;
    });
    
    $("th .column_sort").click(function()
    {
        var column_name = $(this).attr("id");
        var order = $(this).data("order");
        var arrow = '';
        
        //glyphicon glyphicon-arrow-up
        //glyphicon glyphicon-arrow-down
        if(order == 'desc')  
        {  
            arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-do></span>';  
        }  
        else  
        {  
            arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';  
        }
        
        //TODO: column_name and order have proper value, but AJAX not passing value to url
        $.ajax
        ({  
            url:"/wp-content/themes/astra-child/inc/auth/sabian_eg_workout_sort.php",  
            method:"POST",  
            data:{column_name:column_name, order:order},  
            success:function(data)  
            {  
                $('#table-display').html(data);  
                $('#'+column_name+'').append(arrow);  
            }  
        })
        alert(column_name+" "+order);
        return false;
    });
});
