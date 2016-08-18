<?php
/**
 * Questo file fa parte del progetto sistemats-erogatore.
 * Il codice è fornito senza alcuna garanzia e distribuito
 * con licenza di tipo open source.
 * Per le informazioni sui diritti e le informazioni sulla licenza
 * consultare il file LICENSE che deve essere distribuito
 * insieme a questo codice.
 *
 * (c) Luca Saba <lucasaba@gmail.com>
 *
 * Created by PhpStorm.
 * User: luca
 * Date: 18/08/16
 * Time: 15.15
 */

namespace DEMClient\Tests;


use DEMClient\Request\VisualizzaContenutoRicettaDematerializzata;
use DEMClient\Response\VisualizzaErogatoRicevuta;

class VisualizzaContenutoRicettaDematerializzataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VisualizzaContenutoRicettaDematerializzata
     */
    protected $request;

    /**
     * @var $response VisualizzaErogatoRicevuta
     */
    protected $response;

    protected function setUp()
    {
        $this->request = new VisualizzaContenutoRicettaDematerializzata(
            '1835386125',
            '130',
            '203',
            '000501',
            'UEB7LQI4',
            'PSEMHP7N',
            true
        );

        $this->request->setCodiceFiscaleCifratoAssistito('iKvd9JQntqxPBT2UA/OFfztSNLidocP8Op+NfODzfTdxFWzkcdZrJz5gvCuqv7Dh/r3Cin1ZQMmg/BofIqYCyq2PcC+PJzbvQCocDdl6FrXVXs3W5JhnX7VpWFGCLPYYY2WL+RWKxhfkGqeY8+NCVfQ1lEA15g3W5AabJ15Tthk=');
        $this->request->setNumeroRicetta('1300A4003598269');

        $this->response = $this->request->executeRequest();
    }

    public function testComunicazione()
    {
        $this->assertSame($this->response->getCodiceEsitoOperazione(), '9999');
        foreach ($this->response->getErrori() as $errore) {
            /* @var $errore \DEMClient\Response\ErroreRicetta */
            $this->assertSame($errore->getCodiceEsito(), '5011');
            $this->assertSame($errore->getEsito(), 'Visualizzazione non consentita - ricetta presa in carico da altro utente');
            $this->assertSame($errore->getTipoErrore(), 'Bloccante');
        }
    }
}
