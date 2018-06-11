<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>图书管理系统-创建新书</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css"  href="css/create.css"/>
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.css" />
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
   <div class="navbar navbar-duomi navbar-static-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="./index.html" id="logo">图书管理系统</a>
        </div>
   </div>
   <div class="container body-content">
        <div class="panel panel-default">  
                <div class="panel-heading">创建新书</div>  
                <div class="panel-body">  
                    <form class="form-inline" method="get" action="state/create.php">  
                        <div class="row" >  
                          
                            <div class=" col-md-4"> 
                                <label class="control-label">ISBN：</label>  
                                <input id="txtISBN" type="text" class="form-control" name="ISBN" required="required">  
                            </div>  
                        </div>  
                      
                        </div> 
                         
                        <div class="row text-right" style="margin-top:20px;">  
                            <div class="col-sm-12">  
                                <input type="submit" class="btn btn-primary" value="添加图书">
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255)' href="./change-book.php">返 回</a></button>  
                            </div>  
                        </div>  
                    </form>  
                </div>  
        </div> 
   </div>

</body>
</html>
