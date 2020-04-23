<?php
    /**
     * STATUS = ALL OVER AGAIN
     *
     * 
     * 
     * 
     * 
     *
     * @since 1.0.0
     */
    include '/sf-includes/auth/sabian_eg_workout.php';
    
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly.
    }
    
    get_header();
    
    if ( astra_page_layout() == 'left-sidebar' ) :
    	get_sidebar();
    endif;
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/sf-includes/styles.css">
</head>
<body>
	<div id="primary" <?php astra_primary_class(); ?>>
<?php
        astra_primary_content_top();
?>

    <h1 class="center" style="padding-top:50px;"><?php get_the_title(get_post(get_the_ID())) ?></h1>
    
    <div id="primary" class="content-area primary" >
                <div class="columns-2" style="margin-bottom:100px;">
                    <div id="table-forms">
                    <h2 class="center"><!-- Try It Yourself! --> Under Construction!</h2>
                        <p class="center" style="padding:10px;">
                    We're still working on this functionality but don't worry, we'll have the rest of it ready, soon! Check back later!
                        </p>
                        <span id="todos" style="padding:10px;">
                            Coming soon:
                        <ul>
                        <li>Search and sort by date, type, count points</li>
                            <li>Update & add new entries</li>
                            <li>Visualizations</li>
                        </ul>
                        <!-- TODO: Table Search/Entry Forms -->
                    </div>
		    <div class="center" id="table-display" style="height:400px;overflow:scroll;padding-left:10px;padding-right:10px;">
<?php
                    	$sql = 'SELECT * FROM log_view;';
                    	$res = mysqli_query($conn, $sql);
                    	$chk = mysqli_num_rows($res);
                    	$non = 'Database not found (line 57)';
                    	$err = 'mysqli error (line 57)';
                    	
                    	if($chk == 0)
                    	{
                    	    echo $non;
                    	}
                    	else if ($chk > 0)
                    	{
?>                  	    <!-- display db table column titles -->
                    	    <table class="t01" border="0" cellspacing="2"         cellpadding="2"> 
                    	        <tr> 
                    	            <th>Date    </th> 
                    	            <th>Type    </th> 
                    	            <th>Count   </th> 
                    	            <th>Points  </th> 
                    	        </tr>
<?php   	
                    	        //todo: display db table data
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
?>
                    </div><!-- table-display -->
            	</div><!-- columns-2 -->
<?php
		get_content();
		astra_primary_content_bottom();
?>
	</div><!-- #primary -->
<?php
    if ( astra_page_layout() == 'right-sidebar' ) :
        get_sidebar();
    endif;
    get_footer();
?>
</body>
</html>
