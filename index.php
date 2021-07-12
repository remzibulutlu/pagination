<html>   
  <head>   
    <title>Pagination</title>   

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">

  </head>   
  <body>
      
  
  

    <?php  
     
        require_once "connection.php";   
        
       
        if (isset($_GET["page"]) && is_numeric($_GET['page']) ) {    
            $page  = $_GET["page"];
            if ($page <= 0) {
                $page = 1;
            }
        }    
        else {    
          $page=1;    
        }    
    

        

        $per_page_record = 3;
        $start_from = ($page-1) * $per_page_record; 
        $query = "SELECT * FROM pagi LIMIT $start_from, $per_page_record";
        $rs_result = mysqli_query ($conn, $query);
    ?>    
  



    <div class="container text-center">   
      <br>   
      <div class="tablerows">   
        <h1 text-center>Pagination Application</h1>   
          
        <table class="table table-striped table-dark">   
          <thead>   
            <tr>      
              <th>Id</th>   
              <th>Name</th>   
              <th>Surnames</th>
              <th>Jobs</th>
              <th>Ages</th>   
            </tr>   
          </thead>

            <tbody>

            <?php 
            while ($row = mysqli_fetch_array($rs_result)) {           
            ?> 

            <tr>     
             <td><?php echo $row["id"]; ?></td>     
            <td><?php echo $row["user_names"]; ?></td>   
            <td><?php echo $row["user_surnames"]; ?></td>   
            <td><?php echo $row["user_job"]; ?></td>
            <td><?php echo $row["user_age"]; ?></td>                                           
            </tr>
            <?php     
            };    
            ?>     
            
            </tbody>   
        
        </table>   
  


     <div class="pagination text-center"> 

        <?php  

        $query = "SELECT COUNT(*) FROM pagi";
        $rs_result = mysqli_query ($conn, $query);          
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];
        $total_pages = ceil($total_records / $per_page_record);  
          
        echo "</br>";







    if($total_records > $per_page_record){	 
	    echo '<br><br>';

        $x = 3; //pagination
        
        if($page >= 2){		
            $prev = $page-1;			
            echo '<a href="?page='.$prev.'">« previous </a>';   
        }

            
        if($page > $total_pages){

            header('location: index.php?page='.$total_pages);
        }

        
        if($page==1){ 
            echo "<a class = 'active'>1</a>";
        }


        else{ 
            echo '<a href="?page=1">1</a>'; 	
        }





        if($page-$x > 2){ 
            echo '......'; 	
            $i = $page-$x; 	 
        }
        else {
            $i = 2; 		  
        }




        for($i; $i<=$page+$x; $i++) {	
            if($i==$page){
                echo "<a class ='active'>$i</a>";
                
            }
            else{
                echo '<a href="?page='.$i.'">'.$i.'</a>';
            }
            if($i==$total_pages){
                break;
            }  
        }


        if($page+$x < $total_pages-1) {	
            echo '.......';			
            echo '<a href="?page='.$total_pages.'">'.$total_pages.'</a>';
        }


        elseif($page+$x == $total_pages-1) { 			
            echo '<a href="?page='.$total_pages.'">'.$total_pages.'</a>'; 		 
        }


        if($page < $total_pages){	  
            $next = $page+1;		  
            echo '<a href="?page='.$next.'"> Next » </a>'; 		  
        }
    }

        ?>

    </div>  
  
    </div>    
  
    </div>       

</body>   
</html>  