reportPlugin
============
ReportPugin has the following dependencies, which I can't package all together:

* Word2FO a great tool from RenderX http://www.renderx.com/tools/word2fo.html which I modified so that you can create XSLT stylesheets that consume XML data instead of a final XSLFO document. I distribute the Path though, (in reportPlugin\doc\Word2FO.patch). RenderX.com will ask for your mail to let you download the stylesheet, which comes with full license (text from RenderX's page ..."These stylesheets were prepared by RenderX's development team and Microsoft for general use."...). This is used for templating, not in the rendering process, but it makes life easier. How to edit Word Documents to take advantage of my changes is detailed in reportPlugin\doc\HowToReport.docx
* ApacheFOP an open source FO Processor, made in java, for which I made a wrapper and some classes to consume it as a web service (you must deploy it on an application server for that, i.e. Glassfish) or from Command line.
* fo2html.xsl Also from RendeX (http://services.renderx.com/Content/tools/fo2html.html), which I modified a bit, not finished nor tested yet, to generate HTML that Excel understands, and alter default table width. This is used for rendering the report in HTML. You should put this stylesheet in reportPlugin\lib\RenderStep3\xsl\fo2html.xsl to match sfExportGlobals.yml configuration
Note: you can find both stylesheets in the Free tools Section at http://www.renderx.com/download/shop.html

Take a look at the HowToReport to see what can be done: https://github.com/juanmf/sfPlugins/blob/master/reportPlugin/doc/HowToReport.docx?raw=true

The user manual is located at reportPlugin/doc/HowToReport.docx
You will need to apply the patch to Word2FO stylesheets before it 
works as described. If you don't apply it, then you get a XSLFO that 
mimics the WordML instead of a stylesheet you can use to transform your raw XML data.

1) You need to enable php_soap.dll & php_xsl.dll extensions 
2) Register Plugin in ProjectConfiguration.php
3) Enable_module "export" in setting.yml
4) Copy reportPlugin/config/sfExportConfig.yml to app/config
5) In sfExportConfig.yml you define the location of you reports XSLT stylesheets
6) To see some example reports copy reportPlugin/modules/export/templates/reports
directory to app/templates
7) You can open <domain>/export to see what reports you have defined, and test them.
8) @see reportPlugin/modules/export/actions/actions.class.php (render action) for
an example of how to use LayoutManager::render()
9) install Glassfish, from Netbeans, (Optional as you also have a Renderer for FOP from the CLI):
  9.1) open the project WebFopWrapper2
  9.2) right click => clean and build
  9.3) right click => deploy
  9.3.1) fin in the output the following URL:
    |  INFO: WS00019: EJB Endpoint deployed
    |   WebFOPWrapper2  listening at address at http://juanmf-PC:8080/DecretoRenderService/DecretoRender
  this should match the value of RenderPDFConsummer::$_wsLocation (I'll put this 
value in config yml soon)


 