sfPlugins
=========

reportPlugin
============
ReportPugin has the following dependencies, which I can't package all together:

* Word2FO a great tool from RenderX http://www.renderx.com/tools/word2fo.html which I modified so that you can create XSLT stylesheets that consume XML data instead of a final XSLFO document. I distribute the Path though, (in reportPlugin\doc\Word2FO.patch). RenderX.com will ask for your mail to let you download the stylesheet, which comes with full license (text from RenderX's page ..."These stylesheets were prepared by RenderX's development team and Microsoft for general use."...). This is used for templating, not in the rendering process, but it makes life easier. How to edit Word Documents to take advantage of my changes is detailed in reportPlugin\doc\HowToReport.docx
* ApacheFOP an open source FO Processor, made in java, for which I made a wrapper and some classes to consume it as a web service (you must deploy it on an application server for that, i.e. Glassfish) or from Command line. This one comes bundled.
* fo2html.xsl Also from RendeX (http://services.renderx.com/Content/tools/fo2html.html), which I modified a bit, not finished nor tested yet, to generate HTML that Excel understands, and alter default table width. This is used for rendering the report in HTML. You should put this stylesheet in reportPlugin\lib\RenderStep3\xsl\fo2html.xsl to match sfExportGlobals.yml configuration
Note: you can find both stylesheets in the Free tools Section at http://www.renderx.com/download/shop.html

Take a look at the HowToReport to see what can be done: 
https://github.com/juanmf/sfPlugins/blob/master/reportPlugin/doc/HowToReport.docx?raw=true
