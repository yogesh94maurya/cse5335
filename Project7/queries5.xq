(: 5. Group persons by their categories of interest and output the size of each group.:)
<Result5>
{
	let $category := doc("auction.xml")/site/categories/category
	for $eachcategory in $category
	let $id := data($eachcategory/@id)
	return
	(	'&#xa;',<category>{data($eachcategory/name)}</category>,'&#xa;',
	<groupsize>{count(doc("auction.xml")/site/people/person/profile/interest[@category=$id]/..)}</groupsize>,'&#xa;',
	{
		for $person in doc("auction.xml")/site/people/person
		where $person/profile/interest/@category = $id
		return ($person/name,'&#xa;')
	})
}
</Result5>