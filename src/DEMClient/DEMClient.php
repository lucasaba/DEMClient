<?php
/**
 * Created by PhpStorm.
 * User: luca
 * Date: 12/08/16
 * Time: 13.40
 */
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
 * Time: 14.38
 */
namespace DEMClient;

use DEMClient\Util\Encoder;

class DEMClient
{
    const ENDPOINT_URI='https://demservice.sanita.finanze.it/';
    const ENDPOINT_URI_TEST='https://demservicetest.sanita.finanze.it/';

    protected $pin;
    protected $codiceRegioneErogatore;
    protected $codiceASLErogatore;
    protected $codiceSSA;
    protected $login;
    protected $password;

    protected $codice_fiscale_assistito_cifrato;
    protected $numero_ricetta;

    protected $uri;

    protected $context;

    public function __construct($pin, $codiceRegioneErogatore, $codiceASLErogatore, $codiceSSA, $login, $password, $test = false)
    {
        $this->pin                    = Encoder::encode($pin);
        $this->codiceRegioneErogatore = $codiceRegioneErogatore;
        $this->codiceASLErogatore     = $codiceASLErogatore;
        $this->codiceSSA              = $codiceSSA;

        $this->codice_fiscale_assistito_cifrato = null;
        $this->numero_ricetta = null;

        $this->login = $login;
        $this->password = $password;

        if($test) {
            $this->uri = $this::ENDPOINT_URI_TEST;
            $this->context = $context = stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'allow_self_signed' => true
                )
            ));
        } else {
            $this->uri = $this::ENDPOINT_URI;
//            $this->context = $context = stream_context_create(array(
//                'ssl' => array(
//                    'verify_peer' => true,
//                    'allow_self_signed' => true,
//                    'cafile' => __DIR__.'/../Resources/certificates/demservice_sanita_finanze_it.pem'
//                )
//            ));
            $this->context = $context = stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'allow_self_signed' => true
                )
            ));
        }
    }

    public function setCodiceFiscaleAssistito($codice_fiscale_in_chiaro)
    {
        $this->codice_fiscale_assistito_cifrato = Encoder::encode($codice_fiscale_in_chiaro);
    }

    public function setCodiceFiscaleCifratoAssistito($codice_fiscale_cifrato)
    {
        $this->codice_fiscale_assistito_cifrato = $codice_fiscale_cifrato;
    }

    public function setNumeroRicetta($numero_ricetta)
    {
        $this->numero_ricetta = $numero_ricetta;
    }
}