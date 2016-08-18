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
 * Date: 18/08/16
 * Time: 13.53
 */

namespace DEMClient\Response;


class Prescrizione
{
    protected $stato_prescrizione;
    protected $codice_prestazione;
    protected $descrizione_prestazione;
    protected $quantita;
    protected $codice_nomenclatore_nazionale;

    /**
     * @return string
     */
    public function getStatoPrescrizione()
    {
        return $this->stato_prescrizione;
    }

    /**
     * @return string
     */
    public function getCodicePrestazione()
    {
        return $this->codice_prestazione;
    }

    /**
     * @return string
     */
    public function getDescrizionePrestazione()
    {
        return $this->descrizione_prestazione;
    }

    /**
     * @return string
     */
    public function getQuantita()
    {
        return $this->quantita;
    }

    /**
     * @return string
     */
    public function getCodiceNomenclatoreNazionale()
    {
        return $this->codice_nomenclatore_nazionale;
    }

    public function setStatoPrescrizione($stato)
    {
        $this->stato_prescrizione = $stato;
        return $this;
    }

    public function setCodicePrestazione($codice)
    {
        $this->codice_prestazione = $codice;
        return $this;
    }

    public function setDescrizionePrestazione($descrizione_prestazione)
    {
        $this->descrizione_prestazione = $descrizione_prestazione;
        return $this;
    }

    public function setQuantitaPrestazione($quantita)
    {
        $this->quantita = $quantita;
        return $this;
    }

    public function setCodiceNomenclatoreNazionale($codice_nazionale)
    {
        $this->codice_nomenclatore_nazionale = $codice_nazionale;
        return $this;
    }
}