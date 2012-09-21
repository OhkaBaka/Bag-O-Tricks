<cfsetting showdebugoutput="no" enablecfoutputonly="yes" >

<cfset CRLF="#Chr(13)##Chr(10)#">

<cfset l_FIPS = "Alabama|1|AL|1,Alaska|2|AK|4,Arizona|4|AZ|2,Arkansas|5|AR|1,California|6|CA|3,Colorado|8|CO|3,Connecticut|9|CT|1,District of Columbia|11|DC|2,Delaware|10|DE|1,Florida|12|FL|2,Georgia|13|GA|3,Hawaii|15|HI|4,Idaho|16|ID|3,Illinois|17|IL|1,Indiana|18|IN|3,Iowa|19|IA|4,Kansas|20|KS|2,Kentucky|21|KY|2,Maine|23|ME|1,Maryland|24|MD|4,Massachusetts|25|MA|3,Louisiana|22|LA|3,Michigan|26|MI|1,Minnesota|27|MN|1,Mississippi|28|MS|2,Missouri|29|MO|3,Montana|30|MT|1,Nebraska|31|NE|1,Nevada|32|NV|1,New Hampshire|33|NH|4,New Jersey|34|NJ|3,New Mexico|35|NM|1,New York|36|NY|4,North Carolina|37|NC|2,North Dakota|38|ND|2,Ohio|39|OH|4,Oklahoma|40|OK|4,Oregon|41|OR|2,Pennsylvania|42|PA|2,Rhode Island|44|RI|2,South Carolina|45|SC|1,South Dakota|46|SD|3,Tennessee|47|TN|4,Texas|48|TX|2,Utah|49|UT|4,Vermont|50|VT|2,Virginia|51|VA|1,Washington|53|WA|1,West Virginia|54|WV|3,Wisconsin|55|WI|2,Wyoming|56|WY|2" >
<cfset a_FIPS = ArrayNew(1)>
<cfloop list="#l_FIPS#" index="FIPIX">
	<cfset a_FIPS[ ArrayLen(a_FIPS)+1 ] = StructNew() ><cfset a_FIPS[ ArrayLen(a_FIPS) ].name = ListGetAt( FIPIX, 1, '|') ><cfset a_FIPS[ ArrayLen(a_FIPS) ].code = ListGetAt( FIPIX, 2, '|') ><cfset a_FIPS[ ArrayLen(a_FIPS) ].abbr = ListGetAt( FIPIX, 3, '|')><cfset a_FIPS[ ArrayLen(a_FIPS) ].color = ListGetAt( FIPIX, 4, '|')>
</cfloop>

<cfset precVal = 2 >
<cfset precMask = "0.#repeatString('0', precVal)#">

