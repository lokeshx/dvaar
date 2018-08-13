<?php
$connect=mysqli_connect("localhost","root","","unifiedf") or die(mysqli_error());
	if(isset($_GET['id']))
	{
		$fac_id = $_GET['id'];
		
		$result = mysqli_query($connect,"Select * from profile where fac_id ='$fac_id'")or die(mysqli_error());
		$search_arr=[];


	}
 ?>
 <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Scroll</title>
    <style type="text/css">

    <style>
        
mark{
        background-color: #e2e2e2;
    }   
body,html {
      background-color: #f9f9f9;
      font-family: arial, sans-serif;
       }

.container{
    width: 80%;
    margin: auto;
    overflow: hidden;
}
ul{
    margin: 0;
    padding: 0;
}
.button_1{
    height:38px;
    background:#ffab7c;
    border: none;
    padding-left: 20px;
    padding-right: 20px;
    color: #ffffff;
}
.highlight{
    color: #e8491d;
    font-weight: bold;
}
.dark{
    padding: 15px;
    background:#35424a;
    color: #ffffff;
    margin-top: 0px;
    margin-bottom: 10px;
}
/*Header*/
header{
    background: #83aeaa;
    color: #ffffff;
    padding-top: 10px;
    min-height: 50px;
    border-bottom: white 1px solid;
    border-top: white 1px solid;
    /*box-shadow: 1px 1px 40px black;*/
}
header a{
    color: #ffffff;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 12px;
}
header li{
    float: left;
    display: inline;
    padding: 0 10px 0 10px;
}
header #branding{
    float: left;
}
header #branding h1{
    margin: 0;
}
header nav{
    float: right;
    padding-top: 10px;
}
header nav:hover{
    
}

header a:hover{
    color: #cccccc;
    font-weight: bold;
}


.profile-card,.suggestions{
    background: #FEFEFE;
    border:1px solid #f9f9f9;
    border-radius:4px;
    margin-top:45px;
    float:left;
    width:600px;
}
.suggestions{
	float:left;
	margin-left: 10px;
	width:300px;
	padding:5px 5px 5px 10px;
}
.card-image{
    height:300px;
    width:300px;
    padding:10px 5px;
}
.card-image img{
	width:100%;
	height:auto;
}
.sugg-card-img{
	height:60px;
	width:60px;
	float: left;
}
.sugg-card-img img{
	width:100%;
	height:auto
}
.sugg-card-text{
	text-align: initial;
	float:left;
	width:215px;
	padding-left:10px;
}
.card-text{
    text-align: initial;
    width:500px;
    height:auto;
    padding:10px 10px;
    float:left;
}

.card-text h2{
    text-decoration: none;
    text-transform: uppercase;
    font-size: 25px;
    color: black;
    margin-top: -70px;
    margin-left: 65px;
}

.clearfix{
    overflow:show;
}

.clearfix::after{
    clear:both;
    content:" ";
    display:table;
}

.profile-pic{
    margin-left: 50px;
    margin-top: 45px;
}



/*.scroll-text h1{
    font-size: 5px;
    height: auto;
}
*/

.suggestion{
    width: 290px;
    height: 180px;
    background-color:#83aeaa;
    position: fixed;
    bottom: 75px;
}

.suggestion h2 {
    color: #ffffff;
    text-decoration: none;
    text-transform: uppercase;
    text-align: center;
    font-size: 36px;
    margin-top: 45px;
}


        .scrolly{

            position: fixed;
            bottom: 5px;
            width: 1220px;
            height: 270px;
            left: 19%;
            overflow: auto;
            overflow-y: hidden;
            margin: 0 auto;
            white-space: nowrap
        }

        
    </style>
