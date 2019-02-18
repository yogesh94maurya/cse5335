(: 6. List the names of persons and the names of the items they bought in Europe.:)

<Result6>
{
	let $soldItem  := doc("auction.xml")/site/closed_auctions/closed_auction
	for $eachsoldItem in $soldItem
	let $itemid := data($eachsoldItem/itemref/@item)
	let $buyerid := data($eachsoldItem/buyer/@person)
	where $itemid = data(doc("auction.xml")/site/regions/europe/item/@id)
	return
	('&#xa;',<name>{data(doc("auction.xml")/site/people/person[@id = $buyerid]/name)}</name>,'&#xa;',
	<item>{data(doc("auction.xml")/site/regions/europe/item[@id = $itemid]/name)}</item>)
}
</Result6>
