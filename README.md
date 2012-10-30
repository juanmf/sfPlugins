sfPlugins
=========

reportPlugin
============

Report Plugin is a tool for generating reports with PHP, even though it provides 
a PHP API it integrates several technologies to achieve it.
The reports are generated in three phases:
   * Data Generation 
   * Data and template Merging.
   * Rendering

The Data generation consist of anything that produces a RAW XML with the report 
data. Of course, this XML structure must be consistent among several rendering of 
the same report. Since you will consider this structure when creating the 
template, as the template must consume this data XML. The reportEngine provides
a placeholder class for putting this kind of logic, but you can generate it in
methods elsewhere, so you either provide the callback to generate it or the XML
itself. To make things easier, a Doctrine XML Hydrator is bundled so you can get 
XML out of your Doctrine Queries, this is really handy if you use Doctrine, if not
you have an arrayToXML method in utils, that will also help.. 

The template must be an XSLT transformation stylesheet, that will be processed by
PHP XSLT Processor, don't get scared yet, I provide an automatic way of generating 
it from a MS WordML 2003 document. This stylesheet consumes your data XML and 
Renders a XSL-FO document, that represents the rendered report, but in FO. 
The report must still go through the Rendering phase, if you want something different 
from XSL-FO.

In the Rendering phase transforms the XSL-FO representation into PDF, HTML, or simply 
the same FO. more transformations can be easily added.

The look and feel of the generated PDFs are great, thanks to XSL-FO and ApacheFOP. 
They look almost identical to the Word template you make (Thanks to Word2FO).
By the time you feel the need to tweak the automatically generated template, if it 
ever happens, you'll have already made some nice reports and feel more at home 
with XSLT and XSL-FO. which by the way is infinitely easier to tweak than to 
write from scratch.

Take a look at the HowToReport to see what can be done: https://github.com/juanmf/sfPlugins/blob/master/reportPlugin/doc/HowToReport.pdf?raw=true
