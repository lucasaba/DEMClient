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
 * Time: 13.04
 */

namespace DEMClient\Response;


class VisualizzaErogatoRicevuta
{
    protected $numero_ricetta_elettronica;
    protected $tipo_prescrizione;
    protected $codice_esenzione;
    protected $data_compilazione_ricetta;
    protected $codice_regione_ricetta;
    protected $codice_asl_ricetta;

    protected $cognome_nome_assistito;
    protected $indirizzo;
    protected $asl_assistito;

    protected $stato_processo;

    protected $quota_fissa;
    protected $franchigia;

    protected $prescrizioni;
    protected $errori;

    protected $esito_operazione;

    public function __construct($soap_response)
    {
        $this->codice_esito_operazione = $soap_response->codEsitoVisualizzazione;

        if($this->codice_esito_operazione != '0000') {
            foreach ($soap_response->ElencoErroriRicette as $errore_ricetta) {
                $errore = new ErroreRicetta();
                $errore->setCodiceEsito($errore_ricetta->codEsito)
                    ->setEsito($errore_ricetta->esito)
                    ->setTipoErrore($errore_ricetta->tipoErrore);
                $this->errori[] = $errore;
            }
            return;
        }

        $this->numero_ricetta_elettronica = $soap_response->nre;
        $this->tipo_prescrizione = $soap_response->tipoPrescrizione;
        $this->codice_esenzione = $soap_response->codEsenzione;
        $this->data_compilazione_ricetta = \DateTime::createFromFormat('Y-m-d h:i:s', $soap_response->dataCompilazione);
        $this->codice_regione_ricetta = $soap_response->codRegione;
        $this->codice_asl_ricetta = $soap_response->codASLAo;

        $this->cognome_nome_assistito = $soap_response->cognNome;
        $this->indirizzo = $soap_response->indirizzo;
        $this->asl_assistito = $soap_response->aslAssistito;

        $this->stato_processo = $soap_response->statoProcesso;

        $this->quota_fissa = $soap_response->quotaFissa;
        $this->franchigia = $soap_response->franchigia;

        $this->prescrizioni = array();

        foreach ($soap_response->ElencoDettagliPrescrVisualErogato as $dettaglio) {
            $prescrizione = new Prescrizione();
            $prescrizione->setStatoPrescrizione($dettaglio->statoPresc)
                ->setCodicePrestazione($dettaglio->codProdPrest)
                ->setDescrizionePrestazione($dettaglio->descrProdPrest)
                ->setQuantitaPrestazione($dettaglio->quantita)
                ->setCodiceNomenclatoreNazionale($dettaglio->codNomenclNaz);
            $this->prescrizioni[] = $prescrizione;
        }
    }

    public function getCodiceEsitoOperazione()
    {
        return $this->codice_esito_operazione;
    }

    public function getErrori()
    {
        return $this->errori;
    }
}