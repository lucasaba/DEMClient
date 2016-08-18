<?php
/**
 * Questo file fa parte del progetto ${PROJECT_NAME}.
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
 * Date: 12/08/16
 * Time: 13.45
 */

namespace DEMClient\Request;


use DEMClient\Response\VisualizzaErogatoRicevuta;
use DEMClient\DEMClient;

/**
 * Class VisualizzaContenutoRicettaDematerializzata
 * @package DEMClient\Request
 *
 * La classe VisualizzaContenutoRicettaDematerializzata effettua la richiesta
 * di visualizzazione/presa in carica della ricetta dematerializzata.
 *
 * La prima chiamata, come specificato a pagina 8 del manuale dei web services (versione 01 03 2016),
 * effettua contestualmente alla visualizzazione, anche la presa in carico.
 *
 * Le chiamate successive, eseguono la sola visualizzazione della ricetta.
 *
 */
class VisualizzaContenutoRicettaDematerializzata extends DEMClient
{
    const ENPOINT_LOCATION='https://demservice.sanita.finanze.it/DemRicettaErogatoServicesWeb/services/demVisualizzaErogato';
    const ENPOINT_LOCATION_TEST='https://demservicetest.sanita.finanze.it/DemRicettaErogatoServicesWeb/services/demVisualizzaErogato';

    protected $location;

    /**
     * VisualizzaContenutoRicettaDematerializzata constructor.
     * @param string $pin Il pin utilizzato per le comunicazioni con il SistemaTS
     * @param string $codiceRegioneErogatore Codice regione dell'erogatore della prestazione
     * @param string $codiceASLErogatore Codice ASL dell'erogatore della prestazione
     * @param string $codiceSSA Codice identificativo della struttura erogatrice
     * @param string $login Nome utente utilizzato dalla struttura erogatrice per l'accesso al Sistema TS
     * @param string $password Password utilizzata dalla struttura erogatrice per l'accesso al Sistema TS
     * @param bool $test Se vero, vengono utilizzati uri e location di test come specificato nel kit sviluppatori
     */
    public function __construct($pin, $codiceRegioneErogatore, $codiceASLErogatore, $codiceSSA, $login, $password, $test = false)
    {
        parent::__construct($pin, $codiceRegioneErogatore, $codiceASLErogatore, $codiceSSA, $login, $password, $test);
        if($test) {
            $this->location = $this::ENPOINT_LOCATION_TEST;
        } else {
            $this->location = $this::ENPOINT_LOCATION;
        }
    }

    /**
     * @return VisualizzaErogatoRicevuta
     */
    public function executeRequest()
    {
        if($this->codice_fiscale_assistito_cifrato == null || $this->numero_ricetta == null) {
            throw new \InvalidArgumentException('È necessario impostare il numero della ricetta e il codice fiscale dell\'assistito.');
        }

        $client = new \SoapClient(__DIR__.'/../../Resources/demRicettaErogato/demVisualizzaErogato.wsdl', array(
            'location' => $this->location,
            'uri' => $this->uri,
            'stream_context' => $this->context,
            'login' => $this->login,
            'password' => $this->password,
        ));

        $soap_response = $client->__soapCall('VisualizzaErogato', array(
            'VisualizzaErogatoRichiesta' => array(
                'pinCode' => $this->pin,
                'codiceRegioneErogatore' => $this->codiceRegioneErogatore,
                'codiceAslErogatore' => $this->codiceASLErogatore,
                'codiceSsaErogatore' => $this->codiceSSA,
                'nre' => $this->numero_ricetta,
                'cfAssistito' => $this->codice_fiscale_assistito_cifrato,
                'tipoOperazione' => 1,
                'pwd' => null
            )
        ));

        $response = new VisualizzaErogatoRicevuta($soap_response);
        return $response;
    }
}