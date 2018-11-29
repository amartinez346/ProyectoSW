<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>		
			<head>
				<title>VerPreguntasXSL</title>
				<meta charset="utf-8"/>
				<meta http-equiv="content-type" content="text/html; charset=windows-1252" />
				<link rel="stylesheet" type="text/css" href="estilos/style.css" />
				<link rel='stylesheet' type='text/css' media='only screen and (min-width: 530px) and (min-device-width: 481px)' href='estilos/wide.css' />
				<link rel='stylesheet' type='text/css' media='only screen and (max-width: 480px)' href='estilos/smartphone.css' />
			</head>
			<body>
				<div id='page-wrap'>
					<header class='main' id='h1'>
						<h2>Preguntas con XSL</h2>
						<br></br>
						<table style="width:100%; border:1px solid black; border-collapse: collapse;">
							<tr>
								<th>Autor</th>
								<th>Pregunta</th>
								<th>Respuesta correctas</th>
								<th>Respuestas incorrectas</th>
								<th>Tema</th>							
							</tr>
							<xsl:for-each select="assessmentItems/assessmentItem">
								<tr>
									<td><xsl:value-of select="@author"/></td>
									<td><xsl:value-of select="itemBody/p"/></td>
									<td><xsl:value-of select="correctResponse/value"/></td>
									<td>
										<xsl:for-each select="incorrectResponses/value">
											<xsl:value-of select="."/>
											<br></br>
										</xsl:for-each>
									</td>							
									<td><xsl:value-of select="@subject"/></td>
								</tr>
								<br></br>
							</xsl:for-each>
						</table>
					</header>
				</div>
			</body>	
		</html>	
	</xsl:template>
</xsl:stylesheet>