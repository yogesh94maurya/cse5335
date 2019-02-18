(: 8. List the reserve prices of those open auctions where a certain person with id person3 issued a bid before another person with id person6. (Here before means "listed before in the XML document", that is, before in document order).:)

<Result8>
{
for $openauction in doc("auction.xml")/site/open_auctions/open_auction
where index-of($openauction/bidder/personref/@person,'person3')<index-of($openauction/bidder/personref/@person,'person6')
return data($openauction/reserve)
}
</Result8>