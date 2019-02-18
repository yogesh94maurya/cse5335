let $items := doc("auction.xml")/site/regions//item
let $count := count($items)
return 
(<count>{$count}</count>, '&#xa;'),
for $item in doc("auction.xml")/site/regions/europe/item
return 
(<item>&#xa;	{$item/name} &#xa;	<description> &#xa;		{$item/description/text} &#xa;	</description>&#xa;</item>, '&#xa;')