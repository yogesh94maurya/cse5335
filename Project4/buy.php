<?php
	//print_r($_SESSION);
	if(session_id() == '' || !isset($_SESSION)){
		session_start();
		if(!isset($_SESSION["productList"])){
			$_SESSION["productList"] = array();
			$_SESSION["Total_Price"] = 0 ;
			//echo "Var Set";
		}
	}
	
?>
<html>
<head>
	<title>Buy Products</title>
	<style>
		body{
			font-family: monospace;
		}
		th{
			font-size: 14px;
		}
		th,td {
			border: 1px dotted #ccc;
			//background: #eee;
			padding: 5px;
		}
		tr:nth-child(even) {background: #eee}
		tr:nth-child(odd) {background: #FFF}
		
	</style>
</head>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors','on');
	$treeXmlResponse = file_get_contents('http://sandbox.api.ebaycommercenetwork.com/publisher/3.0/rest/CategoryTree?apiKey=78b0db8a-0ee1-4939-a2f9-d3cd95ec0fcc&visitorUserAgent&visitorIPAddress&trackingId=7000610&categoryId=72&showAllDescendants=true');
	$category_xml = new SimpleXMLElement($treeXmlResponse);
?>
<?php
	if(isset($_GET["category"]) && isset($_GET["search"])){
		$searchCat = $_GET["category"];
		$searchKeyword = $_GET["search"];
		$productXmlResponse = file_get_contents('http://sandbox.api.shopping.com/publisher/3.0/rest/GeneralSearch?apiKey=78b0db8a-0ee1-4939-a2f9-d3cd95ec0fcc&visitorUserAgent&visitorIPAddress&trackingId=7000610&numItems=100&keyword='.$searchKeyword.'&categoryId='.$searchCat);
		$productList_xml = new SimpleXMLElement($productXmlResponse);
		$_SESSION["Keyword"] = $searchKeyword;
		$_SESSION["Category"] = $searchCat;
		$_SESSION["lastSearch"] = $productXmlResponse;
	}
?>
<?php
	if(isset($_GET["buy"])){
		$productList_xml = new SimpleXMLElement($_SESSION["lastSearch"]);
		foreach ($productList_xml->categories->category->items->product as $product) {
			if ((string) $product['id'] == $_GET["buy"]) {
				//echo (string) $poster->full_image['url'];
				$_SESSION["productList"][$_GET["buy"]]["id"] = (int)$product['id'];
				$_SESSION["productList"][$_GET["buy"]]["img"] = (string)$product->images->image->sourceURL;
				$_SESSION["productList"][$_GET["buy"]]["price"] = (double)$product->minPrice;
				$_SESSION["productList"][$_GET["buy"]]["name"] = (string)$product->name;
				$_SESSION["productList"][$_GET["buy"]]["url"] = (string)$product->productOffersURL;
				if(isset($_SESSION["productList"][$_GET["buy"]]["count"])){
					$_SESSION["productList"][$_GET["buy"]]["count"] += 1;
				}else{
					$_SESSION["productList"][$_GET["buy"]]["count"] = 1;
				}
				$_SESSION["productList"][$_GET["buy"]]["totalPrice"] = (double)$product->minPrice * $_SESSION["productList"][$_GET["buy"]]["count"];
				$_SESSION["Total_Price"] += (double)$product->minPrice;
			}
		}
	}
?>
<?php
	if(isset($_GET["delete"])){
		if($_SESSION["productList"][$_GET["delete"]]["count"] == 1){
			$_SESSION["Total_Price"] = (double)$_SESSION["Total_Price"] - (double)($_SESSION["productList"][$_GET["delete"]]["price"] * $_SESSION["productList"][$_GET["delete"]]["count"]);
			unset($_SESSION["productList"][$_GET["delete"]]);
		}else{
			$_SESSION["Total_Price"] = (double)$_SESSION["Total_Price"] - (double)$_SESSION["productList"][$_GET["delete"]]["price"];
			$_SESSION["productList"][$_GET["delete"]]["count"] -= 1;
			$_SESSION["productList"][$_GET["delete"]]["totalPrice"] = (double)$_SESSION["productList"][$_GET["delete"]]["price"] * $_SESSION["productList"][$_GET["delete"]]["count"];
		}
	}
?>
<?php
	if(isset($_GET["deleteAll"])){
		$_SESSION["Total_Price"] = (double)$_SESSION["Total_Price"] - (double)($_SESSION["productList"][$_GET["deleteAll"]]["price"] * $_SESSION["productList"][$_GET["deleteAll"]]["count"]);
		unset($_SESSION["productList"][$_GET["deleteAll"]]);	
	}
?>
<?php
	if(isset($_GET["clear"])){
		$_SESSION["productList"] = array();
		$_SESSION["Total_Price"] = 0 ;	
	}
?>


<body>
	<?php if(!empty($_SESSION["productList"])){ ?>
	<p><b>Shopping Basket:</b></p>
	<p></p>
		<table border="1">
			<tbody>
				<tr>
					<th>Source Image</th>
					<th>Device</th> 
					<th>Price each piece</th>
					<th>count</th>
					<th>Total price</th>
					<th></th>
					<th></th>
				</tr>
				<?php //print_r($_SESSION["productList"]); ?>
				<?php foreach($_SESSION["productList"] as $item_product){ ?>
				<tr>
					<td><a href='<?php print $item_product["url"] ?>'><img src='<?php print $item_product['img'] ?>' /></a></td>
					<td><?php print $item_product['name'] ?></td>
					<td>$ <?php print $item_product['price'] ?></td>
					<td><?php print $item_product['count'] ?></td>
					<td><?php print $item_product['totalPrice'] ?></td>
					<td><a href='buy.php?delete=<?php print $item_product['id']; ?>'>Delete</a></td>
					<td><a href='buy.php?deleteAll=<?php print $item_product['id']; ?>'>Delete All</a></td>
				</tr>
		<?php }?>
			</tbody>
		</table>
	<p><b>Total: </b>$ <?php if(isset($_SESSION)){ print $_SESSION["Total_Price"]; }?></p>
	<form action="buy.php" method="GET">
		<input type="hidden" name="clear" value="1">
		<input type="submit" value="Empty Basket">
	</form>
		<?php }?>
	<form action="buy.php" method="GET">
		<fieldset>
			<legend>Find products:</legend>
			<label>Category: 
				<select name="category">
					<option value="<?php  print $category_xml->category['id']?>">
						<?php print $category_xml->category->name ?>
					</option>
					<?php foreach($category_xml->category->categories->category as $subCatList){?>
						<optgroup label="<?php print $subCatList->name?>" value="<?php print $subCatList['id'] ?>">
							<option value="<?php print $subCatList['id']?>"><?php print $subCatList->name ?></option>
							<?php 
								foreach($subCatList->categories->category as $eachSubCat){ ?>
										<option value="<?php print $eachSubCat['id'] ?>">
										<?php print $eachSubCat->name ?></option>
								<?php } ?>
						</optgroup>
					<?php } ?>
				</select>
			</label>
			<label>Search keywords: <input type="text" name="search" required></label>
			<label><input type="submit" value="Search"></label>
		</fieldset>
	</form>
	<p>
		<?php if(isset($productList_xml)): ?>
		<table border=2>
			<tr>
				<th>Source Image</th>
				<th>Device</th> 
				<th>Price</th>
				<th>Description</th>
			</tr>
			<?php foreach($productList_xml->categories->category->items->product as $product_list_xml) {?>
			<tr>
				<td><a href='?buy=<?php print $product_list_xml['id'] ?>'>
				<img src='<?php print $product_list_xml->images->image->sourceURL ?>'/></a></td>
				<td><?php print $product_list_xml->name; ?></td>
				<td>$<?php print $product_list_xml->minPrice; ?></td>
				<td><?php print $product_list_xml->fullDescription; ?></td>
			</tr>
		<?php } ?>
		</table>
		<?php endif; ?>
	</p>
</body>
</html>
