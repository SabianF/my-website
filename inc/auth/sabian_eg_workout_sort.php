<?php
	/**
	 * Get table headers/fields and display
	 */
	$sql_h = 
	"
	    SELECT  COLUMN_NAME
	    FROM    INFORMATION_SCHEMA.COLUMNS
	    WHERE   TABLE_NAME = N'log_view';
	";
    	
	//Connect to db, get column headers, and store in array
	if (getcwd() != '/home2/sabian/public_html')
	{
        chdir('/home2/sabian/public_html');
	}//this was such an annoying problem to find
	
	include 'wp-content/themes/astra-child/inc/auth/sabian_eg_workout.php';
	$res = mysqli_query($conn, $sql_h);
	mysqli_close($conn);
	$chk = mysqli_num_rows($res);
    
	if(!($chk > 0))
	{
	    die($non."using ".$sql_h);
	}
	
    $columns = [];
    while ($row = mysqli_fetch_assoc($res))
    {
        $columns[]=$row['COLUMN_NAME'];
    }
	mysqli_free_result($res);
    
    /**
     * Sort+order table rows, then display
     */
    $ouput='';
	$colName    = $_GET['column_name'];
    $order      = $_GET["order"];
    
    //Cycle order
    if ($order=='asc')
    {
        $order='desc';
    }
    else
    {
        $order='asc';
    }
    
	/**
	 * Retrieve & display headers & rows in formatted HTML table
	 */
    $sql_r =
    '
        SELECT      *
        FROM        log_view
        ORDER BY    '.$colName.' '.$order.'
    ';
	include 'wp-content/themes/astra-child/inc/auth/sabian_eg_workout.php';
    $res = mysqli_query($conn,$sql_r);
    mysqli_close($conn);
    $chk = mysqli_num_rows($res);
    
	if(!($chk > 0))
	{
	    die($non."using ".$sql_r);
	}
?>
        <!-- todo: display sortable db table headings -->
        <table class="t01" border="0" cellspacing="2" cellpadding="2"> 
            <tr> 
<?php
                for($i=0;$i<count($columns);$i++)
                {
?>
                    <th><a class ="column_sort" id="<?php echo $columns[$i]; ?>" data-order="<?php echo $order; ?>" href="?table-column=<?php echo $columns[$i]; ?>&order=<?php echo $order; ?>"><?php
                                echo $columns[$i];
                                if (!strcasecmp($columns[$i], $colName))
                                {
                                    if (!strcasecmp($order,'DESC'))
                                    {
                                        echo ' <i class="fas fa-chevron-down"></i>';
                                    }//if DESC
                                    elseif (!strcasecmp($order,'ASC'))
                                    {
                                        echo ' <i class="fas fa-chevron-up"></i>';
                                    }
                                }//if selected column
                            ?></a></th>
<?php
                }
?>
            </tr>
<?php       	    
            //display db table data
            while ($row = mysqli_fetch_assoc($res))
            {
                $field1name = $row["Date"   ];
                $field2name = $row["Workout"];
                $field3name = $row["Count"  ];
                $field4name = $row["Points" ];

                echo
                '
                    <tr> 
                        <td>'.$field1name.'</td>
                        <td>'.$field2name.'</td>
                        <td>'.$field3name.'</td>
                        <td>'.$field4name.'</td>
                    </tr>
                ';
            }
            mysqli_free_result($res);
?>  	        
        </table><!-- t01 -->
