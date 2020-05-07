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
    }
    /**
     * ========== ^ Enqueue section ^ ==========
     */
    
    /**
     * ========== v Database section v ==========
     */
    $sql = '';
    $non = 'Database not found';
    $err = 'mysqli error';
    
    /**
     * Filter table items based on inputs
     */
    function db_filter()
    {
        
        return 0;
    }
    
    /**
     * Sort table items based on inputs
     */
    function db_sort()
    {
        return 0;
    }
    
    /**
     * Display table from db
     * 
     * TODO: Currently not functioning
     *          Code stops when using $conn (currently echo $conn; also tested
     *          using mysqli_query($conn, $sql);)
     */
    function db_display()
    {
        include 'wp-content/themes/astra-child/inc/auth/sabian_eg_workout.php';
    	global $sql, $non, $err;
    	
    	/**
    	 * Get table headers/fields
    	 */
    	$sql = 
    	"
    	    SELECT COLUMN_NAME
    	    FROM INFORMATION_SCHEMA.COLUMNS
    	    WHERE TABLE_NAME = N'log_view';
    	";
    	
    	$res = mysqli_query($conn, $sql);
    	$chk = mysqli_num_rows($res);
    	
    	if(!($chk > 0))
    	{
    	    die($non."<br>using ".$sql);
    	}
    	
	    $columns = [];
	    echo "Printing sql results...<br>";
	    while ($row = mysqli_fetch_assoc($res))
	    {
	        echo $row['COLUMN_NAME']."<br>";
	        $columns[]=$row['COLUMN_NAME'];
	    }
	    echo "<br>Printing columns array contents...<br>";
	    for ($i=0;$i<count($columns);$i++)
	    {
	        echo $columns[$i]."<br>";
	    }
    	
    	/**
    	 * todo
    	 */
    	$sort_column;
    	
    	/**
    	 * todo
    	 */
    	$sort_order;
    	
    	/**
    	 * Retrieve & display rows in a formatted HTML table
    	 */
    	$sql =
    	"
    	    SELECT *
    	    FROM log_view;
    	";
    	$res = mysqli_query($conn, $sql);
    	$chk = mysqli_num_rows($res);
    	
    	//Display table if entries exist, otherwise display error
    	if($chk == 0)
    	{
    	    echo $non;
    	}
    	else if ($chk > 0)
        {
?>
            <!-- display db table column titles -->
            <table class="t01" border="0" cellspacing="2" cellpadding="2"> 
	            <tr> 
	                <th>Date    </th> 
	                <th>Type    </th> 
	                <th>Count   </th> 
	                <th>Points  </th> 
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
    	}
    	else
    	{
    	    echo $err;
    	}
	    mysqli_free_result($res);
        mysqli_close($conn);
    }//db_display
    
    /**
     * ========== ^ Database section ^ ==========
     */
?>
