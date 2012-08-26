<!DOCTYPE HTML PUBLIC
		"-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		
<html>
<head>
	<title>Explore for Wines</title>
</head>

<body bgcolor="white">
<?php
	
	function displayWines($connection, $query, $wineName, $wineryName, $regionName, $varietyName,$startYear, $endYear, $minStock, $minOrder, $minPrice, $maxPrice)
	{
		$result = @ mysql_query($query, $connection);
		
		$totalRows = @ mysql_num_rows($result);
		
		if ($totalRows > 0)                                                          
		{
			print "<h2>Collection of Wines<br></h2>";
			
			print "\n<table>\n<tr>";

			print "\n\t<th>Wine Name</th>" .
			     "\n\t<th>Grape Variety</th>" .
		             "\n\t<th>Year</th>" .
			     "\n\t<th>Winery</th>" .
			     "\n\t<th>Region</th>" .
		             "\n\t<th>Cost</th>" .
		       	     "\n\t<th>Total Bottles</th>" .
			     "\n\t<th>Total Stock</th>" .
		             "\n\t<th>Sales Revenue</th>\n</tr>";
				 
			while ($row = @ mysql_fetch_array($result))
			{
				print "\n<tr>" .
				      "\n\t<td>" . $row["wine_name"] . "</td>" .
				      "\n\t<td>" . $row["variety"] . "</td>" .
				      "\n\t<td>" . $row["year"] . "</td>" . 
				      "\n\t<td>" . $row["winery_name"] . "</td>" .
				      "\n\t<td>" . $row["region_name"] . "</td>" .
				      "\n\t<td>" . $row["cost"] . "</td>" .
				      "\n\t<td>" . $row["on_hand"] . "</td>" .
				      "\n\t<td>" . $row["qty"] . "</td>" .
				      "\n\t<td>" ;
					 
					 $revenue = $row["qty"] * $row["cost"];
					 
					 printf(" $ <b>%.2f</b>\n", $revenue);
					 
				print "</td>\n</tr>";
			}	
			print "\n</table>\n";
		}
		
		if ($totalRows == 0)
			print "No records match your search criteria";
	}

	$connection = @ mysql_connect("yallara.cs.rmit.edu.au:54561", "root", "password");
	
	$wineName = $_GET['wineName'];
	$wineryName = $_GET['wineryName'];
	$regionName = $_GET['regionName'];
	$varietyName = $_GET['varietyName'];
	$startYear = $_GET['startYear'];
	$endYear = $_GET['endYear'];
	$minStock = $_GET['minStock'];
	$minOrder = $_GET['minOrder'];
	$minPrice = $_GET['minPrice'];
	$maxPrice = $_GET['maxPrice'];

	mysql_select_db("winestore", $connection);
	
	$query = "SELECT wine_name, year, winery_name, variety, region_name, cost, on_hand, qty
		  FROM wine, winery, grape_variety, region, inventory, items, wine_variety 
		  WHERE wine.winery_id = winery.winery_id 
		  AND	wine.wine_id = wine_variety.wine_id 
		  AND	wine.wine_id = inventory.wine_id 
		  AND	wine.wine_id = items.wine_id 
		  AND	winery.region_id = region.region_id
		  AND	wine_variety.variety_id = grape_variety.variety_id";
						
	if (isset($wineName) && $wineName != "All")
		$query .= " AND wine_name = \"$wineName\"";

	if (isset($wineryName) && $wineryName != "All")
		$query .= " AND winery_name = \"$wineryName\"";
					
	if (isset($regionName) && $regionName != "All")
		$query .= " AND region_name = \"$regionName\"";					
	
	if (isset($varietyName) && $varietyName != "All")
		$query .= " AND variety = \"$varietyName\"";
	
	if (isset($startYear))
		$query .= " AND year >= \"$startYear\"";
	
	if (isset($endYear))
		$query .= " AND year <= \"$endYear\"";

	if (isset($minStock))
		$query .= " AND on_hand >= \"$minStock\"";
	
	if (isset($minOrder))
		$query .= " AND qty >= \"$minOrder\"";
	
	
	if (isset($minPrice))
		$query .= " AND cost >= \"$minPrice\"";
	
	if (isset($maxPrice))
		$query .= " AND cost <= \"$maxPrice\"";
	
	displayWines($connection, $query, $wineName, $wineryName, $regionName, $varietyName, $startYear, $endYear, $minStock, $minOrder, $minPrice, $maxPrice);
		
	mysql_close($connection);
	
?>
</body>
</html>

