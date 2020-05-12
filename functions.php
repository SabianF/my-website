<?php
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly.
    }
    
    /**
     * ========== v Enqueue section v ==========
     */
    
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
    
    function my_theme_enqueue_styles()
    {
        $parent_style = 'astra-block-editor-styles'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
        wp_enqueue_style
        (
            $parent_style
            ,get_template_directory_uri() . 'inc/assets/css/block-editor-styles/style.css'
        );
        wp_enqueue_style
        (
            'astra-child',
            get_stylesheet_directory_uri() . '/style.css',
            array( $parent_style ),
            wp_get_theme()->get('Version')
        );
    }
    
    /**
     * Testing function
     * 
     * Check if file or path exists, and echo result
     */
    function path_exists($fpath)
    {
        if (file_exists("$fpath"))
        {
            echo "File/path found:<br>( $fpath )";
        }
        else
        {
            echo "File/path not found:<br>( $fpath )";
        }
        return false;
    }
    /**
     * ========== ^ Enqueue section ^ ==========
     */
    
    /**
     * ========== v Database section v ==========
     */
    
    /**
     * Filter table items based on inputs
     */
    function db_filter()
    {
        
        return 0;
    }
    
    /**
     * Display table from db
     * 
     * TODO: dynamically display table column headers and rows
     */
    function db_display()
    {
        $non = '<br>Database not found<br>';
        $err = '<br>mysqli error<br>';
        
    	/**
    	 * Get table headers/fields and store in array
    	 */
    	$sql_h = 
    	"
    	    SELECT  COLUMN_NAME
    	    FROM    INFORMATION_SCHEMA.COLUMNS
    	    WHERE   TABLE_NAME = N'log_view';
    	";
    	
    	//Connect to db, get column headers, and store in array
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
    	 * Determine which column to sort by
    	 */
    	if (!$sort_column)
    	{
    	    $sort_column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
    	}
    	
    	/**
    	 * Determine column sort order
    	 */
    	if (!$sort_order)
    	{
    	    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
    	}
    	
    	/**
    	 * Retrieve & display headers & rows in formatted HTML table
    	 */
        $sql =
        "
            SELECT      *
            FROM        log_view
            ORDER BY    ".$sort_column." ".$sort_order.";
        ";
    	 
    	include 'wp-content/themes/astra-child/inc/auth/sabian_eg_workout.php';
    	$res = mysqli_query($conn, $sql);
    	mysqli_close($conn);
    	$chk = mysqli_num_rows($res);
    	
    	if (!($chk > 0))
    	{
    	    die($non);
    	}
    	
    	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	    $asc_or_desc = $sort_order == 'ASC' ? 'DESC' : 'ASC';
	    $add_class = '_highlight';
?>
        <!-- todo: display sortable db table headings -->
        <table class="t01" border="0" cellspacing="2" cellpadding="2"> 
            <tr> 
<?php
                for($i=0;$i<count($columns);$i++)
                {
?>
                    <th><a class ="column_sort" id="<?php echo $columns[$i]; ?>" data-order="desc" href="?column_name=<?php echo $columns[$i]; ?>&sort=<?php echo $sort_order; ?>"><?php echo $columns[$i].' <i class="fas fa-chevron-down"></i>'; ?></a></th>
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
?>  	        
        </table><!-- t01 -->
<?php	   
	    mysqli_free_result($res);
        mysqli_close($conn);
    }//db_display
    
    /**
     * ========== ^ Database section ^ ==========
     */
?>
