<?
##############################################################
##Author: Sihab Sahariar
##Author Company: Team Error
##Author URL: github.com/sihabsahariar
##################################################################

###################### VARIABLES DESCRIPTION #####################
# $file is the name of this file
# $q is the search term(s). We replace spaces with '+' to adhere to google query string
# $num is the number of results to display per page
# $start is the result that we start on. We use this to break up large result counts into pages
# $page is for us to ensure proper values go to the $start variable.
# $pages is the number of pages you want to offer the user to search.. at the bottom
# $search is the value passed to actually perform the search. If $search != 1, the search field appears.
# $ref is the url, filesize, date, etc. that google usually prints in green. This variable determines the color of that string.
######################################################################

global $file;
global $q;
global $num;
global $start;
global $page;
global $pages;
global $search;
global $ref;

$file = "google.php";
$ref = "purple"; #hex or color name both work here
$pages = 10;

#include('includes.php'); // if you have any db files or anything you want to include\


?>
<html>
<head><title>Search Engine Based on Google</title>
<style>
body,td,div,.p,a{font-family:arial,sans-serif }
div,td{color:#000000}
.f,.fl:link{color:#333333}
a:link,.w,a.w:link,.w a:link{color:#cc0000}
a:visited,.fl:visited{color:#cc0000}
a:active,.fl:active{color:#3f3f3f}
.t a:link,.t a:active,.t a:visited,.t{color:#ffffff}
.t{background-color:#cfcfcf}
.h{color:#cc0000}
.i,.i:link{color:#333333}
.a,.a:link{color:#333333}
.z{display:none}
div.n {margin-top: 1ex}
.n a{font-size:10pt; color:#333333}
.n .i{font-size:10pt; font-weight:bold}
.q a:visited,.q a:link,.q a:active,.q {color: #333333; text-decoration: none;}
.b{font-size: 10pt; color:#333333; font-weight:bold}
.ch{cursor:pointer;cursor:hand}
.e{margin-top: .75em; margin-bottom: .75em}
.g{margin-top: 1em; margin-bottom: 1em}
</style>
<script language="JavaScript">
<!--
function ss(w){window.status=w;return true;}
function cs(){window.status='';}
function clk(n,el) {if(document.images){(new Image()).src="/url?sa=T&start="+n+"&url="+escape(el.href);}return true;}
//-->
</script>
<script language="JavaScript">
<!--
function ga(o,e){if (document.getElementById){a=o.id.substring(1); p = "";r = "";g = e.target;if (g) { t = g.id;f = g.parentNode;if (f) {p = f.id;h = f.parentNode;if (h) r = h.id;}} else{h = e.srcElement;f = h.parentNode;if (f) p = f.id;t = h.id;}if (t==a || p==a || r==a) return true;location.href=document.getElementById(a).href}}
//-->
</script>
</head>
<body>
<?

if($search == '1')
  {

	if(!$num)
	  $num=10;

	if(!$q)
	  $q = "Alien Creations";
    else
      $q = str_replace(chr(32),chr(43), $q);

	if(!$page)
	  $page=1;

	if($page > 1)
	  $start = $num * $page;
	else
	  $start = 0;


	$url = "http://www.google.com/search?q=$q&num=$num&start=$start"; // basic google query url

	$handle = fopen ("$url", "r");
	$contents = "";
	do {
	   $data = fread($handle, 10000);
	   if (strlen($data) == 0) {
		   break;
	   }
	   $contents .= $data;
	} while(true);
	fclose ($handle);

    #echo "Search results: <br><br>";
    #echo "Q = $q<br>Num = $num<br>Page=$page<br>Start=$start<br>Search=$search";

	$split1 = "seconds)&nbsp;</font></td></tr></table>"; // end of google header - this may change so keep tabs on googles source code
	$split2 = "<img src=/nav_"; // beginning of google footer - this may also change - see above

	$results = explode($split1, $contents); // seperate header from page

	//print_r($results); // use to check array in debugging

	$topchunk = $results[0]; // google header, which we wont be using
	$midchunk = $results[1]; // the rest of the page, which includes the body and footer

	$results2 = explode($split2, $midchunk); // seperate footer from page

	$body = $results2[0]; // the page without the header or footer

	echo "<table align=left width=750><tr><td>";

    ## Did you mean:
	$lookfor = "search?";
	$switchto = "$file?search=1&num=$num&start=$start&page=$page&";
	$body = str_replace($lookfor, $switchto, $body);

	## $ref color change
	$lookfor = "#008000";
	$switchto = $ref;
	$body = str_replace($lookfor, $switchto, $body);


	echo $body;
	echo "</td></tr></table></div>";
	echo "<center>";

	for($i=1; $i<$pages; $i++)
	  {
	    echo "<a href=$file?search=1&q=$q&num=$num&start=$start&page=$i>$i</a>&nbsp;";
	  }

	echo "</center>";
  }
else
  {

  echo "<form name=search method=post action=$file?search=1>
  		<input type=text name=q><input type=submit value=Search></form>";

  }

?>

</body>
</html>