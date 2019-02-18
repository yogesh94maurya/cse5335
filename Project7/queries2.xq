(:2. List the names of items registered in Europe along with their descriptions.:)
<Result2>
{
for $item in doc("auction.xml")/site/regions/europe/item
return 
(<item>&#xa;	{$item/name} &#xa;	<description> &#xa;		{$item/description/text} &#xa;	</description>&#xa;</item>, '&#xa;')
}
</Result2>