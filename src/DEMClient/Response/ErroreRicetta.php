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
 * Time: 15.56
 */

namespace DEMClient\Response;


class ErroreRicetta
{
    protected $codice_esito;
    protected $esito;
    protected $tipo_errore;

    /**
     * @return string
     */
    public function getCodiceEsito()
    {
        return $this->codice_esito;
    }

    /**
     * @param string $codice_esito
     * @return $this
     */
    public function setCodiceEsito($codice_esito)
    {
        $this->codice_esito = $codice_esito;
        return $this;
    }

    /**
     * @return string
     */
    public function getEsito()
    {
        return $this->esito;
    }

    /**
     * @param string $esito
     * @return $this
     */
    public function setEsito($esito)
    {
        $this->esito = $esito;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipoErrore()
    {
        return $this->tipo_errore;
    }

    /**
     * @param string $tipo_errore
     * @return $this
     */
    public function setTipoErrore($tipo_errore)
    {
        $this->tipo_errore = $tipo_errore;
        return $this;
    }



}