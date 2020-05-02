<?php

################
##   STRING   ##
################



#################
##   NUMBERS   ##
#################

/**
 * @param float $value
 * @return string
 */
function _toBrl(float $value) {
    return "R$ " . number_format($value, "2", ",", ".");
}



#############
##   URL   ##
#############

/**
 * @param string $url
 * @return bool | null
 */
function validate_url(string $url): ?bool {
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return true;
    } else {
        return false;
    }
}
