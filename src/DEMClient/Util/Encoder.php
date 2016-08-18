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
 * Time: 14.38
 */

namespace DEMClient\Util;


class Encoder
{
    public static function encode($stringa)
    {
        $fp=fopen(__DIR__.'/../../Resources/SanitelCF.cer','r');
        $certificate_text=fread($fp, 8192);
        fclose($fp);

        $pub_key = openssl_get_publickey($certificate_text);

        $crypttext = '';

        openssl_public_encrypt($stringa,$crypttext,$pub_key);

        return base64_encode($crypttext);
    }
}