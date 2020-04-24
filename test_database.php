<?php
    /**
     * STATUS = ALL OVER AGAIN
     *
     * @author Sabian Finogwar
     * @since 1.0.0
     */
    include '/home2/sabian/public_html/sf-includes/auth/sabian_eg_workout.php';
    
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly.
    }
    
    get_header();
    
    if ( astra_page_layout() == 'left-sidebar' ) :
    	get_sidebar();
    endif;
?>
<!DOCTYPE html>
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
        <h1 class="center" style="padding-top:50px;"><?php get_the_title(get_post    (get_the_ID())) ?></h1>
        
        <div id="primary" class="content-area primary" >
            <div id="const" style="margin-left:auto;margin-right:auto;margin-bottom:50px;">
                <h2 class="center">Under Construction!</h2    >
                <p class="center" style="padding:10px;">
                    We're still working on this functionality but don't worry, we'll have the rest of it ready, soon! Check back later!
                </p>
                <span id="todos" style="padding:10px;">
                    Coming soon:
                </span><!-- #todos -->
                <div id="todo-list" style="margin-left:150px;margin-right:150px;">
                    <ul>
                        <li>Search and sort by date, type, count points</li>
                        <li>Update & add new entries</li>
                        <li>Visualizations</li>
                    </ul>
                </div><!-- #todo-list -->
            </div><!-- #const -->
            <div class="columns-2" style="margin-bottom:100px;">
                <div id="table-forms">
                    <h2 class="center">Testing Area</h2>
                    <p class="center">Currently testing forms to search within database.</p>
                    <!-- TODO: Table Search/Entry Forms -->
                    <div class="column">
                        <h3>Form 1</h3>
                        <form>
                            <label for ="date">Date:</label><br>
                            <input type="text" id="date" name="date"><br>
                            
                            <label for ="type">Type:</label><br>
                            <input type="text" id="type" name="type">
                            
                            <button type="button" name="submit">Submit</button>
                        </form>
                        <h3>Form 2</h3>
                        <form>
                            <label for="fname">First name:</label><br>
                            <input type="text" id="fname" name="fname"><br>
                            <label for="lname">Last name:</label><br>
                            <input type="text" id="lname" name="lname">
                            <button type="button" name="submit">Submit</button>
                        </form>
                    </div><!-- #column -->
                </div>
                <div class="center" id="table-display" style="height:500px    ;overflow:scroll;padding-left:10px;padding-right:10px;">
<?php   
                	$sql = 'SELECT * FROM log_view;';
                	$res = mysqli_query($conn, $sql);
                	$chk = mysqli_num_rows($res);
                	$non = 'Database not found (line 57) (include line 12)';
                	$err = 'mysqli error (line 57)';
                	
                	if($chk == 0)
                	{
                	    echo $non;
                	}
                	else if ($chk > 0)
                	{
?>                      	    <!-- display db table column titles -->
        	        <table class="t01" border="0" cellspacing="2"             cellpadding="2"> 
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
?>  
                </div><!-- #table-display -->
        	</div><!-- #columns-2 -->
<?php   
	        get_content();
	        astra_primary_content_bottom();
?>  
	    </div><!-- #primary -->
    </div><!-- other #primary -->
<?php
    if ( astra_page_layout() == 'right-sidebar' )
    {
        get_sidebar();
    }
    get_footer();
?>
</body>
</html>
