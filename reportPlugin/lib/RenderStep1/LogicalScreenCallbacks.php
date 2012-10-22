<?php

/*
 * This file is part of the reportPlugin package.
 * (c) 2011-2012 Juan Manuel Fernandez <juanmf@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This class helps in the Step1 of a three steps Process.
 * 
 * The process consists of the following steps:
 * <ol> 
 * <li>Step 1 consists in generating the XML bsaed raw data for the report. <b>RawXMLData</b></li>
 * <li>Step 2 consists in merging this raw data with a XSL-FO template to give it
 * the presentation information. XSL-FO acts as an intermediate language used 
 * to render the final reportin any format with a last transformation. <b>XSL-FO</b></li>
 * <li>Step 3 consists on rendering the XSL-FO representtion (the intermediate 
 * language) of the report to the desired output fromat. <b>FinalReport</b></li></ol>
 * 
 * This class should be used to add the methods that creates or access the 
 * RawXMLData and returns it to be processed in Step2.
 * 
 * To help extract data from databse in XML format we have a Doctrine XML Hydrator
 * you can see a usage example in LogicalScreenCallbacks::helloworld().
 *
 * @package ReportPlugin
 * @author  Juan Manuel Fernandez <juanmf@gmail.com>
 * @see     %sf_plugins_dir%/reportPlugin/config/sfExportConfig.yml
 */
class LogicalScreenCallbacks
{
    /**
     * Dummy method, this method gets called by LayoutManager::render(). Which 
     * gets informed by the config file sfExportConfig.yml's:
     * <pre> 
     * .step1: 
     * .  logical_screen_callback: [LogicalScreenCallbacks, helloworld] # here is the callback!
     * .  callback_params: ~ # No params this time! 
     * </pre> 
     
     * This method generates the xml data for the 'How to create a simple Report'
     * topic of the Report Engine tutorial
     *
     * @return DomDocument With the XMLRawData that hsould be processed in Step2
     * @see LayoutManager::render()
     */
    public static function howToSimple()
    {
        $xml = <<<XML
<root>
    <Node>
        <SubNode>Some Text</SubNode>
    </Node>
    <row>
        <Column>
            <day>15</day>
        </Column>
        <Column>
            <day>5</day>
        </Column>
        <Column>
            <day>17</day>
        </Column>
    </row>
    <row>
        <Column>
            <day>1</day>
        </Column>
        <Column>
            <day>10</day>
        </Column>
        <Column>
            <day>25</day>
        </Column>
    </row>
</root>
XML;
        $q = new DOMDocument();
        $q->loadXML($xml);
        return $q;
    }

    /**
     * Dummy method, this method gets called by LayoutManager::render(). Which 
     * gets informed by the config file sfExportConfig.yml's:
     * <pre> 
     * .step1: 
     * .  logical_screen_callback: [LogicalScreenCallbacks, helloworld] # here is the callback!
     * .  callback_params: ~ # No params this time! 
     * </pre> 
     * 
     * @return DomDocument With the XMLRawData that hsould be processed in Step2
     * @see LayoutManager::render()
     */
    public static function helloworld()
    {
        $q = Doctrine_Query::create()
            ->from('Persona p')
            ->innerJoin('p.PersonaDomicilio pd')
            ->innerJoin('pd.Domicilio d')
            ->innerJoin('d.Localidad l')
            ->execute(array(), 'xml');
        /* @var $q DomDocument */
        /*die(var_dump($q->saveXML())); // To see the XML as a String in the browser*/
        return $q;
    }

    /**
     * Listado de Personas.
     * 
     * @return DomDocument With the XMLRawData that hsould be processed in Step2
     * @see LogicalScreenCallbacks::helloworld(), LayoutManager::render()
     */
    public static function listadoPersonas()
    {
        // die(var_dump(func_get_args()));
        $q = Doctrine_Query::create()
            ->from('Persona p')
            ->innerJoin('p.PersonaDomicilio pd')
            ->innerJoin('pd.Domicilio d')
            ->innerJoin('d.Localidad l')
            ->limit(20)
            ->execute(array(), 'xml');
        /* @var $q DomDocument */
        return $q;
    }
    
    /**
     * Listado de Personas por edad.
     * 
     * @return DomDocument With the XMLRawData that hsould be processed in Step2
     * @see LogicalScreenCallbacks::helloworld(), LayoutManager::render()
     */
    public static function listadoPersonasXedad()
    {
        //        $q = Doctrine_Query::create()
        //            ->from('Persona p')
        //            ->innerJoin('p.PersonaDomicilio pd')
        //            ->innerJoin('pd.Domicilio d')
        //            ->innerJoin('d.Localidad l')
        ////            ->select('p.nro_documento, p.nombre, YEAR(p.fecha_nacimiento)')
        //            ->limit(6)
        //            ->execute(array(), 'xml');
        //        /* @var $q DomDocument */
        //        
        //        $birthYearCount = Doctrine_Query::create()
        //            ->from('Persona p')
        //            ->select('YEAR(p.fecha_nacimiento) as years, count(YEAR(p.fecha_nacimiento)) as counted')
        //            ->groupBy('years')
        //            ->orderBy('years')
        //            ->limit(6)
        //            ->execute(array(), 'xml');
        //        
        //        $chart = ListPersonasEdadCharts::listadoPersonasXedadCreateChart($birthYearCount);
        //        $encodedChart = base64_encode($chart);
        //
        //        $chartNode = $q->createElement('chart', $encodedChart);
        //        $q->documentElement->appendChild($chartNode);
        $xml = <<<XML
<root>
    <Node>
        <SubNode>Some Text</SubNode>
    </Node>
    <date>
        <day>15</day>
        <month>6</month>
        <year>2012</year>
    </date>
</root>
XML;
        $q = new DOMDocument();
        $q->loadXML($xml);
        return $q;
    }
    
    /**
     * TODO: Completar metodo con los dator de Cuadro1
     * 
     * @param mixed $configParams   ConfigParams.
     * @param array $requestOptions las options de la request.
     * 
     * @return DomDocument
     */
    public static function planillaEstadisticaCuadro1($configParams, array $requestOptions) 
    {
        $nivelEstablecimientoId = '084cfba4-4d34-102f-8868-001a64ab842a';
        $mes = $requestOptions['mes'];
        $anio = $requestOptions['anio'];
        $edificioEstablecimiento = Doctrine::getTable('EdificioEstablecimiento')
            ->find($requestOptions['subcue']);
        // es un docente_id
        $director = $requestOptions['docente_id'];
        $nivelEstablecimiento = Doctrine_Core::getTable('NivelEstablecimiento')->find($nivelEstablecimientoId);
        $nivelId = $nivelEstablecimiento->getNivelTipoEducacion()->getNivelId();
        $cicloLectivo = sfContext::getInstance()->getUser()->getAttribute('CicloLectivoId');
        $establecimiento = $nivelEstablecimiento->getEstablecimiento();
        $nroEstab = $establecimiento->getNumero();
        $logicalScreen = new DOMDocument();
        $root = $logicalScreen->createElement('result');
        $logicalScreen->appendChild($root);
        $egbNro = $logicalScreen->createElement('EGBNRO', $nroEstab);
        $root->appendChild($egbNro);
        return $logicalScreen;
    }
}
