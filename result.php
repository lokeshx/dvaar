<?php
$connect=mysqli_connect("localhost","root","","unifiedf") or die(mysqli_error());
// echo $_POST['search_text'];

if (isset($_POST['search_text']))
{
	$search_string = $_POST['search_text'];
	// echo "maal";
	$result = mysqli_query($connect,"Select * from profile where aoi REGEXP '$search_string' OR name REGEXP '$search_string' OR department REGEXP '$search_string' OR designation REGEXP '$search_string' OR Insti REGEXP '$search_string' OR edu REGEXP '$search_string'")or die(mysqli_error());
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		<title>IDS Project | Welcomes</title>
		<meta charset="utf-8">
	</title>

<style>
	mark{
		background-color: #cde7e5;
	}	
body,html {
	  background-color: #f9f9f9;
	  font-family: arial, sans-serif;
	  margin:0;
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
	background:#e8491d;
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

#search_button {
    border: 0 none;
    background: #CEB47F  center no-repeat;
    border-radius: 30px;
    width: 150px;
    padding: 0;
    text-align: center;
    height: 45px;
    cursor: pointer;
    color: white;
    font-size: 16px;

}
.profile-card{
	background: #FEFEFE;
	border:1px solid #f0f0f0;
	border-radius:4px;
	margin-top:10px;
}
.card-image{
	height:110px;
	width:100px;
	padding:10px 5px;
	float: left;
}
.card-image img{
	width:100%;
	height:auto;
}
.card-text{
	text-align: initial;
	width:500px;
	height:auto;
	padding:5px 10px;
	float:left;
	font-size:14px;
	cursor: pointer;
}
.clearfix{
	overflow:show;
}

.clearfix::after{
	clear:both;
	content:" ";
	display:table;
}
.filter{
	display: inline-block;
	cursor: pointer;
}
.cards-wrap{
	position: relative;
}
#name{
	font-weight: bolder;
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



	<div >
	<div style="margin:50px auto 40px auto;text-align:center">
		<div style="padding:50px auto 40px auto;text-align:center;display:inline-block">
			<div  class="clearfix">
				<a href="front.html"><button id="search_button">New Search</button></a>
        		
	        </div>
	        
            <div style="padding:10px"> 
            <p style="text-align: initial">Search results for ' <span style="color:#83aeaa;font-size:18px"><?php echo $search_string; ?></span> '</p>

            <div style="margin:5px 0;text-align: initial;" class="filter-wrap">
            	<form>
	            	<div class="filter">
		        		Filter results - 
		        	</div>
		        	<div class="filter">
		        		<input type="radio"  name="filter" value="all" checked="true">All
		        	</div>
		        	<div class="filter">
		        		<input type="radio" name="filter" value="name">Name
		        	</div>
		        	<div class="filter">
		        		<input name="filter" type="radio" value="dept">Department
		        	</div>
		        	<div class="filter">
		        		<input name="filter" type="radio" value="aoi">Area of interest
		        	</div>
		        	<div class="filter">
		        		<input name="filter" type="radio" value="desig">Designation
		        	</div>
		        	<div class="filter">
		        		<input name="filter" type="radio" value="edu">Education
		        	</div>
	        	</form>
	        </div>
	        <div class="cards-wrap">
            		<div style="position: absolute;width:100%;top:50px;text-align: center;font-size:30px;color:grey;z-index: -1">No results</div>
            <?php
            	foreach ($result as $rows) {
            		?>

            		<div class="profile-card clearfix">
	            		<div class="card-image">
	            		<img src="<?php echo $rows['photo']; ?>">;
	            		
	            			
	            		</div>
	            		<div class="card-text">
	            			<form action="result1.php" method="post">
	            			<p id="name" style="font-size:20px;margin:10px 0">
	            				<a href="result1.php?id=<?php echo $rows['fac_id'];?>">
                                        
	            				<?php
	            				    

	            					echo str_ireplace($search_string,'<mark class="matched">'.$search_string.'</mark>',$rows['name']);
	            				?>
	            				</a>
	            			</p>
	            			</form>
	            			<p id="desig">
	            				<?php
	            					echo str_ireplace($search_string,'<mark class="matched">'.$search_string.'</mark>',$rows['designation']);
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
									echo str_ireplace($search_string,'<mark class="matched">'.$search_string.'</mark>',$altr6);
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
	            					echo str_ireplace($search_string,'<mark class="matched">'.$search_string.'</mark>',$altr6);
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
	            					echo str_ireplace($search_string,'<mark class="matched">'.$search_string.'</mark>',$altr6);
	            				?>
	            			</p>
	            			<!-- <p><b>Publications - </b>
	            				<?php
	            					echo $rows['publications'];
	            				?>
	            			</p> -->
	            			<p><b>E-mail - </b>
	            				<?php
	            					echo $rows['email'];
	            				?>
	            			</p>
	            			<p><b>Phone - </b>
	            				<?php
	            					echo $rows['phone'];
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
             </div>
            	
            	
            	
            </div>	
        </div>
	</div>	
	</div>
</div>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	$(document).ready(
		$("input[type='radio']").click(function(){
			
			var selected=$(this).attr('value');
			$(".profile-card").fadeOut(100);
			if(selected!='all'){
				$(".matched").each(function(){
					var parent=$(this).parent();
					// console.log($(this).parent().attr("id"));
					if($(this).parent().attr("id")==selected){
						$(this).parentsUntil(".carda-wrap").fadeIn(100);
					}
				});
			}
			else{
				$(".profile-card").fadeIn(100);
			}
			
		})
		)

</script>
</body>
</html>