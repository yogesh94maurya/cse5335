(:1. Print the number of items listed on all continents.:)
<Result1>
{
let $items := doc("auction.xml")/site/regions//item
let $count := count($items)
return 
<count>{$count}</count>
}
</Result1>