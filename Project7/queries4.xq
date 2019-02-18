(:4. List all persons according to their interest (ie, for each interest category, display the persons on that category).:)
<Result4>
{
	let $category := doc("auction.xml")/site/categories/category
	for $eachcategory in $category
	let $id := data($eachcategory/@id)
	return
	(	'&#xa;',<category>{data($eachcategory/name)}</category>,'&#xa;',
	{
		for $person in doc("auction.xml")/site/people/person
		where $person/profile/interest/@category = $id
		return ($person/name,'&#xa;')
	})
}
</Result4>