<!---
<cfloop from="1" to="#ArrayLen(a_FIPS)#" index="FIPIX">
--->
<cfif isdefined("URL.state")>
	<cfloop from="1" to="#ArrayLen(a_FIPS)#" index="FIPIX">
		<cfif a_FIPS[ FIPIX ].abbr EQ URL.state>
			<cfset currentFIPS = numberFormat(a_FIPS[ FIPIX ].code, "00" ) >
			<cfset currentSTATE = a_FIPS[ FIPIX ].name >
			<cfset currentABBR = a_FIPS[ FIPIX ].abbr >
	
			<cfswitch expression="#a_FIPS[ FIPIX ].color#" >
				<cfcase value="1"><cfset currentCOLOR = "red"></cfcase>
				<cfcase value="2"><cfset currentCOLOR = "blue"></cfcase>
				<cfcase value="3"><cfset currentCOLOR = "green"></cfcase>
				<cfcase value="4"><cfset currentCOLOR = "yellow"></cfcase>
			</cfswitch>
		</cfif>
	</cfloop>

	<cfhttp url="http://www.introprod.com/samples/usgs2kml/tbf/st#CurrentFIPS#_d00.dat" method="get" ></cfhttp>
	<cfset stateInFile = cfhttp.FileContent >
	<cfset stateInFile = REReplace( stateInFile, '(E\+0[0-9]) +','\1|', 'ALL' )>
	<cfset stateInFile = REReplace( stateInFile, ' +([0-9]+) +', '', 'ALL' )>
	<cfset stateInFile = REReplace( stateInFile, '\n +',',', 'ALL' )>
	<cfset stateInFile = REReplace( stateInFile, '\n','', 'ALL' )>
	<cfset stateInFile = REReplace( stateInFile, 'END','~', 'ALL' )>

	<cfset a_stateIn=ListToArray( stateInFile, '~' ) >

	<cfloop from="1" to="#ArrayLen( a_stateIn )#" index="ixA" >
		<cfset a_stateIn[ixA] = ListToArray( a_stateIn[ixA], "," ) >
		<cfloop from="1" to="#ArrayLen( a_stateIn[ixA] )#" index="ixB" >
			<cfset a_stateIn[ixA][ixB] = ListToArray( a_stateIn[ixA][ixB], "|" ) >
			<cfset a_stateIn[ixA][ixB][1] = NumberFormat(a_stateIn[ixA][ixB][1], "0.00000") >
			<cfset a_stateIn[ixA][ixB][2] = NumberFormat(a_stateIn[ixA][ixB][2], "0.00000") >
		</cfloop>
	</cfloop>
	
	<cfset a_stateOut = ArrayNew(1) >

	<cfloop from="1" to="#ArrayLen( a_stateIn )#" index="ixA" >
		<cfset dropSame = 0 >
		<cfset dropInline = 0 >

		<cfset a_stateOut[ixA] = ArrayNew(1) >
		<cfset a_stateOut[ixA][1] = ArrayNew(1) >
		<cfset a_stateOut[ixA][1][1] = a_stateIn[ixA][2][1] >
		<cfset a_stateOut[ixA][1][2] = a_stateIn[ixA][2][2] >
		
		<cfloop from="2" to="#ArrayLen( a_stateIn[ixA] )-1#" index="ixB" >

			<cfif a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][2] - a_stateIn[ixA][ixB][2] EQ 0 >
				<cfset thisRiseRun = numberFormat( ( a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][1] - a_stateIn[ixA][ixB][1] )/0.00001, precMask) >
			<cfelse>
				<cfset thisRiseRun = numberFormat( ( a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][1] - a_stateIn[ixA][ixB][1] )/( a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][2] - a_stateIn[ixA][ixB][2] ), precMask) >
			</cfif>

			<cfif a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][2] - a_stateIn[ixA][ixB+1][2] EQ 0 >
				<cfset nextRiseRun = numberFormat( ( a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][1] - a_stateIn[ixA][ixB+1][1] )/0.00001, precMask) >
			<cfelse>
				<cfset nextRiseRun = numberFormat( ( a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][1] - a_stateIn[ixA][ixB+1][1] )/( a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][2] - a_stateIn[ixA][ixB+1][2] ), precMask) >
			</cfif>

			<cfif a_stateIn[ixA][ixB-1][2] - a_stateIn[ixA][ixB+1][2]  EQ 0 >
				<cfset centerRiseRun = numberFormat( ( a_stateIn[ixA][ixB-1][1] - a_stateIn[ixA][ixB+1][1] )/0.00001, precMask) >
			<cfelse>
				<cfset centerRiseRun = numberFormat( ( a_stateIn[ixA][ixB-1][1] - a_stateIn[ixA][ixB+1][1] )/( a_stateIn[ixA][ixB-1][2] - a_stateIn[ixA][ixB+1][2] ), precMask) >
			</cfif>

			<cfset thisLat = NumberFormat(a_stateIn[ixA][ixB][2] , precMask ) >
			<cfset lastLat =  NumberFormat(a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][2] , precMask ) >
		
			<cfset thisLng = NumberFormat(a_stateIn[ixA][ixB][1] , precMask ) >
			<cfset lastLng =  NumberFormat(a_stateOut[ixA][ArrayLen( a_stateOut[ixA] )][1] , precMask ) >

			<cfif isdefined( 'dummyIf' )>
				<!---
				35.008909, -88.203049 : 
				34.903671, -88.125458 : 
				35.006940, -88.001518 : 
				--->
			<cfelseif ( ( thisLat EQ lastLat ) AND ( thisLng EQ lastLng ) ) AND ( abs(thisRiseRun-nextRiseRun) + abs(thisRiseRun-centerRiseRun) LTE 1000 )>
				<cfset bgcolor="##FFFFAA" >
				<cfset dropSame = dropSame+1 >
			<cfelseif ( thisRiseRun EQ nextRiseRun AND thisRiseRun EQ centerRiseRun ) AND ( ABS( thisLat - lastLat ) + ABS( thisLng - lastLng ) LTE .05 ) >
				<cfset dropInline = dropInline+1 >
				<cfset bgcolor="##FFAAAA" >
			<cfelse>
				<cfset bgcolor="##AAFFAA" >
				<cfset a_stateOut[ixA][ ArrayLen( a_stateOut[ixA] ) + 1] = ArrayNew(1) >
				<cfset a_stateOut[ixA][ ArrayLen( a_stateOut[ixA] ) ][1] = a_stateIn[ixA][ixB][1] >
				<cfset a_stateOut[ixA][ ArrayLen( a_stateOut[ixA] ) ][2] = a_stateIn[ixA][ixB][2] >
			</cfif>

		</cfloop>

		<cfset a_stateOut[ixA][ ArrayLen( a_stateOut[ixA] ) + 1] = ArrayNew(1) >
		<cfset a_stateOut[ixA][ ArrayLen( a_stateOut[ixA] ) ][1] = a_stateOut[ixA][1][1] >
		<cfset a_stateOut[ixA][ ArrayLen( a_stateOut[ixA] ) ][2] = a_stateOut[ixA][1][2] >

	</cfloop>


	<cfset lowLat = a_stateIn[1][1][2] >
	<cfset lowLng = a_stateIn[1][1][1] >
	<cfset hiLat = a_stateIn[1][1][2] >
	<cfset hiLng = a_stateIn[1][1][1] >

	<cfset l_stateOut = "">
	<cfloop from="1" to="#ArrayLen( a_stateOut )#" index="ixA" >
		<cfif ArrayLen( a_stateOut[ixA] ) GTE 3 >
			<cfset l_stateOutSub = "">
			<cfloop from="1" to="#ArrayLen( a_stateOut[ixA] )#" index="ixB" >
				<cfset l_stateOutSub = "#l_stateOutSub##CRLF##a_stateOut[ixA][ixB][1]#,#a_stateOut[ixA][ixB][2]#,0" >
			</cfloop>
			<cfset l_stateOut = listAppend( l_stateOut, "<LinearRing><coordinates>#l_stateOutSub#</coordinates></LinearRing>#CRLF#" ) >

			<cfif a_stateIn[ixA][ixB][2] LT lowLat >
				<cfset lowLat = a_stateIn[ixA][ixB][2] >
			<cfelseif a_stateIn[ixA][ixB][2] GT hiLat >
				<cfset hiLat = a_stateIn[ixA][ixB][2]  >
			</cfif>

			<cfif a_stateIn[ixA][ixB][1] LT lowLng >
				<cfset lowLng = a_stateIn[ixA][ixB][1] >
			<cfelseif a_stateIn[ixA][ixB][1] GT hiLng >
				<cfset hiLng = a_stateIn[ixA][ixB][1]  >
			</cfif>

		</cfif>
	</cfloop>

	
	<cfset centerLat = ( ( hiLat - lowLat ) / 2 ) + lowLat >
	<cfset centerLng = ( ( hiLng - lowLng ) / 2 ) + lowLng >

	<cfsavecontent variable="Placemark"><cfoutput><Placemark>
			<styleUrl>###currentCOLOR#</styleUrl>
			<name>The Great State of #currentState#</name>
			<description><![CDATA[ Boundaries of #currentState# ]]></description>
			<altitudeMode>relative</altitudeMode>
		
			<MultiGeometry>
				<Point><coordinates>#centerLng#,#centerLat#,0</coordinates></Point>
				<Polygon>
					<outerBoundaryIs>
					#l_stateOut#
					</outerBoundaryIs>
				</Polygon>
			</MultiGeometry>
		</Placemark>
	</cfoutput></cfsavecontent>

	<cfsavecontent variable="kmlStateOut"><cfoutput><?xml version="1.0" encoding="UTF-8"?>
	<kml xmlns="http://earth.google.com/kml/2.1">
	<Document>
		<name>#currentSTATE# KML Outline</name>
		<description>Outline and Center for the state of #currentSTATE#</description>
		<Style id="red">
			<LineStyle><color>990000ff</color><width>3</width></LineStyle><PolyStyle>
			<color>550000ff</color><fill>1</fill><outline>1</outline></PolyStyle>
		</Style>
		<Style id="blue">
			<LineStyle><color>99ff0000</color><width>3</width></LineStyle>
			<PolyStyle><color>55ff0000</color><fill>1</fill><outline>1</outline></PolyStyle>
		</Style>
		<Style id="green">
			<LineStyle><color>9900ff00</color><width>3</width></LineStyle>
			<PolyStyle><color>5500ff00</color><fill>1</fill><outline>1</outline></PolyStyle>
		</Style>
		<Style id="yellow">
			<LineStyle><color>9900ffff</color><width>3</width></LineStyle>
			<PolyStyle><color>5500ffff</color><fill>1</fill><outline>1</outline></PolyStyle>
		</Style>
		#placemark#
	  </Document>
	</kml>
	</cfoutput></cfsavecontent>

	<cfcontent type="application/vnd.google-earth.kml+xml">
	<cfoutput>#kmlStateOut#</cfoutput>

</cfif>
<!--- </cfloop> --->

