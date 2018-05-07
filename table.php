<?php

include("include/dbconnect.php");
include_once "include/session.php";

if(isset($_POST['waiter_name']))
{
    $name = $_POST['waiter_name'];
    
    $sql = "INSERT INTO restaurant_tables(name) VALUES('$name')";

    if ($conn->query($sql) === TRUE) 
    {
       echo "<script>alert('Table added Successfully')</script>";
    } 
    
}

?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Point of Sales</title>
        
        <link rel="icon" type="icons/png" href="icons/mobile-dashboard-icon.png">
        
        <!-- jQUERY -->
        <script src="js/jquery.min.js"></script>

        <!-- SLIDE DOWN EFFECT ON PRODUCTS, CATEGORIES, ORDERS  -->
        <script type="text/javascript">
            $(function () {
                $(this).find('.panel-footer').show();
            });
        </script>

        <!-- NOTIFICATIONS CODE AND CSS -->
        <style type="text/css">
            
            #notification_count
            {
                padding: 1px 9px 1px 9px;
                background: #cc0000;
                color: #ffffff;
                font-weight: bold;
                margin-left: 77px;
                text-align: center;
                border-radius: 15px;
                -moz-border-radius: 15px;
                -webkit-border-radius: 15px;
                position: absolute;
                margin-top: -12px;
                font-size: 16px;
            }
            
            #notification_count_for_notify
            {
                padding: 1px 9px 1px 9px;
                background: #cc0000;
                color: #ffffff;
                font-weight: bold;
                margin-left: 77px;
                text-align: center;
                border-radius: 15px;
                -moz-border-radius: 15px;
                -webkit-border-radius: 15px;
                position: absolute;
                margin-top: -12px;
                font-size: 16px;
            }
            
            .links:hover
            {
                text-decoration:none;
            }
            
        </style>
        
        <script type="text/javascript" charset="utf-8">
            
            function showAjaxModal(id)
            {
                var name = $('#td_0213_'+id).html();
                $('#exampleModalLong').modal('show').find('#table_name').val(name);
                $('#exampleModalLong').find('#sumit_btn').click(function(){
                 
                name = $('#table_name').val();
                    $.ajax({ type : 'POST',
                      data : { id:id,name:name},
                      url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                      success: function ( data ) {
                        window.location.href = ''; 
                          // <=== VALUE RETURNED FROM FUNCTION.
                      },
                      error: function ( xhr ) {
                        //alert( "error" );
                      }
                    });  
                });
            }
            
            function showConfirmModal(id)
            {
                 $('#confirmmodal').modal('show');
                 $('#confirmmodal').find('#delete_btn_yes').click(function()
                 {
                    $.ajax( { type : 'POST',
                       data : { tableidfordelete:id},
                       url  : 'functions.php',              // <=== CALL THE PHP FUNCTION HERE.
                       success: function ( data ) { 
                        window.location.href = '';
                          // <=== VALUE RETURNED FROM FUNCTION.
                      },
                      error: function ( xhr ) {
                        //alert( "error" );
                      }
                    });
                });
            }

        </script>
        
    </head>
    
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        
        <?php include("include/header.php"); ?>
        <?php include("include/sidebar.php"); ?>
        
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        
        <div class="container-fluid">
            
            <div class="jumbotron text-center">
              <h1 class="page-header"><center><h1>POINT OF SALES</h1></center></h1>
            </div>
            <!-- ... Your content goes here ... -->
        </div>
        
        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    
                    <form action="#" method="post">
                        <div class="form-group">
                            <label>Table Name</label>
                            <input type="text" class="form-control" name="waiter_name" placeholder="Table Name...">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add"/>
                        </div>
                    </form>              
                    
                    <h2>Tables</h2>
                    <div>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php

                                $getData = "SELECT * FROM restaurant_tables";
                                $qur = $conn->query($getData);

                                while($r = mysqli_fetch_assoc($qur))
                                {
                                    $status = '';

                                    if($r['status'] == '0')
                                    {
                                        $status = 'Active';
                                    }
                                    else
                                    {
                                      $status = 'Inactive';
                                    }                  

                            ?>
                                
                                  <tr>
                                    <td id="<?php echo 'td_0213_'.$r['id'] ?>"><?php echo $r['name'] ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><div class="btn-group">
                                            <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" type="button">Action <span class="caret"></span></button>
                                            <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                                <!-- teacher EDITING LINK -->
                                                <li>
                                                    <a href="#" id="<?php echo $r['id'] ?>" onclick="showAjaxModal(this.id);"><i class="entypo-pencil"></i> Edit</a>
                                                </li>
                                                <li class="divider"></li><!-- teacher DELETION LINK -->
                                                <li>
                                                    <a href="#" class="entypo-pencil" onclick="showConfirmModal(<?php echo $r['id'] ?>);" data-target="#confirmmodal"><i class="entypo-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    
                                }
                                
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Table</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
        <label>Table Name</label>
        <input type="text" class="form-control" id="table_name" placeholder="Table Name...">
      </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="sumit_btn" class="btn btn-primary">Save changes</button>
      </div>
        
    </div>
  </div>
</div>
    
<div class="modal fade" id="confirmmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Are you sure you want to delete this table ?</label>
      </div>
      <div class="modal-footer">
        <button type="button" id="delete_btn_yes" class="btn btn-secondary" >YES</button>
        <button type="button" id="sumit_btn" data-dismiss="modal" class="btn btn-primary">NO</button>
      </div>
    </div>
  </div>
</div>
    
            
<div class="footer"><center>Powered By Echelon Tech Lab</center></div>

        <!-- ALL REFERENCE LINKS TO JS AND CSS -->
        
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/morris.css" rel="stylesheet">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="custom-css/style.css" type="text/css">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</body>
</html>
