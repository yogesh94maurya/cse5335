<?xml version="1.0"?>

<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="*">
  <html>
  <head>
	<style>
		.heading{
			background: #FFBB00;
			margin: 0px;
			padding: 10px
		}
		.ind-recipe{
			background: #FFBB00;
			margin-bottom: 10px;
			border: 2px dashed #666;
		}
		.ind-recipe > h3, .ind-recipe > p, .ind-recipe > small{
			padding: 10px;
		}
		.ind-recipe > h3{
			border-bottom: 1px dotted;
		}
		p{
			margin-top: 0px;
		}
		.title{
			margin-top: 0px;
		}
	</style>
  </head>
  <body>
    <h2 class="heading"><xsl:value-of select="/collection/description" /></h2>
      <xsl:for-each select="/collection/recipe">
        <div class="ind-recipe">
			<h3	class="title"><xsl:value-of select="title"/></h3>
			<small class="date"><xsl:value-of select="date"/></small>
			<p><b>Ingredients:</b></p>
			<ul>
				<xsl:for-each select="ingredient">
					<li>
						<p>
							<xsl:value-of select="@name"/>&#160;
							<xsl:if test="@amount and @amount != '*'">
								-&#160;<xsl:value-of select="@amount"/><xsl:value-of select="@unit"/>
							</xsl:if>
							<xsl:if test="ingredient">
								<br/><b>Ingredients:</b>
								<ul>
									<xsl:for-each select="ingredient">
										<li>
											<p>
											<xsl:value-of select="@name"/>&#160;
											<xsl:if test="@amount and @amount != '*'">
												-&#160;<xsl:value-of select="@amount"/><xsl:value-of select="@unit"/>
											</xsl:if>
											<xsl:if test="ingredient">
												<br/><b>Ingredients:</b>
												<ul>
													<xsl:for-each select="ingredient">
														<li>
															<p>
															<xsl:value-of select="@name"/>&#160;
																<xsl:if test="@amount and @amount != '*'">
																	-&#160;<xsl:value-of select="@amount"/><xsl:value-of select="@unit"/>
															</xsl:if>
															<xsl:if test="ingredient">
																<br/><b>Ingredients:</b>
																<ul>
																	<xsl:for-each select="ingredient">
																		<li>
																			<p>
																			<xsl:value-of select="@name"/>&#160;
																				<xsl:if test="@amount and @amount != '*'">
																					-&#160;<xsl:value-of select="@amount"/><xsl:value-of select="@unit"/>
																			</xsl:if>
																			</p>
																		</li>
																	</xsl:for-each>
																</ul>
																<b>Preparation:</b>
																<ol>
																	<xsl:for-each select="preparation/step">
																		<li>
																			<xsl:value-of select="self::node()"/>
																		</li>
																	</xsl:for-each>
																</ol>
															</xsl:if>
															</p>
														</li>
													</xsl:for-each>
												</ul>
												<b>Preparation:</b>
												<ol>
													<xsl:for-each select="preparation/step">
														<li>
															<xsl:value-of select="self::node()"/>
														</li>
													</xsl:for-each>
												</ol>
											</xsl:if>
											</p>
										</li>
									</xsl:for-each>
								</ul>
								<b>Preparation:</b>
								<ol>
									<xsl:for-each select="preparation/step">
										<li>
											<xsl:value-of select="self::node()"/>
										</li>
									</xsl:for-each>
								</ol>
							</xsl:if>
						</p>
					</li>
				</xsl:for-each>
			</ul>
			
			<xsl:if test="preparation">
				<p class="preparation">
					<b>Preparation:</b>
				</p>
				<ol>
					<xsl:for-each select="preparation/step">
						<li>
							<xsl:value-of select="self::node()"/>
						</li>
					</xsl:for-each>
				</ol>
			</xsl:if>
			<xsl:if test="comment">
				<p class="comment">
					<b>comment:</b><br/>
					<xsl:value-of select="comment"/>
				</p>
			</xsl:if>
			<xsl:if test="nutrition">
				<p><b>Nutritions:</b><br/>
					<xsl:if test="nutrition/@calories">Calories: <xsl:value-of select="nutrition/@calories"/><br/></xsl:if>
					<xsl:if test="nutrition/@fat">fat: <xsl:value-of select="nutrition/@fat"/><br/></xsl:if>
					<xsl:if test="nutrition/@carbohydrates">carbohydrates: <xsl:value-of select="nutrition/@carbohydrates"/><br/></xsl:if>
					<xsl:if test="nutrition/@protein">protein: <xsl:value-of select="nutrition/@protein"/><br/></xsl:if>
					<xsl:if test="nutrition/@alcohol">alcohol: <xsl:value-of select="nutrition/@alcohol"/><br/></xsl:if>
				</p>
			</xsl:if>
			<xsl:if test="related">
				<p><b>Related: </b><br/><xsl:value-of select="related"/></p>
			</xsl:if>
        </div>
      </xsl:for-each>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>