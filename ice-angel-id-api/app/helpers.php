<?php

if ( ! function_exists('full_name'))
{
    /**
     * Format a full name
     *
     * @param  string $firstName
     * @param  string $lastName
     * @param  string $middleName
     * @param  string $language
     * @return string
     */
    function full_name($firstName = '', $lastName = '', $middleName = '', $language = null, $decorate = true, $html = true)
    {
        $decor = $decorate? 'underline' : 'none';

        if (has_chinese_characters($firstName) && has_chinese_characters($lastName)){
            if ($html){
                return sprintf('<span style="text-decoration:'.$decor.';">%s</span>%s%s', $lastName, $firstName, $middleName);
            }else{
                return sprintf('%s%s%s', $lastName, $firstName, $middleName);
            }
        }
        
        if (!$html){
            return str_replace('  ', ' ', sprintf('%s %s %s', $firstName, $middleName, $lastName));
        }

        return str_replace('  ', ' ', sprintf('%s %s <span style="text-decoration:'.$decor.';">%s</span>', $firstName, $middleName, $lastName));
    }
}

if ( ! function_exists('default_empty'))
{
    /**
     * Check if the variable is set and non empty, return '' otherwise
     *
     * @param string $str
     * @return string
     */
    function default_empty($array, $field)
    {
        return isset($array[$field]) && !empty($array[$field]) ? $array[$field] : '';
    }
}

if ( ! function_exists('has_chinese_characters'))
{
    /**
     * Check if the given string includes any chinese characters
     *
     * @param string $str
     * @return bool
     */
    function has_chinese_characters($str)
    {
        preg_match('/\\p{Han}/u', $str, $matches);

        return count($matches) > 0;
    }
}

if ( ! function_exists('web_app_url'))
{
    /**
     * Generate a URL to a named web application route.
     *
     * @param $name
     * @param string $language
     * @param array $parameters
     * @return string
     */
    function web_app_url($name, $language = 'en', $parameters = [])
    {
        $id = "links.{$name}";

        return trans($id, $parameters, 'messages', $language);
    }
}

if ( ! function_exists('full_address'))
{
    /**
     * Format a full home address
     * @param  string $building
     * @param  string $city
     * @param  string $country
     * @param  string $district
     * @param  string $postal
     * @param  string $state
     * @param  string $street
     * @return string
     */
     function full_address($building = '', $city = '', $country = '', $district = '', $postal = '', $state = '', $street = '')
    {
        $k = func_get_args()[0];
        $k = array(
                'building'      =>    isset($k['building']) ? $k['building']: '',
                'street'        =>    isset($k['street']) ? $k['street']: '',
                'district'      =>    isset($k['district']) ? $k['district']: '',
                'city'          =>    isset($k['city']) ? $k['city']: '',
                'state'         =>    isset($k['state']) ? $k['state']: '',
                'postal'        =>    isset($k['postal']) ? $k['postal']: '',
                'country'       =>    isset($k['country']) ? $k['country']: '');

        $address = implode(' ', $k);

        if (has_chinese_characters($address)){
            $zip = isset($k['postal']) ? $k['postal'] : '';
            unset($k['postal']);
            $address = implode(' ', array_reverse($k, false) + [$zip]);
        }

        return  trim(str_replace('  ', ' ', $address));
    }
}

if ( ! function_exists('full_date'))
{
    /**
     * Format a date
     * @param  int|null $year
     * @param  int|null $month
     * @param  int|null $day
     * @return string        [description]
     */
     function full_date($year, $month, $day)
    {
       return implode('-', array_filter((array)func_get_args(), 'is_int'));
    }
}

if ( ! function_exists('unserialize_base64_decode'))
{
    /**
     * Apply unserialize and decode to base64 strings or unserialize
     * @param  string $value
     * @return object
     */
    function unserialize_base64_decode($value)
    {
        if ( base64_encode(base64_decode($value, true)) === $value){
            return unserialize(base64_decode($value));
        } else {
            return unserialize($value);
        }
    }
}

if ( ! function_exists('format_id'))
{
    /**
     * Apply unserialize and decode to base64 strings or unserialize
     * @param  string $value
     * @return object
     */
    function format_id($value)
    {
        return chunk_split($value, 3, ' ');
    }
}

if ( ! function_exists('generate_code'))
{
    /**
     * Generate a safe pseudorandom promo code
     * @param  string $value
     * @return object
     */
    function generate_code($length = 8)
    {
        $characters = 'bcdfghjklmnpqrstvwxyz23456789';
        $code = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
             $code .= $characters[mt_rand(0, $max)];
        }

        return strtoupper($code);
    }
}
