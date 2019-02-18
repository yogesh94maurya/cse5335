(:3. List the names of persons and the number of items they bought.:)
<Result3>
{
for $person in doc("auction.xml")/site/people/person
let $id := data($person/@id)
return{
	(<person>&#xa;{$person/name}&#xa;<count>{count(doc("auction.xml")/site/closed_auctions/closed_auction/buyer[@person=$id])}</count>&#xa;</person>,'&#xa;')
}
}
</Result3>



