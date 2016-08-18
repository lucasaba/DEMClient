# DEMClient

DEMClient è una libreria PHP che fornisce un client per lo scambio di 
informazioni con il Ministero del'Economia e delle Finanze (MEF) in
relazione alle funzioni delle ricette dematerializzate.

Il codice si basa sulla documentazione rinvenibile nel Portale del 
Progetto Tessera Sanitaria - SistemaTS (http://www.sistemats.it/).

## Riferimenti web

La base della documentazione utilizzatta per la scrittura del codice si
trova nel sito del SistemaTS, seguendo, dalla voce di menu "Sistema TS 
informa", il menu "Medici in rete".

Attualmente il link porta alla pagina:
http://sistemats1.sanita.finanze.it/wps/portal/portalets/sistematsinforma/medici_in_rete

Qui, seguendo il link "DM 2 novembre 2011 - Ricetta dematerializzata",
si accede alla documentazione completa.

## File wsdl

Lo scambio di informazioni con il MEF avviene tramite protocllo SOAP
(https://it.wikipedia.org/wiki/SOAP).

Il WSDL è definito tramite i file wsdl che si trovano all'interno della
cartella [src/Resources/](src/Resources/). I file wsdl sono quelli 
disponibili nel "Kit per lo sviluppo EROGATORE ver. 01032016".

## Guida all'uso

Per le informazioni estese sull'utilizzo della libreria, si faccia 
riferimento alla cartella [src/Resources/doc](src/Resources/doc).