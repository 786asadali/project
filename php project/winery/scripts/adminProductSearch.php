<?php
session_start();
require_once "../resources/config.php";
if(isset($_POST['query'])){
    $predicate=clean($_POST['query']);
   

  $query="select * from Products where ProductName like '%$predicate%' or description like '%$predicate%'";
  $stmt=$conn->prepare($query);
 $stmt->execute();
 if($stmt->rowCount()>0){
while($out=$stmt->fetch(PDO::FETCH_ASSOC)){
 $productid=$out['ProductID'];
 $productname=$out['ProductName'];
 $price=$out['ProductPrice'];
 $quantity=$out['Quantity'];
 $image=$out['image'];
 $description=$out['description'];
 
 $output='
 
   
 <div class="col-md-6 col-lg-3">
 <div class="card bg-light">
     <div class="card-body text-center"style="max-height: 400px;">
         <img src="../productImages/'.$image.'" class="img  mb-3" width=200 height=200 style="min-height: 200px; data-id="'.$productid.'" alt="'.$productname.'"/> 
         <span class="d-inline-block  text-dark text-truncate" style="max-width: 150px;">
         '.$productname.'
          </span><br>
          <span class="d-inline-block  text-dark text-truncate" style="max-width: 150px;"> Price:
         '.$price.'
          </span><br>
         <span class="d-inline-block  text-dark text-truncate" style="max-width: 120px;">
         '.$description.'
          </span><br>
          <button class=" text-warning bg-dark btn btn-block productedit productedit'.$productid.'"  data-id="'.$productid.'" type="button"><i class="fa fa-pencil"></i></button>
          <button class=" text-danger bg-dark btn btn-block productdelete productdelete'.$productid.'"  data-id="'.$productid.'" type="button"><i class="fa fa-trash"></i></button>
</div>
 </div>
</div>

              
        
 ';
 echo $output;
}
 }else{
 $output='
 
        <div class="container text-light">
            Sorry,No products found;
        </div>
  
 ';
 echo $output;
 }
}

 ?>