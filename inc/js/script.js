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
        var nam = $("th .column_sort").attr('id');
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
        alert("Clicked "+nam);
        return false;
    });
});
