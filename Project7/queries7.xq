(: 7. Give an alphabetically ordered list of all items along with their location.:)

<Result7>
{
for $items in doc("auction.xml")/site/regions//item
order by $items/name
return ('&#xa;',$items/name,'&#xa;',$items/location)
}
</Result7>