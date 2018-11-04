<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="/">
        <html>
            <body>
                <h1>
                    Listado de Preguntas:
                </h1>
                <table border="1">
                    <tr>
                        <th>Tema</th>
                        <th>Autor</th>
                        <th>Enunciado</th>
                        <th>Respuesta correcta</th>
                        <th>Incorrectas</th>
                    </tr>
                <xsl:for-each select="assessmentItems/assessmentItem">
                    <tr>
                        <td> <xsl:value-of select="./@subject"/></td>
                        <td> <xsl:value-of select="./@author"/></td>
                        <td> <xsl:value-of select="./itemBody/p"/></td>
                        <td><xsl:value-of select="./correctResponse/value"/></td>
                        <td> 
                            <xsl:for-each select="./incorrectResponses/value">
                             <xsl:value-of select="."/><br></br>
                            </xsl:for-each>
                        </td>
                    </tr>
                       
                    
                </xsl:for-each>
                </table>
                
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
