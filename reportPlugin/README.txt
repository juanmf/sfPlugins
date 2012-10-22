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
9) install Glassfish, from Netbeans:
9.1) open the project WebFopWrapper2
9.2) right click => clean and build
9.3) right click => deploy
9.3.1) fin in the output the following URL:
  |  INFO: WS00019: EJB Endpoint deployed
  |   WebFOPWrapper2  listening at address at http://juanmf-PC:8080/DecretoRenderService/DecretoRender
  this should match the value of RenderPDFConsummer::$_wsLocation (I'll put this 
value in config yml soon)

 