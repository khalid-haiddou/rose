<?php

namespace App\Services\CMI;

class CmiClient extends BaseCmiClient
{
    /**
     * Generate inputs hidden and make redirection to CMI plateform t handle payment
     *
     * @return html
     */
    public function redirect_post()
    {
        /**
         * GENERATE HASH
         */
        $this->generateHash();

        /**
         * HANDLE REQUIRE OPTIONS HIDDEN INPUTS AND REDIRECT TO CMI PAGE
         */

        $html = "<html'>";
        $html .= "<head>";
        $html .= "<meta http-equiv='Content-Language' content='tr'>";
        $html .= "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-9'>";
        $html .= "<meta http-equiv='Pragma' content='no-cache'>";
        $html .= "<meta http-equiv='Expires' content='now'>";
        $html .= "</head>";
        $html .="<body onload='closethisasap();'>";
        $html .="<form name='redirectpost' method='post' action='{$this->baseUrl}'>";
        $formData = $this->getRequireOpts();
        if (!is_null($formData)) {
            foreach ($formData as $name => $value) {
                $html .= "<input type='hidden' name='{$name}' value='".trim($value)."'> ";
            }
        }
        $html .="</form>";
        $html .="<script type='text/javascript'>";
        $html .= "function closethisasap() { document.forms['redirectpost'].submit(); }";
        $html .= "</script>";
        $html .="</body></html>";
        echo $html;
        exit();
    }

    /**
     * Check status hash from CMI plateform if is equal to hash generated
     *
     * @param HASH
     * @return bool
     */
    public function hash_eq($hash): bool
    {
        return $this->HASH == $hash;
    }
}
