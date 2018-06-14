<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="referrer" content="no-referrer"/>
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
   <div class="bg">
     <div class="container body-content"> 

        <div class="panel panel-default">  
                <div class="panel-heading">创建新书</div>  
                <div class="panel-body text-center">  
                    <form class="form-inline" method="get" action="state/create.php">  
                        <div class="row" >  
                          
                            <div class=" col-md-12"> 
                                <label class="control-label">ISBN：</label>  
                                <input id="txtISBN" type="text" class="form-control inputisbn" name="ISBN" required="required">  
                            </div>  

                        </div>  
                      
                        </div> 
                         
                        <div class="row text-right" style="margin:20px 0;">  
                            <div class="col-sm-12">  
                                <input type="submit" class="btn btn-primary" value="添加图书">
                                <button class="btn btn-success" type="button"><a style='color:rgb(255, 255, 255) ' href="./change-book.php">返 回</a></button>  
                            </div>  
                        </div>  
                    </form>  
                </div>  
        </div>

        <div class="container">
            <div class="book_detail col-md-2"></div>
            <div class="book_detail col-md-8">
               <div id="api_content1" class="col-md-5"></div>
               <div class="bookcontent_detail col-md-7">
                  <ul id="api_content" ></ul>
                  <div id="api_content2"></div>
               </div>
            </div>    
            <div class="book_detail col-md-2"></div>
        </div> 

     </div>
   </div>
</body>

<script>
/*     JS获取input动态数据测试 
        var oBtn = document.getElementById('txtISBN');
        var oTi = document.getElementById('title');
        if('oninput' in oBtn){ 
                oBtn.addEventListener("input",getWord,false); 
                console.log(">0");
        }else{ 
                oBtn.onpropertychange = getWord;
        }
        // var ie = !!window.ActiveXObject; 
        // if(ie){ 
        //        oBtn.onpropertychange = getWord; 
        //    }else{ 
        //        oBtn.addEventListener("input",getWord,false); 
        //    } 
        function getWord(){
            oTi.innerHTML = oBtn.value;
        } 
*/

        jQuery(document).ready(function($) {
            $(".inputisbn").change(function(){
               var isbn=$(" input[ name='ISBN' ] ").val();
               var url = "https://api.douban.com/v2/book/isbn/:" + isbn;
               
                $.ajax({
                    url: url, 
                    dataType:'jsonp',
                    type:'get',
                     success:function(data){
                        $("#api_content").append("<li>书名："+data.title+"</li>");
                        $("#api_content").append("<li>作者： "+data.author[0]+"</li>");
                        $("#api_content").append("<li>ISBN： "+data.isbn13+"</li>");
                        $("#api_content").append("<li>出版社： "+data.publisher+"</li>");
                        $("#api_content").append("<li>出版日期： "+data.pubdate+"</li>");
                        $("#api_content2").append("<textarea> "+data.summary+"</textarea>");
                        $("#api_content1").append("<img src=" +data.image+">");
                     }
                })   
            });

            $(".inputisbn").click(function(){
                $("#api_content").empty();
                $("#api_content1").empty();
                $("#api_content2").empty();
        });
    });
</script>

</html>