</head>
<body>
   <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight"></span>DVAAR</h1>             
            </div>
            <nav>
                <ul>
                    <li class="current"><a href="#">Home</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </nav>
        </div>
    </header>



    		<div style="width: 100%;text-align: center;position: absolute;width: 100%">
                <div class="cards-wrap clearfix">
            		
            <?php
            	foreach ($result as $rows) {
            		?>

            		<div class="profile-card clearfix">
	            		<div class="card-image">
	            		
	            			<img src="<?php echo $rows['photo']; ?>">';
	            	
	            			
	            		</div>
	            		<div class="card-text">
	            			<p id="name" style="font-size:20px;margin:10px 0">
	            				
                                        
	            				<?php
	            				    

	            					echo $rows['name'];
	            				?>
	            				
	            			</p>
	            			<p id="desig">
	            				<?php
	            					echo $rows['designation'];
	            				?>
	            			</p>
	            			<p id="dept">
	            				<?php
	            					$altr1= str_ireplace("'","",$rows['department']);
									$altr2= str_ireplace(", u , u",",",$altr1);
									$altr3= str_ireplace(", u",",",$altr2);
									$altr4= str_ireplace("[u","",$altr3);
									$altr5= str_ireplace("[","",$altr4);
									$altr6= str_ireplace("]","",$altr5);
									echo $altr6;
									echo ", ";
									echo $rows['Insti']
	            					//echo $altr6;
	            				?>
	            			</p>
	            			<p id="edu"><b>Education -</b> 
	            				<?php
	            					$altr1= str_ireplace("'","",$rows['edu']);
									$altr2= str_ireplace(", u , u",",",$altr1);
									$altr3= str_ireplace(", u",",",$altr2);
									$altr4= str_ireplace("[u","",$altr3);
									$altr5= str_ireplace("[","",$altr4);
									$altr6= str_ireplace("]","",$altr5);
	            					echo $altr6;
	            				?>
	            			</p>
	            			<p id="aoi"><b>Areas of interest -</b> 
	            				<?php
	            					$altr1= str_ireplace("'","",$rows['aoi']);
									$altr2= str_ireplace(", u , u",",",$altr1);
									$altr3= str_ireplace(", u",",",$altr2);
									$altr4= str_ireplace("[u","",$altr3);
									$altr5= str_ireplace("[","",$altr4);
									$altr6= str_ireplace("]","",$altr5);
	            					echo $altr6;
	            					$search_text=(explode(",",$altr6));
	            					echo"<br>-----------------------<br>";
	            					
	            					foreach ($search_text as $i) 
	            					{
	            						/**echo $i;/**/
	            						$ans = mysqli_query($connect,"Select fac_id from profile where aoi REGEXP '$i' and fac_id != '$fac_id'")or die(mysqli_error());
	            						foreach ($ans as $j) {
	            							# code...
	            							array_push($search_arr, $j['fac_id']);
	            						}

	            					     
	            					}
	            					// print_r($search_text)
	            				

	            				?>
	            			</p>
	            			 <p><b>Publications - </b>
	            				<?php
	            					echo $rows['publications'];
	            				?>
	            			</p>
	            			<p><b>E-mail - </b>
	            				<?php
	            					echo $rows['email'];
	            				?>
	            			</p>
	            			<p><b>Address</b>
	            				<?php
	            					echo $rows['address'];
	            				?>
	            			</p>
	            			<p><b>Phone - </b>
	            				<?php
	            					echo $rows['phone'];
	            				?>
	            			</p>

	            			
	            			<p id="prof_back"><b>Professional Background -</b> 
	            				<?php
	            					$altr1= str_ireplace("'","",$rows['prof_b']);
									$altr2= str_ireplace(", u , u",",",$altr1);
									$altr3= str_ireplace(", u",",",$altr2);
									$altr4= str_ireplace("[u","",$altr3);
									$altr5= str_ireplace("[","",$altr4);
									$altr6= str_ireplace("]","",$altr5);
	            					echo $altr6;
	            				?>
	            			</p>
	            			<p id="projects"><b>Projects -</b> 
	            				<?php
	            					$altr1= str_ireplace("'","",$rows['projects']);
									$altr2= str_ireplace(", u , u",",",$altr1);
									$altr3= str_ireplace(", u",",",$altr2);
									$altr4= str_ireplace("[u","",$altr3);
									$altr5= str_ireplace("[","",$altr4);
									$altr6= str_ireplace("]","",$altr5);
	            					echo $altr6;
	            				?>
	            			</p>

	            			<p>
	            				<a href=<?php
	            					echo $rows['link'];
	            				?>>
	            				<b>Visit page - </b>
	            				       
	            				</a>
	            			</p>
	            		</div>
	            	</div>
	            	
	            	<?php
				}
             ?>
             <div class="suggestions">
             <div style="padding:5px 0;color:grey;font-weight: bolder;border-bottom: 1px solid #f9f9f9;font-size: 14px;text-align: initial;margin-bottom: 10px">Similar</div>
             	<?php
             	foreach ($search_arr as $i) {
             		$res = mysqli_query($connect,"Select * from profile where fac_id ='$i'")or die(mysqli_error());
	            		foreach ($res as $row) {
	   						?>
	   						<div class="sugg-card clearfix">
	   							<div class="sugg-card-img">
	   								<img src="<?php echo $row['photo']; ?>">
	   							</div>
	   							<div class="sugg-card-text">
	   								<?php echo $row['name']; ?>
	   							</div>
	   						</div>
	   						<?php
	            		}
             		
             	}
             	?>
             </div>
             </div>
             </div>




                <!-- <div class="suggestion">
                    <h2>Similar Suggestions</h2>
                </div> -->
    
</body>
</html>